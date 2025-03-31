<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyLocation;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB; // Import DB for transactions
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $region = Region::orderBy('name')->get();
        $district = District::orderBy('name')->get();

        return view('company.index', compact('region', 'district'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.agent.register_company');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        $user = Auth::user();

        if ($user->company) {
            return response()->json([
                'status' => 'error',
                'message' => 'You already have a registered company. Currently, only the main branch is supported.',

                'redirect_url' => route('agent.company.edit', $user->company->id)
            ], 400);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone_number' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'district_id' => 'required|exists:districts,id',
            'sub_location' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction(); // Start Transaction

        try {
            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }

            // Create the company
            $company = Company::create([
                'name' => $request->name,
                'user_id' => auth()->id(),
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'logo' => $logoPath,
                'creator_id' => auth()->id(),
            ]);

            // Create the company location
            CompanyLocation::create([
                'company_id' => $company->id,
                'district_id' => $request->district_id,
                'sub_location' => $request->sub_location,
                'creator_id' => auth()->id(),
            ]);

            DB::commit(); // Commit transaction if everything is successful

            return response()->json([
                'success' => true,
                'message' => 'Company created successfully!',
                'redirect_url' => route('agent.company.edit', $company->id) // Redirect to edit page
            ]);

        } catch (\Exception $e) {
            DB::rollback(); // Rollback in case of error

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('agent.company_show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = Region::orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        $company = Company::findOrFail($id);
        return view('company.edit', compact('region', 'districts', 'company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'phone_number' => 'required|string|regex:/^225[0-9]{9}$/|max:12|unique:companies,phone_number,' . $company->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'district_id' => 'required|exists:districts,id',
            'sub_location' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction(); // Start a database transaction

        try {
            // Handle logo update
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($company->logo) {
                    Storage::delete('public/' . $company->logo);
                }
                $logoPath = $request->file('logo')->store('logos', 'public');
                $company->logo = $logoPath;
            }

            // Update company details
            $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'updator_id' => auth()->id(),
            ]);

            // Update or Create company location
            $company->location()->updateOrCreate(
                ['company_id' => $company->id],
                [
                    'district_id' => $request->district_id,
                    'sub_location' => $request->sub_location,
                    'updator_id' => auth()->id(),
                ]
            );

            DB::commit(); // Commit transaction if successful

            return response()->json([
                'success' => true,
                'message' => 'Company updated successfully!',

            ]);

        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaction in case of an error

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        if ($company->logo) {
            Storage::delete('public/' . $company->logo);
        }

        $company->delete();

        session()->flash('success', 'Company deleted successfully!');
        return redirect()->route('company.index');
    }
}
