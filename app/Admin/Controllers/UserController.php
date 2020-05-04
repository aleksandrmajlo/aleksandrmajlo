<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
        $grid->column('id', __('ID'))->display(function($id){
            return '<a href="/admin/users/'.$id.'/edit">'.$id.'</a>';
        })->sortable();
        $grid->column('email', __('Email'))->display(function($title){
            return '<a href="/admin/users/'.$this->id.'/edit">'.$title.'</a>';
        })->sortable();
        $grid->column('status','Статус')->switch();
        $grid->column('name', __('Имя'));

        $grid->column('created_at', __('Дата регистрации'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Имя'));
        $show->field('email', __('Email'));
        $show->field('created_at', __('Дата регистрации'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->switch('status', __('Статус'));
        $form->text('name', __('Имя'));
        $form->email('email', __('Email'));
        $form->password('password', __('Пароль'));

        return $form;
    }
}
