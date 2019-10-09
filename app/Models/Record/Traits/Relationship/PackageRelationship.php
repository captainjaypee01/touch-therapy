<?php

namespace App\Models\Record\Traits\Relationship;

use App\Models\Record\Service; 
 
/**
 * Class PackageRelationship.
 */
trait PackageRelationship
{
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    
}
