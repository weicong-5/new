<?php
/**
 * @Copyright Copyright (c) 2016 @SchoolSearch.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace backend\modules\school\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\School;

/**
 * SchoolSearch represents the model behind the search form about `backend\modules\school\models\School`.
 */
class SchoolSearch extends School
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'city_id', 'area_id', 'manage_uid', 'quantong_id'], 'integer'],
            [['name', 'address', 'school_type', 'school_num', 'number', 'deny_code'], 'safe'],
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
        $query = School::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'manage_uid' => $this->manage_uid,
            'quantong_id' => $this->quantong_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'school_type', $this->school_type])
            ->andFilterWhere(['like', 'school_num', $this->school_num])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'deny_code', $this->deny_code]);

        return $dataProvider;
    }
}
