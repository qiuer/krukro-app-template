<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\admin\models\Admin;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $author_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $content
 * @property integer $is_disabled
 *
 * Relations
 * @property Admin $author
 */
class Page extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'content'], 'required'],
            [['title', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'content'], 'string'],
            [['author_id', 'is_disabled'], 'integer'],
            ['slug', 'unique'],
            [['title', 'slug', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
            [['title', 'slug', 'meta_title', 'meta_description', 'meta_keywords'], 'filter', 'filter' => 'trim'],
            [['title', 'slug', 'meta_title', 'meta_description', 'meta_keywords'], 'filter', 'filter' => 'strip_tags'],

            ['is_disabled', 'default', 'value' => 0],
            ['is_disabled', 'in', 'range' => [0, 1]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Псевдоним',
            'author_id' => 'ID автора',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'content' => 'Содержимое',
            'is_disabled' => 'Черновик',
        ];
    }

    /**
     * Return page author
     * @return Admin
     */
    public function getAuthor()
    {
        return $this->hasOne(Admin::className(), ['id' => 'author_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->author_id = Yii::$app->user->id;
            }
            return true;
        } else {
            return false;
        }
    }
}
