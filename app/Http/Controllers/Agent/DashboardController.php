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
use App\Models\UserLocation;
use App\Models\Region;
use App\Models\Message;
use App\Models\SocialMedia;
use App\Models\UserSocialMedia;
use App\Models\User;
use App\Models\District;
use Auth;
use Hash;
use Toastr;

class DashboardController extends Controller
{
      use Traits\CheckProfileTraits;

      public function index()
      { 
        
        //dd(566); 
        $check_user=User::where('id',Auth::id())->first();
        if($check_user->image==""||$check_user->phone_number==""||$check_user->about==""||$check_user->user_location==""){
             $profile = Auth::user();
             $region=Region::orderBy('name')->get();
             $district=District::orderBy('name')->get();
             return view('agent.profile',compact('profile','region','district'));
        }
       

        $properties    = Property::latest()->where('agent_id', Auth::id())->take(5)->get();
        $propertytotal = Property::latest()->where('agent_id', Auth::id())->count();
        $region=Region::orderBy('name')->get();
        $messages      = Message::latest()->where('agent_id', Auth::id())->take(5)->get();
        $messagetotal  = Message::latest()->where('agent_id', Auth::id())->count();
         return view('agent.dashboard',compact('properties','propertytotal','messages','messagetotal','region'));
       }

      public function profile()
      {
        $profile = Auth::user();
          $region=Region::orderBy('name')->get();
          $district = District::orderBy('name')->get();
        return view('agent.profile',compact('profile','region','district'));
      }
       public function social()
      {
         $user_id=Auth::user()->id;
         $user_social=UserSocialMedia::where('user_id',$user_id)->get();
         $profile = Auth::user();
         $social=SocialMedia::orderBy('name')->get();
         return view('agent.social_media.index',compact('social','user_social'));
     }
      public function social_store(Request $request)
      {
        $user_id=Auth::user()->id;
          $request->validate([
            'social_media_id'      => 'required',
            'social_link'  => 'required',
         
          ]);

           $data =UserSocialMedia::updateOrCreate([
            'user_id' => $user_id,'social_media_id'=>$request->social_media_id
        ], [
             'user_id' => $user_id,'social_media_id'=>$request->social_media_id,
             'url' =>$request->social_link,
        ]);
           return redirect()->back()->with('success', 'Social Media Updated');  
      }
      public function social_delete($id){
                UserSocialMedia::where('id',$id)->delete();
              return redirect()->back()->with('success', 'Social Media Accout Deleted');  
      }
 
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'phone_number'  => 'required',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'about'     => 'max:250'
        ]);

        $user = User::find(Auth::id());

     
        $image = $request->file('image');
        $slug  = str_slug($request->title_id);

        if (request()->hasFile('image')){

            $path = 'images/agent/';
            $filename = uniqid(date('Hmdysi')) . '_' .  $image->getClientOriginalName();
            $upload =  $request->file('image')->move($path, $filename);
            if ($upload) {
                $image= $path . $filename;
            }
            
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image =   $image;
        $user->phone_number=$request->phone_number;
        $user->about = $request->about;

        $user->save();

         $user_location=new UserLocation();
         $user_location->district_id = $request->district_id;
         $user_location->sub_location= $request->sub_location;
         $user_location->updator_id=Auth::user()->id;
          $user_location->user_id=Auth::user()->id;
         $user_location->save();
        return back();
    }


    
    public function changePassword()
    {
        return view('agent.changepassword');

    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {

            Toastr::error('message', 'Your current password does not matches with the password you provided! Please try again.');
            return redirect()->back();
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){

            Toastr::error('message', 'New Password cannot be same as your current password! Please choose a different password.');
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
        $messages = Message::latest()->where('agent_id', Auth::id())->paginate(10);

        return view('agent.messages.index',compact('messages'));
    }

    public function messageRead($id)
    {
        $message = Message::findOrFail($id);

        return view('agent.messages.read',compact('message'));
    }

    public function messageReplay($id)
    {
        $message = Message::findOrFail($id);

        return view('agent.messages.replay',compact('message'));
    }

    public function messageSend(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'user_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());

        Toastr::success('message', 'Message send successfully.');
        return back();

    }

    public function messageReadUnread(Request $request)
    {
        $status = $request->status;
        $msgid  = $request->messageid;

        if($status){
            $status = 0;
        }else{
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
        $message  = $request->message;
        $name     = $request->name;
        $mailfrom = $request->mailfrom;

        Mail::to($request->email)->send(new Contact($message,$name,$mailfrom));

        Toastr::success('message', 'Mail send successfully.');
        return back();
    }

}
