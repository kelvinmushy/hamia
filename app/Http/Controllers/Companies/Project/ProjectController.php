<?php

namespace App\Http\Controllers\Companies\Project;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectLocation;
use App\Models\ProjectPayment;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a list of all projects owned by the company.
     */
    public function index()
    {
        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'You do not belong to a company.');
        }
        $region = Region::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        $projects = Project::where('company_id', $company->id)->get();
        return view('company.projects.index', compact('projects', 'company', 'region', 'district'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'You do not belong to a company.');
        }

        $regions = Region::orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        return view('projects.create', compact('regions', 'districts', 'company'));
    }

    /**
     * Store a newly created project under the company.
     */
    public function store(Request $request)
    {
        $company = Auth::user()->company;

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'You do not belong to a company.'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'sub_location' => 'nullable|string|max:255',
            'type' => 'required|in:residential,farm_land',
            'payment_method' => 'required|in:cash,installment',
            'size_in_sq_m' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects', 'public');
            }

            // Create project under the company
            $project = Project::create([
                'name' => $request->name,
                'company_id' => $company->id, // Link to company
                'type' => $request->type,
                'payment_method' => $request->payment_method,
                'size_in_sq_m' => $request->size_in_sq_m,
                'image' => $imagePath,
                'creator_id' => Auth::id(),
            ]);

            // Create project location
            ProjectLocation::create([
                'project_id' => $project->id,
                'district_id' => $request->district_id,
                'sub_location' => $request->address,
            ]);

            //Create Project payment 
            ProjectPayment::create([
                'project_id' =>$project->id,
                'total_price' => $request->price,
                'amount_paid' => $request->amount_paid,
                'payment_type' => $request->payment_method,
                'installment_period' => $request->payment_method === 'installment' ? $request->installment_period : null,
                'installment_amount' => $request->payment_method === 'installment' ? $request->installment_amount : null,
                'payment_status' => $this->getPaymentStatus($request->price, $request->amount_paid),
                'payment_date' => now(),
            ]);


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Project created successfully!',
                'redirect_url' => route('agent.projects.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the details of a specific project.
     */
    public function show($id)
    {
        $company = Auth::user()->company;
        $project = Project::where('company_id', $company->id)->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing a project.
     */
    public function edit($id)
    {
        $company = Auth::user()->company;
        $project = Project::where('company_id', $company->id)->findOrFail($id);

        $regions = Region::orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        return view('projects.edit', compact('project', 'regions', 'districts', 'company'));
    }

    /**
     * Update a project owned by the company.
     */
    public function update(Request $request, $id)
    {
        $company = Auth::user()->company;
        $project = Project::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'sub_location' => 'nullable|string|max:255',
            'type' => 'required|in:residential,farm_land',
            'payment_method' => 'required|in:cash,installment',
            'size_in_sq_m' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Handle image update
            if ($request->hasFile('image')) {
                if ($project->image) {
                    Storage::delete('public/' . $project->image);
                }
                $imagePath = $request->file('image')->store('projects', 'public');
                $project->image = $imagePath;
            }

            // Update project details
            $project->update([
                'name' => $request->name,
                'type' => $request->type,
                'payment_method' => $request->payment_method,
                'size_in_sq_m' => $request->size_in_sq_m,
                'updator_id' => Auth::id(),
            ]);

            // Update project location
            $project->location()->updateOrCreate(
                ['project_id' => $project->id],
                [
                    'district_id' => $request->district_id,
                    'sub_location' => $request->sub_location,
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully!',
                'redirect_url' => route('projects.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a project owned by the company.
     */
    public function destroy($id)
    {
        $company = Auth::user()->company;
        $project = Project::where('company_id', $company->id)->findOrFail($id);

        if ($project->image) {
            Storage::delete('public/' . $project->image);
        }

        $project->delete();

        return redirect()->route('agent.projects.index')->with('success', 'Project deleted successfully!');
    }

    private function getPaymentStatus($totalPrice, $amountPaid)
    {
        if ($amountPaid >= $totalPrice) {
            return 'completed';  // Fully Paid
        } elseif ($amountPaid > 0) {
            return 'ongoing';  // Partial Payment Made
        } else {
            return 'pending';  // No Payment Made Yet
        }
    }

}
