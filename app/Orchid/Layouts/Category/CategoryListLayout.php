<?php

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id','ID')
                ->width('100px')
                ->sort()->filter(TD::FILTER_NUMERIC)

                ->render(function ($category) {
                    return Link::make($category->id)
                        ->route('platform.categories.edit',[$category->id]);
                }),

            TD::make('name','Category name')
                ->width('100px')
                ->sort()->filter(TD::FILTER_TEXT)

                ->render(function ($category) {
                    return Link::make($category->name)
                        ->route('platform.categories.edit',[$category->id]);
                }),

            TD::make('description', 'Category description')
                ->width('100px')
                ->sort()->filter(TD::FILTER_TEXT)
                ->render(function ($category) {
                    return Link::make(\Str::limit($category->description,30))
                        ->route('platform.categories.edit', [$category->id]);
                }),

            TD::make('img','Category Image')
                ->width('200px')
                ->align('center')
                ->render(function ($object){
                    return view('image',[
                        'object'=>$object
                    ]);
                }),

        ];
    }
}
