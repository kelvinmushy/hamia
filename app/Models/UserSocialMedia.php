<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialMedia extends Model
{
   
  protected $fillable = [
        'user_id', 'url','social_media_id','creator_id','updator_id'
    ];
    
      public function social_media(){
        return $this->belongsTo('App\Models\SocialMedia','social_media_id');
      }

}
