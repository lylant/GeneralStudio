<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\CourseListLayout;
use App\Models\Course;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CourseListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Offered Courses';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All courses';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'courses' => Course::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.course.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            CourseListLayout::class
        ];
    }
}