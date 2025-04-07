<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Mail\Contact;
use Carbon\Carbon;
use App\Models\Property;
use App\Models\Company;
use App\Models\CompanyLocation;
use App\Models\Region;
use App\Models\Message;
use App\Models\SocialMedia;
use App\Models\CompanySocialMedia;
use App\Models\User;
use App\Models\District;
use Auth;
use Hash;
use DB;
use Toastr;

class DashboardController extends Controller
{
    use Traits\CheckProfileTraits;

    public function index()
    { 
        // Get the company_id from the authenticated user's associated company
        $company_id = Auth::user()->company->id;

        // Check if the company has a complete profile
        $check_company = Company::where('id', $company_id)->first();
        if ($check_company->logo == "" || $check_company->phone_number == "" || $check_company->about == "" || $check_company->location->sub_location== "") {
            $profile = Auth::user();
            $region = Region::orderBy('name')->get();
            $district = District::orderBy('name')->get();
            return view('agent.profile', compact('profile', 'region', 'district'));
        }

        // Use company_id to fetch properties and messages
        $properties = Property::latest()->where('company_id', $company_id)->take(5)->get();
        $propertytotal = Property::latest()->where('company_id', $company_id)->count();
        $region = Region::orderBy('name')->get();
        $messages = Message::latest()->where('company_id', $company_id)->take(5)->get();
        $messagetotal = Message::latest()->where('company_id', $company_id)->count();

        return view('agent.dashboard', compact('properties', 'propertytotal', 'messages', 'messagetotal', 'region'));
    }

    public function profile()
    {
        $profile = Auth::user();
        $region = Region::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        return view('agent.profile', compact('profile', 'region', 'district'));
    }

    public function social()
    {
        $company_id = Auth::user()->company->id; // Get the company_id from the user

        // Get social media accounts related to the company
        $user_social = CompanySocialMedia::where('company_id', $company_id)->get();
        $profile = Auth::user();
        $social = SocialMedia::orderBy('name')->get();

        return view('agent.social_media.index', compact('social', 'user_social'));
    }

    public function social_store(Request $request)
    {
        $company_id = Auth::user()->company->id; // Get the company_id from the user

        $request->validate([
            'social_media_id' => 'required',
            'social_link' => 'required',
        ]);

        // Store the social media data for the company instead of the user
        $data = CompanySocialMedia::updateOrCreate([
            'company_id' => $company_id, 'social_media_id' => $request->social_media_id
        ], [
            'company_id' => $company_id, 'social_media_id' => $request->social_media_id,
            'url' => $request->social_link,
        ]);

        return redirect()->back()->with('success', 'Social Media Updated');
    }

    public function social_delete($id)
    {
        CompanySocialMedia::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Social Media Account Deleted');
    }

    public function profileUpdate(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,jpg,png',
            'about' => 'max:250'
        ]);
    
        // Begin a database transaction
        DB::beginTransaction();
    
        try {
            // Get the company associated with the authenticated user
            $company = Auth::user()->company;
    
            // Handle image upload
            $image = $company->logo; // Get the current logo path
            if ($request->hasFile('image')) {
                // Check if the existing image file exists and delete it
                if ($image && file_exists(public_path($image))) {
                    unlink(public_path($image)); // Unlink the existing image
                }
    
                // Process the new image upload
                $path = 'images/company/';
                $filename = uniqid(date('Hmdysi')) . '_' . $request->file('image')->getClientOriginalName();
                $upload = $request->file('image')->move($path, $filename);
                if ($upload) {
                    $image = $path . $filename; // Set the new image path
                }
            }
    
            // Update the company's basic info (name, email, phone, etc.)
            $company->name = $request->name;
            $company->email = $request->email;
            $company->logo = $image; // Save the new image path as the company logo
            $company->phone_number = $request->phone_number;
            $company->about = $request->about; // Assuming you have a column for "about" in the Company model
    
            $company->save();
    
            // Save location details under company_id in the CompanyLocation model
            $company_location = $company->location ?? new CompanyLocation(); // Fetch existing location or create a new one
    
            $company_location->district_id = $request->district_id;
            $company_location->sub_location = $request->sub_location;
            $company_location->updator_id = Auth::user()->id; // Save the updater ID (user ID)
            $company_location->company_id = $company->id; // Link the location to the company
            $company_location->save();
    
            // Commit the transaction
            DB::commit();
    
            // Return a success response in JSON format
            return response()->json([
                'success' => true,
                'message' => 'Company profile updated successfully.'
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if something went wrong
            DB::rollBack();
    
            // Return a JSON response with an error message
            return response()->json([
                'success' => false,
                'message' => 'Failed to update company profile. Please try again later.',
                'error' => $e->getMessage() // Optional: Return the error message
            ]);
        }
    }
    
    
    public function changePassword()
    {
        return view('agent.changepassword');
    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
            Toastr::error('message', 'Your current password does not match the password you provided! Please try again.');
            return redirect()->back();
        }

        if (strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0) {
            Toastr::error('message', 'New Password cannot be the same as your current password! Please choose a different password.');
            return redirect()->back();
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Toastr::success('message', 'Password changed successfully.');
        return redirect()->back();
    }

    // MESSAGE
    public function message()
    {
        $company_id = Auth::user()->company->id; // Get company_id

        // Get messages related to the company
        $messages = Message::latest()->where('company_id', $company_id)->paginate(10);

        return view('agent.messages.index', compact('messages'));
    }

    public function messageRead($id)
    {
        $message = Message::findOrFail($id);

        return view('agent.messages.read', compact('message'));
    }

    public function messageReplay($id)
    {
        $message = Message::findOrFail($id);

        return view('agent.messages.replay', compact('message'));
    }

    public function messageSend(Request $request)
    {
        $company_id = Auth::user()->company->id; // Get company_id

        $request->validate([
            'agent_id' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);

        // Create a message with the company_id
        Message::create([
            'company_id' => $company_id,
            'agent_id' => $request->agent_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        Toastr::success('message', 'Message sent successfully.');
        return back();
    }

    public function messageReadUnread(Request $request)
    {
        $status = $request->status;
        $msgid = $request->messageid;

        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }

        $message = Message::findOrFail($msgid);
        $message->status = $status;
        $message->save();

        return redirect()->route('agent.message');
    }

    public function messageDelete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Toastr::success('message', 'Message deleted successfully.');
        return back();
    }

    public function contactMail(Request $request)
    {
        $message = $request->message;
        $name = $request->name;
        $mailfrom = $request->mailfrom;

        Mail::to($request->email)->send(new Contact($message, $name, $mailfrom));

        Toastr::success('message', 'Mail sent successfully.');
        return back();
    }
}
