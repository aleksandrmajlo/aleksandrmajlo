<?php

namespace App\Admin\Controllers;

use App\Photo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhotoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Photos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Photo());

        $grid->column('id', __('Id'));
        $grid->column('photos')->display(function ($photos) {
            return $photos;
        })->image('', 100, 100);
        $grid->column('status')->switch();
        $grid->firm()->title();
        $grid->user()->email();
        $grid->column('created_at', __('Created at'));

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
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
        $show = new Show(Photo::findOrFail($id));

        $show->field('id', __('Id'));
//        $show->field('photos', __('Photos'));
        $show->field('user_id', __('User id'));
        $show->field('firm_id', __('Firm id'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Photo());
        $form->switch('status', __('Status'));
        $form->multipleImage('photos', __('Photos'));

        $form->select('user_id', 'Пользователь')->options(\App\User::all()->pluck('email', 'id'));
        $form->select('firm_id', 'Объект')->options(\App\Firm::all()->pluck('title', 'id'));
        return $form;
    }
}
