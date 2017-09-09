<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TeacherStaff;

/**
 * TeacherStaffSearch represents the model behind the search form about `common\models\TeacherStaff`.
 */
class TeacherStaffSearch extends TeacherStaff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'sex', 'school_id'], 'integer'],
            [['staff_type', 'name', 'political_status', 'tel', 'school_name', 'office_room', 'office_phone', 'headteacher_grade', 'headteacher_class', 'subject', 'teach_grade', 'teach_class'], 'safe'],
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
        $query = TeacherStaff::find();

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
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'school_id' => $this->school_id,
        ]);

        $query->andFilterWhere(['like', 'staff_type', $this->staff_type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'political_status', $this->political_status])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'school_name', $this->school_name])
            ->andFilterWhere(['like', 'office_room', $this->office_room])
            ->andFilterWhere(['like', 'office_phone', $this->office_phone])
            ->andFilterWhere(['like', 'headteacher_grade', $this->headteacher_grade])
            ->andFilterWhere(['like', 'headteacher_class', $this->headteacher_class])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'teach_grade', $this->teach_grade])
            ->andFilterWhere(['like', 'teach_class', $this->teach_class]);
        return $dataProvider;
    }
}
