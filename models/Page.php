<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property string $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $title_ua
 * @property string $slug
 * @property integer $author_id
 * @property string $site_id
 * @property string $meta_title_ru
 * @property string $meta_title_en
 * @property string $meta_title_ua
 * @property string $meta_description_ru
 * @property string $meta_description_en
 * @property string $meta_description_ua
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_en
 * @property string $meta_keywords_ua
 * @property string $content_ru
 * @property string $content_en
 * @property string $content_ua
 * @property integer $is_disabled
 *
 * Relations
 * @property PageBlock[] $blocks
 */
class Page extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_ru', 'slug', 'content_ru'], 'required'],

            [[
                'title_ru',
                'title_en',
                'title_ua',
                'slug',
                'meta_title_ru',
                'meta_title_en',
                'meta_title_ua',
                'meta_description_ru',
                'meta_description_en',
                'meta_description_ua',
                'meta_keywords_ru',
                'meta_keywords_en',
                'meta_keywords_ua',
                'content_ru',
                'content_en',
                'content_ua',
            ], 'string'],
            [['author_id', 'is_disabled'], 'integer'],

            ['slug', 'unique'],

            [[
                'title_ru',
                'title_en',
                'title_ua',
                'slug',
                'meta_title_ru',
                'meta_title_en',
                'meta_title_ua',
                'meta_description_ru',
                'meta_description_en',
                'meta_description_ua',
                'meta_keywords_ru',
                'meta_keywords_en',
                'meta_keywords_ua',
            ], 'string', 'max' => 255],

            [[
                'title_ru',
                'title_en',
                'title_ua',
                'slug',
                'meta_title_ru',
                'meta_title_en',
                'meta_title_ua',
                'meta_description_ru',
                'meta_description_en',
                'meta_description_ua',
                'meta_keywords_ru',
                'meta_keywords_en',
                'meta_keywords_ua',
            ], 'filter', 'filter' => 'trim'],

            [[
                'title_ru',
                'title_en',
                'title_ua',
                'slug',
                'meta_title_ru',
                'meta_title_en',
                'meta_title_ua',
                'meta_description_ru',
                'meta_description_en',
                'meta_description_ua',
                'meta_keywords_ru',
                'meta_keywords_en',
                'meta_keywords_ua',
            ], 'filter', 'filter' => 'strip_tags'],

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
            'title_ru' => 'Заголовок (RU)',
            'title_en' => 'Заголовок (EN)',
            'title_ua' => 'Заголовок (UA)',
            'slug' => 'Псевдоним',
            'author_id' => 'ID автора',
            'site_id' => 'ID сайта',
            'meta_title_ru' => 'Meta Title (RU)',
            'meta_title_en' => 'Meta Title (EN)',
            'meta_title_ua' => 'Meta Title (UA)',
            'meta_description_ru' => 'Meta Description (RU)',
            'meta_description_en' => 'Meta Description (EN)',
            'meta_description_ua' => 'Meta Description (UA)',
            'meta_keywords_ru' => 'Meta Keywords (RU)',
            'meta_keywords_en' => 'Meta Keywords (EN)',
            'meta_keywords_ua' => 'Meta Keywords (UA)',
            'content_ru' => 'Содержимое (RU)',
            'content_en' => 'Содержимое (EN)',
            'content_ua' => 'Содержимое (UA)',
            'is_disabled' => 'Черновик',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->author_id = Yii::$app->user->id;
                $this->site_id = Yii::$app->id;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'uniqid' => [
                'class' => 'app\behaviors\UniqidBehavior',
            ],
        ];
    }

    /**
     * @return PageBlock[]
     */
    public function getBlocks()
    {
        return $this->hasMany(PageBlock::className(), ['page_id' => 'id'])
            ->orderBy('sort ASC');
    }
}
