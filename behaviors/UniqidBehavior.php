<?php

namespace app\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

/**
 * Class UniqidBehavior
 * @package app\behaviors
 */
class UniqidBehavior extends AttributeBehavior
{
    /**
     * @var string prefix
     */
    public $prefix = '';

    /**
     * @var bool add additional entropy
     */
    public $moreEntropy = false;

    /**
     * @inheritdoc
     */
    public $attributes = [BaseActiveRecord::EVENT_INIT => 'id'];

    /**
     * @inheritdoc
     */
    public $value;

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        return $this->value !== null ? $this->value : uniqid($this->prefix, $this->moreEntropy);
    }

    /**
     * Updates a timestamp attribute to the current timestamp.
     *
     * ```php
     * $model->touch('lastVisit');
     * ```
     * @param string $attribute the name of the attribute to update.
     */
    public function touch($attribute)
    {
        $this->owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
    }
}
