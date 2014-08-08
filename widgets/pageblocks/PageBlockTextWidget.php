<?php

namespace app\widgets\pageblocks;

use Yii;
use yii\base\Widget;

class PageBlockTextWidget extends Widget
{
    public $content;

    public $view = 'paragraph';

    public $widgetParams = [
        'content' => 'text',
    ];

    public function run()
    {
        return $this->render($this->view, ['content' => $this->content]);
    }
}
