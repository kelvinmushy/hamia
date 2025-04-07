<?php

namespace App\Http\Controllers\Companies\Project;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
use App\Models\ProjectDivision;
use App\Models\ProjectLocation;
use App\Models\ProjectPayment;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class ProjectDivisionController extends Controller
{
    /**
     * Display a list of all projects owned by the company.
     */
    public function index($name, $type, $project_id)
    {




        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'You do not belong to a company.');
        }

        $region = Region::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        $project = Project::where('id', $project_id)->first();
        $clients=Customer::get();

        // Get all project divisions for the given project_id
        $project_division = ProjectDivision::where('project_id', $project_id)->where('division_type',$type)->get();

        // Calculate total divisions, total price, and remaining size
        $totalDivisions = $project_division->count();
        $totalPrice = $project_division->sum('sell_price');

        // Assuming $project is already fetched with the correct project instance
// and $project_division is a collection of divisions related to the project

        if ($project->type == "mixed") {
           

            if ($type == 'residential') {
               
                // Calculate remaining size for residential division
                $existingSize = $project->divisions()->where('division_type', 'residential')->sum('size');
              
                $remainingSize = $project->residential_size - $existingSize;  // Subtract the total size of residential divisions from the original residential size
            } else {
                // Calculate remaining size for farm land division
                $existingSize = $project->divisions()->where('division_type', 'farm_land')->sum('size');
              
                $remainingSize = $project->farm_size - $existingSize;  // Subtract the total size of farm land divisions from the original farm size
             
            }

        } else {
            // For non-mixed projects, check the remaining size for the entire project
            $existingSize = $project->divisions()->sum('size');
            $remainingSize = $project->size_in_sq_m - $existingSize;  // Subtract the total size of divisions from the original project size
        }


        // Pass the data to the view
        return view('company.projects.division.index', compact('project_division', 'company', 'clients','region', 'district', 'project_id', 'type', 'totalDivisions', 'totalPrice', 'remainingSize', 'project'));
    }


    /**
     * Store a newly created project division under the company.
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
    
        // Validate the form data
        $request->validate([
            'division_type' => 'required|in:residential,farm_land,industrial,commercial,recreational,institutional,transportation,conservation,vacant',
            'size' => 'required|numeric|min:1',
            'sell_price' => 'required|numeric|min:1',
            'project_id' => 'required|exists:projects,id', // Ensure project_id is valid
        ]);
    
        DB::beginTransaction();
    
        try {
            $projectId = $request->project_id;
    
            // Fetch the project details
            $project = Project::where('id', $projectId)->firstOrFail();
    
            // Logic to check remaining size based on division type
            if ($project->type == "mixed") {
                if ($request->division_type == 'residential') {
                    // Calculate remaining size for residential division
                    $existingSize = $project->divisions()->where('division_type', 'residential')->sum('size');
                    $remainingSize = $project->residential_size - $existingSize;
                } elseif ($request->division_type == 'farm_land') {
                    // Calculate remaining size for farm land division
                    $existingSize = $project->divisions()->where('division_type', 'farm_land')->sum('size');
                    $remainingSize = $project->farm_size - $existingSize;
                } else {
                    // For other division types in mixed projects
                    $existingSize = $project->divisions()->where('division_type', $request->division_type)->sum('size');
                    $remainingSize = $project->size_in_sq_m - $existingSize;
                }
            } else {
                // For non-mixed projects, check the remaining size for the entire project
                $existingSize = $project->divisions()->sum('size');
                $remainingSize = $project->size_in_sq_m - $existingSize;
            }
    
            // Ensure the requested size does not exceed the remaining available size
            if ($request->size > $remainingSize) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested size exceeds remaining available size!'
                ], 400);
            }
    
            // Proceed to store the division data
            $divisionCount = ProjectDivision::where('project_id', $projectId)->count(); // Get number of divisions for this project
    
            // Division type mapping
            $divisionTypeMapping = [
                'residential' => 'Plot',
                'farm_land' => 'Farm',
                'industrial' => 'Industrial',
                'commercial' => 'Commercial',
                'recreational' => 'Recreational',
                'institutional' => 'Institutional',
                'transportation' => 'Transportation',
                'conservation' => 'Conservation',
                'vacant' => 'Vacant',
            ];
    
            // Get the appropriate name based on division type
            $divisionTypeName = $divisionTypeMapping[$request->division_type] ?? 'Unknown';  // Default to 'Unknown' if type not matched
    
            // Generate the division name
            $divisionName = 'Mradi-' . $projectId . '-' . $divisionTypeName . '-' . ($divisionCount + 1);
    
            // Create project division entry
            ProjectDivision::create([
                'name' => $divisionName, // Automatically generated name
                'division_type' => $request->division_type,
                'size' => $request->size,
                'sell_price' => $request->sell_price,
                'project_id' => $projectId,
                'creator_id' => Auth::id(),
            ]);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Project division created successfully!',
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
     * Update an existing project division owned by the company.
     */
    public function update(Request $request, $id)
    {
        $company = Auth::user()->company;
    
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'You do not belong to a company.'
            ], 403);
        }
    
        // Find the division to update
        $division = ProjectDivision::findOrFail($id);
        $project = Project::findOrFail($division->project_id);  // Get the related project
    
        // Validate incoming request data
        $request->validate([
            'division_type' => 'required|in:residential,farm_land,industrial,commercial',
            'size' => 'required|numeric|min:1',
            'sell_price' => 'required|numeric|min:1',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Calculate the remaining size based on project type and division type
            $remainingSize = 0;
    
            if ($project->type == "mixed") {
                if ($request->division_type == 'residential') {
                    // Calculate remaining size for residential division
                    $existingSize = $project->divisions()->where('division_type', 'residential')->sum('size');
                    $remainingSize = $project->residential_size - $existingSize;
                } else {
                    // Calculate remaining size for farm land division
                    $existingSize = $project->divisions()->where('division_type', 'farm_land')->sum('size');
                    $remainingSize = $project->farm_size - $existingSize;
                }
            } else {
                // For non-mixed projects, check the remaining size for the entire project
                $existingSize = $project->divisions()->sum('size');
                $remainingSize = $project->size_in_sq_m - $existingSize;
            }
    
            // Ensure that the updated size does not exceed the remaining size
            if ($request->size > $remainingSize) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested size exceeds the remaining available size for this division type.'
                ], 400);
            }
    
            // Update division details
            $division->update([
                'name' => $division->name, // Keep the original name
                'division_type' => $request->division_type,
                'size' => $request->size,
                'sell_price' => $request->sell_price,
                'updator_id' => Auth::id(), // Logged-in user as the updator
            ]);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Project division updated successfully!',
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
     * Remove the specified project division from storage.
     */
    public function destroy($id)
    {
        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->back()->with('error', 'You do not belong to a company.');
        }

        $division = ProjectDivision::findOrFail($id);
        $project = Project::findOrFail($division->project_id);

        DB::beginTransaction();

        try {
            // Add the division's size back to the project
         
            $project->save();

            // Delete the division
            $division->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Project division deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Error deleting project division: ' . $e->getMessage());
        }
    }

}
