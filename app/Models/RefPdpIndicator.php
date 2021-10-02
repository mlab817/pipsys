<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPdpIndicator extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(RefPdpIndicator::class,'parent_id');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'description',
        'label',
    ];
}
