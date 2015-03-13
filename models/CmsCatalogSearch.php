<?php

namespace funson86\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use funson86\cms\models\CmsCatalog;

/**
 * CmsCatalogSearch represents the model behind the search form about `app\models\CmsCatalog`.
 */
class CmsCatalogSearch extends CmsCatalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'is_nav', 'sort_order', 'page_type', 'page_size', 'click', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'surname', 'brief', 'content', 'seo_title', 'seo_keywords', 'seo_description', 'banner', 'template_list', 'template_show', 'template_page', 'redirect_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CmsCatalog::find();
        
        $query->orderBy(['sort_order' => SORT_ASC, 'create_time' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'is_nav' => $this->is_nav,
            'sort_order' => $this->sort_order,
            'page_type' => $this->page_type,
            'page_size' => $this->page_size,
            'click' => $this->click,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'template_list', $this->template_list])
            ->andFilterWhere(['like', 'template_show', $this->template_show])
            ->andFilterWhere(['like', 'template_page', $this->template_page])
            ->andFilterWhere(['like', 'redirect_url', $this->redirect_url]);

        return $dataProvider;
    }
}
