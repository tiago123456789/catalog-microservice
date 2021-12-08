<?php

namespace App\Model;

use App\Model\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes, Uuid;

    const RATING = ["L", "10", "12", "14", "16", "18"];

    protected $table = "videos";

    protected $fillable = [
        'duration', 'title', 'description',
        'year_launched', "opened", "rating"
    ];  

    protected $hidden = ["deleted_at", "created_at", "updated_at"];
    
    protected $casts = [
        "id" => "string"
    ];
}
