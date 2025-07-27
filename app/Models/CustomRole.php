<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\GenerateUuid;

class CustomRole extends SpatieRole
{
    use HasFactory;

    use GenerateUuid;
    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';
}
