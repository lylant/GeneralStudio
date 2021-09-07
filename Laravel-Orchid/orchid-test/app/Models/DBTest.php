<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class DBTest extends Model
{
    use AsSource;


    /**
     * @var array
     */
    protected $fillable = [
        'course',
        'university',
        'year'
    ];

}