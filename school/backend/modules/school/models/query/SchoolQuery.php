<?php
/**
 * @Copyright Copyright (c) 2016 @SchoolQuery.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace backend\modules\school\models\query;

/**
 * This is the ActiveQuery class for [[School]].
 *
 * @see School
 */
class SchoolQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return School[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return School|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
