<?php

namespace App\Models\Record\Traits\Relationship;
use App\Models\Record\Package;
 
/**
 * Class ServiceRelationship.
 */
trait ServiceRelationship
{
    
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
