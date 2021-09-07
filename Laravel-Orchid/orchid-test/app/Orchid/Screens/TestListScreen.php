<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\TestListLayout;
use App\Models\DBTest;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;


class TestListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'DBTest Lists';

    public $description = 'All records';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'listtest' => DBTest::paginate()
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.dbtest.edit')
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
            TestListLayout::class
        ];
    }
}
