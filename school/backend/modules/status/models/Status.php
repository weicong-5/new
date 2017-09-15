<?php

namespace backend\modules\status\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $status
 * @property string $name
 * @property string $school
 */
class Status extends \common\models\Status
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['status', 'name', 'school'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'name' => 'Name',
            'school' => 'School',
        ];
    }
}
