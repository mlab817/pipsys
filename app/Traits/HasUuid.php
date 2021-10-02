<?php

namespace App\Traits;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = nanoid(8);
        });
    }
}
