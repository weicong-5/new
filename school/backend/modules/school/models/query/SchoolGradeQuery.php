<?php

namespace backend\modules\school\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\school\models\SchoolGrade]].
 *
 * @see \backend\modules\school\models\SchoolGrade
 */
class SchoolGradeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\school\models\SchoolGrade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\school\models\SchoolGrade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
