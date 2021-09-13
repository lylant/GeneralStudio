<?php

namespace App\Orchid\Layouts;

use App\Models\Course;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class CourseListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'courses';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Course $course) {
                    return Link::make($course->name)
                        ->route('platform.course.edit', $course);
                }),
            TD::make('level', 'Level')
                ->sort(),
            TD::make('price', 'Price')
                ->sort(),
            TD::make('institution', 'Institution')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('created_at', 'Created')
                ->sort(),
            TD::make('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}