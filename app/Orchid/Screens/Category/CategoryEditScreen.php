<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;


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

class CategoryEditScreen extends Screen
{

    public $name = 'Creating a new category';

    /**
     * Display header content.
     *
     * @var string
     */
    public $content = 'Creating a new Category';
    /**
     * @var bool
     */
    public $exists = false;


    public function query(Category $category): array
    {
        $this->exists=$category->exists;
        if ($this->exists)
        {
            $this->name='Edit Category';
        }
        return [
            'category'=>$category,
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
            Button::make('Create Category')
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
                Input::make('category.name')
                    ->title('Name')
                    ->required()
                    ->placeholder('Category name')
                    ->help('Specify The Category name.'),
                TextArea::make('category.description')
                    ->title('Description')
                    ->rows(6)
                    ->placeholder('Category description')
                    ->help('Specify The Category description.'),
                Picture::make('category.image')
                    ->title('Image')
                    ->width(800)
                    ->height(800)
                    ->horizontal()
                    ->placeholder('Category image')
                    ->help('Specify The Category description.'),

            ]),

        ];


    }
    public function createOrUpdate(Category $category, Request $request): RedirectResponse
    {
        $request->validate([
            'category.name'=>'required|string',
            'category.description'=>'required|string',
            'category.image'=>'nullable'
        ]);
        $category->fill($request->get('category'));
        $category->save();

        Alert::info('You have successfully updated a category.');

        return redirect()->route('platform.categories.list');
    }

    /**
     * @param Category $category
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(Category $category)
    {
        $category->delete()
            ? Alert::info('You have successfully deleted the category.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.categories.list');
    }

}
