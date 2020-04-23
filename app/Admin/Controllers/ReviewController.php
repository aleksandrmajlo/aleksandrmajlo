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

        $grid->column('id', __('Id'));
        $grid->column('status')->switch();
        $grid->firm()->title();
        $grid->user()->email();
        $grid->column('comment', __('Comment'));
        $grid->column('value', __('Оценка'));
        $grid->column('created_at', __('Created at'));
        $grid->ip('ip', __('Ip'));

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
        $show->field('id', __('Id'));
        $show->field('comment', __('Comment'));
        $show->field('value', __('Value'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('status', __('Status'));
        $show->field('ip', __('Ip'));
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
        $form->switch('status', __('Status'));
        $form->textarea('comment', __('Comment'));
        $form->number('value', __('Оценка'))->min(0)->max(5);
        $form->multipleImage('photos', __('Photos'))->removable();

        $form->select('user_id', 'Пользователь')->options(\App\User::all()->pluck('email', 'id'));
        $form->select('firm_id', 'Объект')->options(\App\Firm::all()->pluck('title', 'id'));


        $form->ip('ip', __('Ip'));
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
