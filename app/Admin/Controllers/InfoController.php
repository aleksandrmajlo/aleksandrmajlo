<?php

namespace App\Admin\Controllers;

use App\Info;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Info';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Info());

        $grid->column('id', __('Id'));

        $grid->column('theme', 'Тема')->display(function ($themeId)  {
            $theme = config('info');
            return $theme[$themeId];
        });

        $grid->column('email', __('Email'));
        $grid->column('messange', __('Messange'));
        $grid->column('status', __('Ответ клиенту'));
        $grid->column('created_at', __('Created at'));
        $grid->column('ip', __('IP'));

        $grid->filter(function ($filter) {
            $theme = config('info');
            $filter->disableIdFilter();
            $filter->like('email', 'email');
            $filter->like('messange', 'messange');
            $filter->equal('theme', 'Тема')
                ->select($theme);
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
        $show = new Show(Info::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('theme', __('Theme'));
        $show->field('email', __('Email'));
        $show->field('messange', __('Messange'));
        $show->field('photos', __('Photos'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('ip', __('IP'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $theme = config('info');

        $form = new Form(new Info());

        $form->switch('status', 'Ответ клиенту');

        $form->select('theme', 'Тема')->options($theme)->readOnly();
        $form->email('email', __('Email'))->readonly();
        $form->textarea('messange', __('Messange'))->readonly();
        $form->multipleImage('photos', __('Photos'));

        $form->ip('ip', __('IP'));

        return $form;
    }
}
