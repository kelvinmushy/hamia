<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Property extends Model
{
    protected $fillable = [
        'title',    'price',     
        'featured',  'type_id','image',
        'company_id',     'description',   
        'category_id','term_id','currency_id','sub_category_id'
        
    ];

 

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function gallery()
    {
        return $this->hasMany(PropertyImageGallery::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'property_id');
    }

    public function title()
    {
        return  $this->belongsTo('App\Models\PropertyTitle', 'title_id');
    }
    public function category()
    {
        return  $this->belongsTo('App\Models\Category', 'category_id');
    }
      public function currency()
    {
        return  $this->belongsTo('App\Models\Currency', 'currency_id');
    }
    public function type()
    {
        return  $this->belongsTo('App\Models\PropertyType', 'type_id');
    }
    public function purpose()
    {
        return  $this->belongsTo('App\Models\PropertyPurpose', 'purpose_id');
    }
    public function property_location(){
        
        return $this->hasOne('App\Models\PropertyLocation','property_id');
    }
    public function property_near_by()
    {
        return $this->hasMany( 'App\Models\PropertyNearBy', 'property_id');
    }
    public function bead_room()
    {
        return  $this->hasOne('App\Models\PropertyBeadRoom', 'property_id');
 
    }

    public function property_barth()
    {
        return  $this->hasOne('App\Models\PropertyBarth', 'property_id');
    }
    public function property_area()
    {
        return  $this->hasOne('App\Models\PropertyArea', 'property_id');
    }
    public function property_currency()
    {
        return  $this->belongsTo('App\Models\PropertyCurrency', 'currency_id');
    }

    public function property_term()
    {
        return  $this->hasOne('App\Models\PropertyTerm', 'property_id');
    }

    public function property_gallery(){
    
        return  $this->hasMany('App\Models\PropertyImageGallery', 'property_id');
    }

      public function sub_category()
    {
        return  $this->belongsTo('App\Models\SubCategory', 'sub_category_id');
    }
       public function property_features()
    {
         return  $this->hasMany('App\Models\FeatureProperty', 'property_id');
      
    }


    public function propertyFurnish()
    {
      
        return  $this->hasOne('App\Models\PropertyFurnish', 'property_id');
    }

    public function propertyCondition()
    {
      
        return  $this->hasOne('App\Models\PropertyCondition', 'property_id');
    }
}



