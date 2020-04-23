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
        $grid->column('id', __('Id'))->sortable();

        $grid->column('status')->switch();

        $grid->column('title', __('Название'))->sortable();;
        $grid->column('address', __('Адрес'))->sortable();;
        $grid->column('service', __('Сервис'))->sortable();;
        $grid->column('phone', __('Phone'));
        $grid->column('email', __('Email'));
        $grid->column('site', __('Site'));
        $grid->column('location', __('Location'));
        $grid->user()->email();

        $grid->created_at()->sortable();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('title', 'title');
            $filter->like('address', 'address');
            $filter->like('phone', 'phone');
            $filter->equal('user_id', 'Пользователь')
                ->select(\App\User::all()->pluck('email', 'id'));
        });
        return $grid;
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    protected function detail($id)
    {
        $show = new Show(Firm::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('address', __('Address'));
        $show->field('service', __('Service'));
        $show->field('type', __('Type'));
        $show->field('phone', __('Phone'));
        $show->field('email', __('Email'));
        $show->field('site', __('Site'));
        $show->field('comment', __('Comment'));
        $show->field('location', __('Location'));
        $show->field('area', __('Area'));
//        $show->user()->email();
        $show->field('slug', __('Slug'));
        $show->field('status', __('Status'));
//        $show->field('meta_title', __('Meta title'));
//        $show->field('meta_description', __('Meta description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));


        return $show;
    }


    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form(true, $id)->edit($id));
    }

    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    protected function form($edit = false, $id = null)

    {
        $form = new Form(new Firm());

        $form->switch('status', __('Status'));
        $form->text('title', __('Название'))->required();
        $form->text('address', __('Адрес'))->required();
        $form->text('service', __('Service'))->required();


        $form->radio('type', __('Тип'))->options(['1' => 'Коммерческая организация', '2' => 'Жилой дом'])->required();

        $form->select('user_id', 'Пользователь')->options(User::all()->pluck('email', 'id'));
        $form->mobile('phone', __('Phone'));
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
        $form->multipleImage('photos', __('Photos'))->removable();
//        $form->text('location', __('Location'));


//        $form->textarea('meta_title', __('Meta title'));
//        $form->textarea('meta_description', __('Meta description'));

        $form->disableCreatingCheck();
        $form->disableViewCheck();

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
    /*






    protected function form()
    {
        $form = new Form(new Firm());

        $form->text('title', __('Название'))->required();
        $form->text('address', __('Адрес'))->required();
        $form->text('service', __('Service'))->required();

//        $form->number('type', __('Type'));
        $form->radio('type', __('Тип'))->options(['1' => 'Коммерческая организация', '2'=> 'Жилой дом'])->required();

        $form->mobile('phone', __('Phone'));
        $form->email('email', __('Email'));
        $form->text('site', __('Site'));

        $form->html(function (){

            return '1211';
        });


//        $form->text('time_work', __('Time work'));
//        $form->textarea('comment', __('Comment'));
//        $form->textarea('photos', __('Photos'));
//        $form->text('location', __('Location'));
//        $form->text('area', __('Area'));
//        $form->number('user_id', __('User id'));
//        $form->textarea('slug', __('Slug'));
//        $form->textarea('meta_title', __('Meta title'));
//        $form->textarea('meta_description', __('Meta description'));
//        $form->switch('status', __('Status'));


        return $form;
    }
    */
}
