<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Traits\GenerateUuid;

class CustomPermission extends SpatiePermission
{
    use HasFactory;
    use GenerateUuid;
    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';
}
