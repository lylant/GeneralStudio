<?php

// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Course extends Model
{
    use AsSource, Attachable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'level',
        'price',
        'institution'
    ];


    /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'level',
        'price',
        'institution',
        'created_at',
        'updated_at'
    ];


    /**
     * Name of columns to which http filter can be applied
     *
     * @var array
     */
    protected $allowedFilters = [
        'name',
        'institution',
    ];
}