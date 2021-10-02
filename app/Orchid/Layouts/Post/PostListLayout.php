<?php

namespace App\Orchid\Layouts\Post;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

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

                ->render(function ($post) {
                    return Link::make($post->id)
                        ->route('platform.posts.edit',[$post->id]);
                }),

            TD::make('title','Post title')
                ->width('100px')
                ->sort()->filter(TD::FILTER_TEXT)

                ->render(function ($post) {
                    return Link::make($post->title)
                        ->route('platform.posts.edit',[$post->id]);
                }),

            TD::make('img','Post image')
                ->width('200px')
                ->align('center')
                ->render(function ($object){
                   return view('image',[
                       'object'=>$object
                   ]);
                }),

            TD::make('description', 'Post description')
                ->width('100px')
                ->sort()->filter(TD::FILTER_TEXT)
                ->render(function ($post) {
                    return Link::make(\Str::limit($post->description,30))
                        ->route('platform.posts.edit', [$post->id]);
                }),


        ];
    }
}
