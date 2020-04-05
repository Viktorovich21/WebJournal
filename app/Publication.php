<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = "publications";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'title', 'description', 'text', 'creator_id', 'stars'
    ];
}
