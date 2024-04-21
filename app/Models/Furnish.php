<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Furnish extends Model
{
    protected $fillable = ['name','slug'];

    
    public function properties()
    {
        return $this->belongsToMany(Property::class)->withTimestamps();
    }

     
    public function propertyFurnish()
    {
        return $this->hasMany('App\Models\PropertyFurnish', 'furnish_id');
    }
 

    public function propertyFurnishCount($slug,$id){
         
        $count=DB::table('sub_categories')
              ->join('properties','sub_categories.id','properties.sub_category_id')
              ->join('property_furnishes','property_furnishes.property_id','properties.id')
              ->where('sub_categories.slug',$slug)
              ->where('property_furnishes.furnish_id',$id)
              ->count();
        //$cat=propertyfurnish::where('furnish_id',$id)->get(); 
        
        return $count;

     }
}
