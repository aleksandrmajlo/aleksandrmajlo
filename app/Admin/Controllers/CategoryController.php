<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Firm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Controllers\HasResourceActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;
use Illuminate\View\View;

class CategoryController extends Controller
{

    use HasResourceActions;
    protected $title = 'Категории';

    public function index(Content $content)
    {
        return $content
            ->header('Категории')
            ->description('description')
            ->body($this->grid());
    }

    protected function grid()
    {
        $grid = new Grid(new  Category());
        $grid->column('id', __('Id'))->display(function ($id) {
            return '<a href="/admin/categories/' . $id . '/edit">' . $id . '</a>';
        })->sortable();
        $grid->column('published','Статус')->switch();
        $grid->column('timeworkstatus', __('Скрыть режим работы'))->switch();

        $grid->column('title_uk','Название UK')->sortable();
        $grid->column('title_ru','Название RU')->sortable();
        $grid->column('title_en','Название EN')->sortable();


        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
        });
        return $grid;
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('Редактировать')
            ->description('')
            ->body($this->form(true, $id)->edit($id));
    }

    public function create(Content $content)
    {
        return $content
            ->header('Добавить')
            ->description('')
            ->body($this->form());
    }

    protected function form($edit = false, $id = null)

    {
        $form = new Form(new Category());

        $form->switch('published', __('Статус(активный неактивный)'));
        $form->switch('timeworkstatus', __('Скрыть режим работы'));


        $form->text('title_uk','Название UK');
        $form->text('title_ru','Название RU');
        $form->text('title_en','Название EN');
        return $form;
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('')
            ->body($this->detail($id));
    }

    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));
        $show->field('id', __('Id'));


        $show->field('title_uk','Название UK');
        $show->field('title_ru','Название RU');
        $show->field('title_en','Название EN');

        return $show;

    }


    /*
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'));
        $grid->column('published', __('Published'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }


    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('published', __('Published'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }


    protected function form()
    {
        $form = new Form(new Category());

        $form->number('published', __('Published'));

        return $form;
    }

    */
}
