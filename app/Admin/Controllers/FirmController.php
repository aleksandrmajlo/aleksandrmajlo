<?php

namespace App\Admin\Controllers;

use App\Firm;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Controllers\HasResourceActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;
use Illuminate\View\View;

class FirmController extends Controller
{

    use HasResourceActions;
    protected $title = 'Объекты';

    public function index(Content $content)
    {
        return $content
            ->header('Объекты')
            ->description('description')
            ->body($this->grid());
    }

    protected function grid()
    {
        $grid = new Grid(new Firm());
        $grid->column('id', __('ID'))->display(function($id){
            return '<a href="/admin/firms/'.$id.'/edit">'.$id.'</a>';
        })->sortable();
        $grid->column('title', __('Название'))->display(function($title){
            return '<a href="/admin/firms/'.$this->id.'/edit">'.$title.'</a>';
        })->sortable();
        $grid->column('status','Статус')->switch();
        $grid->column('address', __('Адрес'))->sortable();;
//        $grid->column('service', __('Сфера деятельности'))->sortable();;
        $grid->column('phone', __('Телефон'));
        $grid->user()->email('Пользователь');
        $grid->category()->title_ru('Категория');

        $grid->created_at('Добавлено')->sortable();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('title', 'title');
            $filter->like('address', 'address');
            $filter->like('phone', 'phone');
            $filter->equal('category_id', 'Категория')
                ->select(\App\Category::all()->pluck('title_ru', 'id'));
            $filter->equal('user_id', 'Пользователь')
                ->select(\App\User::all()->pluck('email', 'id'));
        });
        return $grid;
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
        $show = new Show(Firm::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('status', __('Статус(активный неактивный)'));
        $show->field('title', __('Название'));
        $show->field('address', __('Адрес'));
        $show->field('service', __('Сфера деятельности'));

        $show->field('phone', __('Телефон'));
        $show->field('email', __('Email'));
        $show->field('site', __('Site'));
//        $show->field('comment', __('Comment'));
        $show->field('location', __('Координаты'));
//        $show->field('area', __('Area'));
//        $show->user()->email();
//        $show->field('slug', __('Slug'));

//        $show->field('meta_title', __('Meta title'));
//        $show->field('meta_description', __('Meta description'));
        $show->field('created_at', __('Добавлено'));
        return $show;
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
        $form = new Form(new Firm());

        $form->switch('status', __('Статус(активный или неактивный)'));
        $form->switch('basic', __('Основная организация в здании'));
        $form->text('title', __('Название'))->required();
        $form->text('address', __('Адрес(Пользователя)'))->required();

        $form->text('address_uk', __('Адрес UK'));
        $form->text('address_ru', __('Адрес RU'));
        $form->text('address_en', __('Адрес EN'));

        $form->text('service', __('Сфера деятельности'))->required();

        $form->select('category_id', 'Категория')->options(\App\Category::all()->pluck('title_ru', 'id'))->required();
        $form->select('user_id', 'Пользователь')->options(User::all()->pluck('email', 'id'))->required();

        $form->mobile('phone', __('Телефон'));
        $form->email('email', __('Email'));
        $form->text('site', __('Site'));

        $form->html(function ()use($id) {
            if($id){
                $firm=Firm::find($id);
                if($firm->time_work){
                    $time_work=$firm->time_work;
                    ob_start();
                    $view = view('admin.timework', ['id' => $id,'time_work'=>$time_work]);
                    echo $view->render()
                    ?>
                    <?php
                    return ob_get_clean();
                }

            }
            return '';
        });
//        $form->textarea('comment', __('Comment'));
        $form->multipleImage('photos', __('Фото'))->removable();
//        $form->textarea('meta_title', __('Meta title'));
//        $form->textarea('meta_description', __('Meta description'));
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }

}
