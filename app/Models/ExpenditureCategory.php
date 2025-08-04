<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($expenditure_category_id)
 */
class ExpenditureCategory extends Model
{
    use GenerateUuid;
    use SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';


    protected $fillable = [
        'code',
        'name',
        'description',
        'organisation_id',
        'updated_by'
    ];


    public function expenditureItem()
    {
        return $this->hasMany(ExpenditureItem::class);
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
}
