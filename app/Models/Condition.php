<?php

namespace App\Models;
use App\Models\Property;
use App\Models\SubCategory;
use App\Models\propertyCondition;
use Illuminate\Database\Eloquent\Model;
use DB;
class Condition extends Model
{
    protected $fillable = ['name','slug'];

    
    public function propertyCondition()
    {
        return $this->hasMany('App\Models\PropertyCondition', 'condition_id');
    }

    public function property()
    {
        return $this->hasMany('App\Models\Property', '_id');
    }
   
     public function propertyConditionCount($slug,$id){
         
        $count=DB::table('sub_categories')
              ->join('properties','sub_categories.id','properties.sub_category_id')
              ->join('property_conditions','property_conditions.property_id','properties.id')
              ->where('sub_categories.slug',$slug)
              ->where('property_conditions.condition_id',$id)
              ->count();
        //$cat=propertyCondition::where('condition_id',$id)->get(); 
        
        return $count;

     }
  
}
