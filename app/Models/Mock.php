<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mock extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'title',
        'name',
        'lastname',
        'organization'
    ];
}
 