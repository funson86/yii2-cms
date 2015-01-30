<?php
namespace funson86\cms\widgets;

use yii\base\Widget;

class Contact extends Widget
{
    public $title;
    public $content;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('contact', [
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}