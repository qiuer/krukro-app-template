<?php
namespace app\models;

use Yii;
use yii\base\Widget;
use yii\helpers\Json;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_block".
 *
 * @property string $page_id
 * @property string $site_id
 * @property integer $sort
 * @property string $params
 * @property string $widget_class
 * @property string $type
 *
 * Properties:
 * @property string $content
 */
class PageBlock extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'site_id', 'widget_class', 'type'], 'required'],
            [['page_id', 'site_id', 'params', 'widget_class', 'type'], 'string'],
            [['sort'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => 'Page ID',
            'site_id' => 'Site ID',
            'sort' => 'Sort',
            'params' => 'Параметры блока',
            'widget_class' => 'Widget Class',
            'type' => 'Type',
        ];
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $config = Json::decode($this->params);
        $config['class'] = $this->widget_class;
        /** @var $widget Widget */
        $widget = Yii::createObject($config);
        return $widget->run();
    }

    /**
     * @param null $blockName
     * @return array|false
     */
    public static function getBlockConfig($blockName = null)
    {
        $blocks = Yii::$app->params['pageBlocks'];
        if (is_null($blockName)) {
            return $blocks;
        } else {
            return (isset($blocks[$blockName])) ? $blocks[$blockName] : false;
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'siteid' => [
                'class' => 'app\behaviors\SiteidBehavior',
            ],
        ];
    }
}
