<?php

namespace funson86\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use funson86\cms\Module;

/**
 * This is the model class for table "cms_show".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $title
 * @property string $surname
 * @property string $brief
 * @property string $content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $banner
 * @property string $template_show
 * @property string $author
 * @property integer $click
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CmsCatalog $catalog
 */
class CmsShow extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_show';
    }

    /**
     * create_time, update_time to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            // BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'click', 'status'], 'integer'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['title', 'seo_title', 'seo_keywords', 'seo_description', 'banner', 'template_show', 'author'], 'string', 'max' => 255],
            [['surname'], 'string', 'max' => 128],
            [['brief'], 'string', 'max' => 1022]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('cms', 'ID'),
            'catalog_id' => Module::t('cms', 'Catalog ID'),
            'title' => Module::t('cms', 'Title'),
            'surname' => Module::t('cms', 'Surname'),
            'brief' => Module::t('cms', 'Brief'),
            'content' => Module::t('cms', 'Content'),
            'seo_title' => Module::t('cms', 'Seo Title'),
            'seo_keywords' => Module::t('cms', 'Seo Keywords'),
            'seo_description' => Module::t('cms', 'Seo Description'),
            'banner' => Module::t('cms', 'Banner'),
            'template_show' => Module::t('cms', 'Template Show'),
            'author' => Module::t('cms', 'Author'),
            'click' => Module::t('cms', 'Click'),
            'status' => Module::t('cms', 'Status'),
            'created_at' => Module::t('cms', 'Created At'),
            'updated_at' => Module::t('cms', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(CmsCatalog::className(), ['id' => 'catalog_id']);
    }

    /**
     * Before save.
     * 
     */
    /*public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            // add your code here
            return true;
        }
        else
            return false;
    }*/

    /**
     * After save.
     *
     */
    /*public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add your code here
    }*/

}
