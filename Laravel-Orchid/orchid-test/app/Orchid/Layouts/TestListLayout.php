<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\DBTest;
use Orchid\Screen\Actions\Link;


class TestListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    public $target = 'table_test';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD:make('course', 'Course Name')
                ->render(function (DBTest $dbtest) {
                    return Link::make($dbtest->course)
                        ->route('platform.dbtest.edit', $dbtest);
                }),

                TD::make('created_at', 'Created'),
                TD::make('updated_at', 'Last edit'),
        ];
    }
}
