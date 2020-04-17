<?php

namespace App\Admin\Controllers;

use App\Banner;
use App\Http\Controllers\Controller;
use Couchbase\Document;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BannerController extends Controller
{

    use HasResourceActions;

    public function index(Content $content)
    {
        return $content
            ->header('Баннера')
            ->description(' ')
            ->row(function (Row $row) {
                $tab = new Tab();

                $banner = Banner::find(1);
                $form = new Form();
                if (!empty($banner->photobig)) {
                    $form->html('<div class="text-center"><img class="img-thumbnail" src="' . $banner->photobig . '"></div>');
                }
                $form->image('photobig', 'Image')->removable()->default($banner->photobig);
                $form->text('link', 'Link')->default($banner->link);
                $form->textarea('description', 'Текст')->default($banner->description);
                $form->hidden('id'  )->default(1);
                ob_start();
                ?>
                <style type="text/css">
                    .box-footer {
                        background: inherit !important;
                        border: none !important;
                    }

                    div.pull-left button {
                        display: none !important;
                    }
                </style>
                <?php
                $form->html(ob_get_clean());
                $form->action('banners')->disablePjax();
                $tab->add('Баннер на главной странице', $form->render());

                $banner = Banner::find(2);
                $form = new Form();
                if (!empty($banner->photobig)) {
                    $form->html('<div class="text-center"><img class="img-thumbnail" src="' . $banner->photobig . '"></div>');
                }
                $form->image('photobig', 'Image')->removable()->default($banner->photobig);
                $form->text('link', 'Link')->default($banner->link);
                $form->textarea('description', 'Текст')->default($banner->description);
                $form->hidden('id'  )->default(2);
                $form->action('banners')->disablePjax();
                $tab->add('Баннер top small', $form->render());

                $banner = Banner::find(3);
                $form = new Form();
                if (!empty($banner->photobig)) {
                    $form->html('<div class="text-center"><img class="img-thumbnail" src="' . $banner->photobig . '"></div>');
                }
                $form->image('photobig', 'Image')->removable()->default($banner->photobig);
                $form->text('link', 'Link')->default($banner->link);
                $form->textarea('description', 'Текст')->default($banner->description);
                $form->hidden('id'  )->default(3);
                $form->action('banners')->disablePjax();
                $tab->add('Баннер bottom small', $form->render());

                $row->column(12, $tab);

            });

    }

    public function update(Request $request)
    {

        $photos_path = public_path('/upload/banner');

        $banner = Banner::find($request->id);

        $banner->link = $request->link;
        $banner->description = $request->description;
        if ($request->hasFile('photobig')) {

            $file = $request->file('photobig');
            $name = sha1(date('YmdHis') . Str::random(20));
            $save_name = $name . '.' . $file->getClientOriginalExtension();
            $resize_name = $name . 'x500.' . $file->getClientOriginalExtension();
            Image::make($file)
                ->resize(500, null, function ($constraints) {
                    $constraints->aspectRatio();
                })
                ->save($photos_path . '/' . $resize_name);
            $file->move($photos_path, $save_name);
            $banner->photobig = '/upload/banner/' . $save_name;
            $banner->photosmall = '/upload/banner/' . $resize_name;
        }
        $banner->save();
        return redirect()->back()->with('message', 'Update!');
    }

    /*
    protected $title = 'App\Banner';


    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('photobig', __('Photobig'));
        $grid->column('photosmall', __('Photosmall'));
        $grid->column('link', __('Link'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }


    protected function detail($id)
    {
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('photobig', __('Photobig'));
        $show->field('photosmall', __('Photosmall'));
        $show->field('link', __('Link'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Banner());

        $form->textarea('photobig', __('Photobig'));
        $form->textarea('photosmall', __('Photosmall'));
        $form->textarea('link', __('Link'));
        $form->textarea('description', __('Description'));

        return $form;
    }
    */
}
