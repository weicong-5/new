<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "score".
 *
 * @property integer $id
 * @property string $name
 * @property string $score
 * @property integer $times
 */
class Score extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'score'], 'required'],
            [['times'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['score'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'score' => 'Score',
            'times' => 'Times',
        ];
    }
}
