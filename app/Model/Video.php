<?php

namespace App\Model;

use App\Model\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes, Uuid;

    const RATING = ["L", "10", "12", "14", "16", "18"];

    protected $fillable = ['name', 'description', 'is_active'];   

}
