<?php

namespace app\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * Class SiteidBehavior
 * @package app\behaviors
 */
class SiteidBehavior extends AttributeBehavior
{
    /**
     * @inheritdoc
     */
    public $attributes = [BaseActiveRecord::EVENT_INIT => 'site_id'];

    /**
     * @inheritdoc
     */
    public $value;

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        return $this->value !== null ? $this->value : Yii::$app->id;
    }
}
