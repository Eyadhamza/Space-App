<?php

namespace App\Orchid\Screens\Post;


use App\Models\Post;
use App\Orchid\Layouts\Post\PostListLayout;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use App\Orchid\Layouts\User\UserFiltersLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PostListScreen extends Screen
{

    public $name = 'All posts';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Posts';
    /**
     * @var bool
     */
    public $exists = false;



    public function query(): array
    {

        return [

            'posts'=>Post::paginate(10)
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

            Button::make('Add Post')
                ->icon('plus')
                ->method('addPost')

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [

            PostListLayout::class,
        ];

    }
    public function addPost()
    {
       return redirect()->route('platform.posts.edit');
    }

}
