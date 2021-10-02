<?php

namespace App\Orchid\Screens\Category;


use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryListLayout;
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

class CategoryListScreen extends Screen
{

    public $name = 'All categories';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Categories';
    /**
     * @var bool
     */
    public $exists = false;



    public function query(): array
    {

        return [

            'categories'=>Category::paginate(10)
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

            Button::make('Add Category')
                ->icon('plus')
                ->method('addCategory')

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

            CategoryListLayout::class,
        ];

    }
    public function addCategory()
    {
       return redirect()->route('platform.categories.edit');
    }

}
