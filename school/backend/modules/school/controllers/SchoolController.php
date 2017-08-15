<?php

namespace backend\modules\school\controllers;

use backend\modules\school\models\SchoolDistrict;
use dektrium\user\models\User;
use Yii;
use backend\modules\school\models\School;
use backend\modules\school\models\search\SchoolSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use dektrium\user\traits\AjaxValidationTrait;

/**
 * SchoolController implements the CRUD actions for School model.
 */
class SchoolController extends Controller
{
    use AjaxValidationTrait;
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all School models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*echo '<pre>';
        //print_r(\yii\helpers\ArrayHelper::map(SchoolDistrict::getArea(Yii::$app->request->queryParams['SchoolSearch']['city_id']), 'id', 'name'));
        print_r(ArrayHelper::map(SchoolDistrict::getCity(19), 'id', 'name'));
        print_r(ArrayHelper::map(SchoolDistrict::getProvince(), 'id', 'name'));
        exit();*/

        $searchModel = new SchoolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->pagination->pageSize=20;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single School model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $model->deny_code = School::fieldUnSerialize($model->deny_code);
        $model->number = School::fieldUnSerialize($model->number);
        $model->school_type = School::schoolType(explode(',', $model->school_type));
        $model->area_id = ArrayHelper::getValue(ArrayHelper::map(SchoolDistrict::getArea($model->city_id), 'id', 'name'), $model->area_id);
        $model->city_id = ArrayHelper::getValue(ArrayHelper::map(SchoolDistrict::getCity($model->province_id), 'id', 'name'), $model->city_id);
        $model->province_id = ArrayHelper::getValue(ArrayHelper::map(SchoolDistrict::getProvince(), 'id', 'name'), $model->province_id);
        $model->manage_uid = User::findIdentity($model->manage_uid)['username'];

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new School model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws HttpException on failure.
     */
    public function actionCreate()
    {
        $model = new School();
        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }*/
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }


        /*if (Yii::$app->request->post()) {
            $post =Yii::$app->request->post();
            $denyCode = explode("|", $post['School']['deny_code']);
            if (is_array($denyCode)) {
                foreach ($denyCode as $value) {
                    $number[] = explode(":", $value);
                }
                $post['School']['deny_code'] = serialize($number);
            }
            if ($model->load($post)) {
                if ($model->validate()) {
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new HttpException(500, current(current($model->getErrors())));
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/

        /*if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->deny_code = explode("|", $model->deny_code);
                if (is_array($model->deny_code)) {
                    foreach ($model->deny_code as $value) {
                        $number[] = explode(":", $value);
                    }

                }
                $model->deny_code = Json::encode($number, 16);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new HttpException(500, current(current($model->getErrors())));
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Updates an existing School model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model->deny_code = School::fieldUnSerialize($model->deny_code);
        $model->number = School::fieldUnSerialize($model->number);
        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }*/
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing School model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the School model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return School the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = School::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
