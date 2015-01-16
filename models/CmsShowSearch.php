<?php

namespace funson86\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use funson86\cms\models\CmsShow;

/**
 * CmsShowSearch represents the model behind the search form about `app\models\CmsShow`.
 */
class CmsShowSearch extends CmsShow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'catalog_id', 'click', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'surname', 'brief', 'content', 'seo_title', 'seo_keywords', 'seo_description', 'banner', 'template_show', 'author'], 'safe'],
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
        $query = CmsShow::find();
        
        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'catalog_id' => $this->catalog_id,
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
            ->andFilterWhere(['like', 'template_show', $this->template_show])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
