<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel naming convention)
    protected $table = 'project_locations';

    // Mass assignable attributes
    protected $fillable = [
        'project_id',
        'region_id',
        'district_id',
        'sub_location',
    ];

    /**
     * Relationship: Each location belongs to a project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relationship: Each location belongs to a region
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Relationship: Each location belongs to a district
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the full address of the project location
     */
    public function getFullAddressAttribute()
    {
        return "{$this->sub_location}, {$this->district->name}, {$this->region->name}";
    }
}
