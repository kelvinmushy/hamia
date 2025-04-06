<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySocialMedia extends Model
{
   
  protected $fillable = [
        'company_id', 'url','social_media_id','creator_id','updator_id'
    ];
    
      public function social_media(){
        return $this->belongsTo('App\Models\SocialMedia','social_media_id');
      }

}
