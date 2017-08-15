<?php

namespace backend\modules\school\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\SchoolGrade;

/**
 * SchoolGradeSearch represents the model behind the search form about `backend\modules\school\models\SchoolGrade`.
 */
class SchoolGradeSearch extends SchoolGrade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'school_area_id', 'school_id', 'dateline', 'display_order'], 'integer'],
            [['id', 'school_area_id', 'school_id', 'dateline', 'display_order'], 'safe'],
            [['name'], 'safe'],
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
        $query = SchoolGrade::find();

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

        if ($this->dateline !== null) {
            $date = strtotime($this->dateline);
            $query->andFilterWhere(['between', 'dateline', $date, $date + 3600 * 24]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'school_area_id' => $this->school_area_id,
            'school_id' => $this->school_id,
            'display_order' => $this->display_order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
