<?php

namespace backend\modules\school\controllers;

use Yii;
use backend\modules\school\models\SchoolDistrict;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SchoolDistrictController extends \yii\web\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create'  => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Create province, city, area cache
     * @return string
     */
    public function actionCreate()
    {
        $model = new SchoolDistrict();
        $provinceList = $model->setCache('1');
        $cityList = $model->setCache('2');
        $areaList = $model->setCache('3');
        Yii::$app->cache->set('provinceCache', $provinceList);
        foreach ($cityList as $cityId => $city) {
            $cityListCache[$city['upid']][] = $city;
        }
        foreach ($areaList as $areaID => $area) {
            $areaListCache[$area['upid']][] = $area;
        }
        Yii::$app->cache->set('cityCache', $cityListCache);
        Yii::$app->cache->set('areaCache', $areaListCache);

        Yii::$app->getSession()->setFlash('success', '生成缓存成功!', false);
        return $this->render('/district/index');
    }

    public function actionIndex()
    {
        return $this->render('/district/index');
    }
}
