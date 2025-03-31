<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use DB;

class User extends Authenticatable  implements MustVerifyEmail
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'username', 'image', 'about','google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function hasRole()
    {
        return $this->role->name;
    } 

      public function user_location()
    {
        return  $this->hasOne('App\Models\UserLocation', 'user_id');
    }
    
        public function agent_property()
    {
        return  $this->hasMany('App\Models\Property', 'agent_id');
    }

    public function user_social_media()
    {
        return  $this->hasMany('App\Models\UserSocialMedia', 'user_id');
    }

    public function totalAdd($id){
        $total=DB::table('properties')->where('agent_id',$id)->count();
        return $total;
    }

     public function totalRent($id){
        $total=DB::table('properties')->where('purpose_id',1)->where('agent_id',$id)->count();
        return $total;
    }
     public function totalSale($id){
        $total=DB::table('properties')->where('purpose_id',2)->where('agent_id',$id)->count();
        return $total;
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
    

}
