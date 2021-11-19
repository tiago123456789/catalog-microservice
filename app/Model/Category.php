<?php

namespace App\Model;

use App\Model\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes, Uuid;

    protected $fillable = ['name', 'description', 'is_active'];   

    protected $dates = ["deleted_at"];

    protected $casts = [
        "id" => "string"
    ];

}
