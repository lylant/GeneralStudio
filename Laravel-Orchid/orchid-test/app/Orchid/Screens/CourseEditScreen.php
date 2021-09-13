<?php

namespace App\Orchid\Screens;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;


class CourseEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new course';


    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'university courses';


    /**
     * @var bool
     */
    public $exists = false;


    /**
     * Query data.
     *
     * @param Course $course
     *
     * @return array
     */
    public function query(Course $course): array
    {
        $this->exists = $course->exists;

        if($this->exists){
            $this->name = 'Edit course';
        }

        return [
            'course' => $course
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
            Button::make('Create course')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('course.name')
                    ->title('Name')
                    ->placeholder('Course Name')
                    ->help('Specify an official name of this course.'),

                Select::make('course.level')
                    ->title('Level')
                    ->options([1, 2, 3, 4]),

                Input::make('course.price')
                    ->type('number')
                    ->title('Price'),

                Input::make('course.institution')
                    ->title('Institution')
                    ->placeholder('Institution Name')
                    ->help('Specify an official name of the offering instutition.'),
            ])
        ];
    }

    /**
     * @param Course  $course
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Course $course, Request $request)
    {
        $course->fill($request->get('course'))->save();

        Alert::info('You have successfully created an course.');

        return redirect()->route('platform.course.list');
    }

    /**
     * @param Course $course
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Course $course)
    {
        $course->delete();

        Alert::info('You have successfully deleted the course.');

        return redirect()->route('platform.course.list');
    }
}