<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/29
 * Time: 15:21
 */
namespace backend\controllers;


use common\models\Status;
use common\models\User;
use common\models\UserSearch;
use common\models\TeacherStaff;

use frontend\models\SignupForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class UsersController extends Controller{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index',[
           'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    //     * Displays a single User model.
    //     * @param integer $id
    //     * @return mixed
    //     */
    public function actionView($id)
    {
        $query = Status::find()->where(['user_id'=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query'=> $query,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new User();
//
//        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }
    public function actionCreate()
    {
        $model = new SignupForm();

        $selects = array('0'=>'请选择');
        $political_status = array_merge($selects,TeacherStaff::getAllPoliticalStatus());

        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                    $searchModel = new UserSearch();
                    $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
                    return $this->render('index',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'political_status' => $political_status,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}