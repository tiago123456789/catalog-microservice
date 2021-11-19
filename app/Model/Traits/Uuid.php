<?php 

namespace App\Model\Traits;

use Ramsey\Uuid\Uuid as RamseyUuid;

trait Uuid {

    public static function boot() {
        parent::boot();
        static::creating(function($object) {
            $object->id = RamseyUuid::uuid4();
        });
    }
}