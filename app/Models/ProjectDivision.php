<?php
  
  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  
  class ProjectDivision extends Model
  {
      use HasFactory;
  
      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'name', 'project_id', 'land_type', 'size', 'sell_price', 'creator_id', 'updator_id','division_type'
      ];
  
      /**
       * Get the project that owns the project division.
       */
      public function project()
      {
          return $this->belongsTo(Project::class);
      }
  }
  