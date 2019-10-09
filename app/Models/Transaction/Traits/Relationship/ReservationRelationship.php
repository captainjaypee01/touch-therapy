<?php

namespace App\Models\Transaction\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Record\Service;
use App\Models\Record\Package;

/**
 * Class ReservationRelationship.
 */
trait ReservationRelationship
{
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
