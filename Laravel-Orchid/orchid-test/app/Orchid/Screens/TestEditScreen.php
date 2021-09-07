<?php

namespace App\Orchid\Screens;

use App\Models\DBTest;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;


class TestEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new record';


    /**
     * Display header description.
     * 
     * @var string
     */
    public $description = 'DB Test';


    /**
     * @var bool
     */
    public $exists = false;


    /**
     * Query data.
     * 
     * @param DBTest $dbtest
     *
     * @return array
     */
    public function query(DBTest $dbtest): array
    {
        $this->exists = $dbtest->exists;

        if($this->exists) {
            $this->name = 'Edit record?';
        }

        return [
            'edittest' => $dbtest
        ];
    }


    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create record')
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
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('dbtest.course')
                    ->title('Course')
                    ->placeholder('Course name?')
                    ->help('Specify a name of course'),
                
                TextArea::make('dbtest.university')
                    ->title('Univ')
                    ->placeholder('Which univ?')
                    ->maxlength(30),

                Input::make('dbtest.year')
                    ->mask('9999')
                    ->title('Year')
                    ->placeholder('offered year')
                    ->help('Offered year what'),
            ])
        ];
    }


      /**
     * @param DBTest  $dbtest
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(DBTest $dbtest, Request $request)
    {
        $dbtest->fill($request->get('edittest'))->save();

        Alert::info('You have successfully created an record.');

        return redirect()->route('platform.dbtest.list');
    }

    /**
     * @param DBTest $dbtest
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(DBTest $dbtest)
    {
        $dbtest->delete();

        Alert::info('You have successfully deleted the record.');

        return redirect()->route('platform.dbtest.list');
    }
}
