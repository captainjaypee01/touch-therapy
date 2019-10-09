<?php

namespace App\Models\Record;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record\Traits\Attribute\PackageAttribute;
use App\Models\Record\Traits\Relationship\PackageRelationship;

class Package extends Model
{
    use SoftDeletes,
        PackageAttribute,
        PackageRelationship;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $primaryKey  = 'id';
    protected $fillable = [ 
        'id',
        'price',
        'name', 
        'status', 
    ];
}
