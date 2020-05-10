<?php

namespace App\Admin\Controllers;

use App\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Отзывы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());


        $grid->column('id', __('ID'))->display(function($id){
            return '<a href="/admin/reviews/'.$id.'/edit">'.$id.'</a>';
        })->sortable();


        $grid->column('status','Cтатус')->switch();
        $grid->firm()->title('Объект');
        $grid->user()->email('Пользователь');
        $grid->column('comment', __('Комментарий'));
        $grid->column('value', __('Оценка'));
        $grid->column('created_at', __('Дата добавления'));
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('comment', 'comment');
            $filter->equal('user_id', 'Пользователь')
                ->select(\App\User::all()->pluck('email', 'id'));
            $filter->equal('firm_id', 'Объект')
                ->select(\App\Firm::all()->pluck('title', 'id'));
        });
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
        $show = new Show(Review::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('comment', __('Comment'));
        $show->field('value', __('Оценка'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Дата добавления'));
        $show->field('status', __('Cтатус'));
        $show->field('ip', __('IP'));
        $show->field('firm_id', __('Firm id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Review());
        $form->switch('status', __('Cтатус'));
        $form->textarea('comment', __('Комментарий'));
        $form->number('value', __('Оценка'))->min(0)->max(5)->required();
        $form->multipleImage('photos', __('Фото'))->removable();

        $form->select('user_id', 'Пользователь')->options(\App\User::all()->pluck('email', 'id'))->required();
        $form->select('firm_id', 'Объект')->options(\App\Firm::all()->pluck('title', 'id'))->required();


        $form->ip('ip', __('IP'));
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
