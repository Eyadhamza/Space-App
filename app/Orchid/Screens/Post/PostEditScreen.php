<?php

namespace App\Orchid\Screens\Post;

use App\Models\Category;
use App\Models\Event;
use App\Models\Post;


use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PostEditScreen extends Screen
{

    public $name = 'Creating a new post';

    /**
     * Display header content.
     *
     * @var string
     */
    public $content = 'Creating a new Post';
    /**
     * @var bool
     */
    public $exists = false;


    public function query(Post $post): array
    {
        $this->exists=$post->exists;
        if ($this->exists)
        {
            $this->name='Edit Post';
        }
        return [
            'post'=>$post
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
            Button::make('Create Post')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->confirm('are you sure you want to delete?')
                ->method('remove')
                ->canSee($this->exists),

            Button::make('Save')
                ->icon('check')
                ->method('createOrUpdate')
                ->canSee($this->exists),



        ];
    }


    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('post.title')
                    ->title('Name')
                    ->required()
                    ->placeholder('Post title')
                    ->help('Specify The Post title.'),

                Relation::make('post.categories.')
                    ->fromModel(Category::class,'name')
                    ->multiple()
                    ->title('Related Categories'),

                Quill::make('post.description')
                    ->title('Description')
                    ->required()
                    ->placeholder('Post description')
                    ->help('Specify The Post description.'),

                Picture::make('post.image')
                    ->title('Cover')
                    ->required()
                    ->width(800)
                    ->height(800)
                    ->horizontal()
                    ->placeholder('Post image')
                    ->help('Specify The Post description.'),

            ]


            )
        ];


    }
    public function createOrUpdate(Post $post, Request $request): RedirectResponse
    {
        $data=$request->validate([
            'post.title'=>'required|string',
            'post.description'=>'required|string',
            'post.image'=>'nullable',
            'categories.' => 'nullable',

        ]);
        $post->fill($request->get('post'));
        $post->categories()->sync(request('post.categories'));
        $post->save();

        Alert::info('You have successfully updated a post.');

        return redirect()->route('platform.posts.list');
    }

    /**
     * @param Post $post
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(Post $post)
    {
        $post->delete()
            ? Alert::info('You have successfully deleted the post.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.posts.list');
    }

}
