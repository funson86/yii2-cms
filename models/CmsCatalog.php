<?php

namespace funson86\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use funson86\cms\Module;

/**
 * This is the model class for table "cms_catalog".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $surname
 * @property string $brief
 * @property string $content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $banner
 * @property integer $is_nav
 * @property integer $sort_order
 * @property string $page_type
 * @property integer $page_size
 * @property string $template_list
 * @property string $template_show
 * @property string $template_page
 * @property string $redirect_url
 * @property integer $click
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CmsShow[] $cmsShows
 */
class CmsCatalog extends \yii\db\ActiveRecord
{
    const IS_NAV_YES = 1;
    const IS_NAV_NO = 0;
    const PAGE_TYPE_LIST = 'list';
    const PAGE_TYPE_SHOW = 'show';
    const PAGE_TYPE_PAGE = 'page';
    private $_isNavLabel;
    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_catalog';
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
            [['parent_id', 'is_nav', 'sort_order', 'page_size', 'click', 'status'], 'integer'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['title', 'surname', 'seo_title', 'seo_keywords', 'seo_description', 'banner', 'page_type', 'template_list', 'template_show', 'template_page', 'redirect_url'], 'string', 'max' => 255],
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
            'parent_id' => Module::t('cms', 'Parent ID'),
            'title' => Module::t('cms', 'Title'),
            'surname' => Module::t('cms', 'Surname'),
            'brief' => Module::t('cms', 'Brief'),
            'content' => Module::t('cms', 'Content'),
            'seo_title' => Module::t('cms', 'Seo Title'),
            'seo_keywords' => Module::t('cms', 'Seo Keywords'),
            'seo_description' => Module::t('cms', 'Seo Description'),
            'banner' => Module::t('cms', 'Banner'),
            'is_nav' => Module::t('cms', 'Is Nav'),
            'sort_order' => Module::t('cms', 'Sort Order'),
            'page_type' => Module::t('cms', 'Page Type'),
            'page_size' => Module::t('cms', 'Page Size'),
            'template_list' => Module::t('cms', 'Template List'),
            'template_show' => Module::t('cms', 'Template Show'),
            'template_page' => Module::t('cms', 'Template Page'),
            'redirect_url' => Module::t('cms', 'Redirect Url'),
            'click' => Module::t('cms', 'Click'),
            'status' => Module::t('cms', 'Status'),
            'created_at' => Module::t('cms', 'Created At'),
            'updated_at' => Module::t('cms', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsShows()
    {
        return $this->hasMany(CmsShow::className(), ['catalog_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CmsCatalog::className(), ['id' => 'parent_id']);
    }

    public function getStatus()
    {
        if ($this->_status === null) {
            $this->_status = new Status($this->status);
        }
        return $this->_status;
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


    /**
     * @inheritdoc
     */
    public static function getArrayIsNav()
    {
        return [
            self::IS_NAV_YES => Module::t('cms', 'YES'),
            self::IS_NAV_NO => Module::t('cms', 'NO'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getOneIsNavLabel($isNav = null)
    {
        if($isNav)
        {
            $arrayIsNav = self::getArrayIsNav();
            return $arrayIsNav[$isNav];
        }
        else
            return;
    }

    public function getIsNavLabel()
    {
        if ($this->_isNavLabel === null)
        {
            $arrayIsNav = self::getArrayIsNav();
            $this->_isNavLabel = $arrayIsNav[$this->is_nav];
        }
        return $this->_isNavLabel;
    }

    /**
     * @param int $parentId  parent catalog id
     * @param array $array  catalog array list
     * @param int $level  catalog level, will affect $repeat
     * @param int $add  times of $repeat
     * @param string $repeat  symbols or spaces to be added for sub catalog
     * @return array  catalog collections
     */

    static public function get($parentId = 0, $array = array(), $level = 0, $add = 2, $repeat = '　')
    {
        $strRepeat = '';
        // add some spaces or symbols for non top level categories
        if ($level>1) {
            for($j = 0; $j < $level; $j ++)
            {
                $strRepeat .= $repeat;
            }
        }

        // i feel this is useless
        if($level>0)
            $strRepeat .= '';

        $newArray = array ();
        $tempArray = array ();

        //performance is not very good here
        foreach ( ( array ) $array as $v )
        {
            if ($v['parent_id'] == $parentId)
            {
                $newArray [] = array ('id' => $v['id'], 'title' => $v['title'], 'parent_id' => $v['parent_id'],  'sort_order' => $v['sort_order'],
                    'banner' => $v['banner'], //'postsCount'=>$v['postsCount'],
                    'is_nav' => $v['is_nav'], 'page_type' => $v['page_type'],
                    'status' => $v['status'], 'created_at' => $v['created_at'], 'updated_at' => $v['updated_at'], 'redirect_url' => $v['redirect_url'], 'str_repeat' => $strRepeat, 'str_label' => $strRepeat.$v['title'],);

                $tempArray = self::get ( $v['id'], $array, ($level + $add), $add, $repeat);
                if ($tempArray)
                {
                    $newArray = array_merge ( $newArray, $tempArray );
                }
            }
        }
        return $newArray;
    }

    /**
     * return all sub catalogs of a parent catalog
     * @param int $parentId
     * @param array $array
     * @return array
     */

    static public function getCatalog($parentId=0,$array = array())
    {
        $newArray=array();
        foreach ((array)$array as $v)
        {
            if ($v['parent_id']==$parentId)
            {
                $newArray[$v['id']]=array(
                    'text'=>$v['title'].' ����['.($v['is_nav'] ? Module::t('common', 'CONSTANT_YES') : Module::t('common', 'CONSTANT_NO')).'] ����['.$v['sort_order'].
                        '] ����['.($v['page_type'] == 'list' ? Module::t('common', 'PAGE_TYPE_LIST') : Module::t('common', 'PAGE_TYPE_PAGE')).'] ״̬['.
                        F::getStatus2($v['status']).'] [<a href="'.Yii::app()->createUrl('/catalog/update',array('id'=>$v['id'])).'">�޸�</a>][<a href="'
                        .Yii::app()->createUrl('/catalog/create',array('id'=>$v['id'])).'">�����Ӳ˵�</a>]&nbsp;&nbsp[<a href="'.
                        Yii::app()->createUrl('/catalog/delete',array('id'=>$v['id'])).'">ɾ��</a>]',
                    //'children'=>array(),
                );

                $tempArray = self::getCatalog($v['id'],$array);
                if($tempArray)
                {
                    $newArray[$v['id']]['children']=$tempArray;
                }
            }
        }
        return $newArray;
    }

    static public function getCatalogIdStr($parentId=0,$array = array())
    {
        $str = $parentId;
        foreach ((array)$array as $v)
        {
            if ($v['parent_id']==$parentId)
            {

                $tempStr = self::getCatalogIdStr($v['id'],$array);
                if($tempStr)
                {
                    $str .= ','.$tempStr;
                }
            }
        }
        return $str;
    }

    static public function getRootCatalogId($id = 0, $array = [])
    {
        if(0 == $id)
        {
            return 0;
        }

        foreach ((array)$array as $v)
        {
            if ($v['id'] == $id) {
                $parentId = $v['parent_id'];
                if(0 == $parentId)
                    return $id;
                else
                    return self::getRootCatalogId($parentId, $array);
            }
        }
    }

    static public function getCatalogSub2($id=0,$array = array())
    {
        if(0 == $id)
        {
            return 0;
        }

        $arrayResult = array();
        $rootId = self::getRootCatalogId($id, $array);
        foreach ((array)$array as $v)
        {
            if ($v['parent_id']==$rootId)
            {
                array_push($arrayResult, $v);
            }
        }

        return $arrayResult;
    }

    static public function getBreadcrumbs($id=0,$array = array())
    {
        if(0 == $id)
        {
            return;
        }

        $arrayResult = self::getPathToRoot($id, $array);

        return array_reverse($arrayResult);
    }

    static public function getPathToRoot($id=0,$array = array())
    {
        if (0 == $id) {
            return array();
        }

        $arrayResult = array();
        $parent_id = 0;
        foreach ((array)$array as $v) {
            if ($v['id'] == $id) {
                $parent_id = $v['parent_id'];
                if (self::PAGE_TYPE_LIST == $v['page_type'])
                    $arrayResult = array($v['title'] => array('list', id => $v['id']));
                elseif (self::PAGE_TYPE_PAGE == $v['page_type'])
                    $arrayResult = array($v['title'] => array('page', id => $v['id']));
            }
        }

        if (0 < $parent_id) {
            $arrayTemp = self::getPathToRoot($parent_id, $array);

            if (!empty($arrayTemp))
                $arrayResult += $arrayTemp;
        }

        if (!empty($arrayResult))
            return $arrayResult;
        else
            return;
    }
}
