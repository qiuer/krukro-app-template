<?php
use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model app\models\Page
 */
$this->title = $model->title_ru;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-page">
    <h1><?= Html::encode($this->title); ?></h1>
    <?= $model->content_ru; ?>
</div>