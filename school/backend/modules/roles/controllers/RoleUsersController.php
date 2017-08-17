<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/16
 * Time: 17:08
 */
namespace backend\modules\roles\controllers;

use yii\web\Controller;

/**
 * Default controller for the `role` module
 */
class RoleUsersController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('/users/index');
    }

    //查看用户详情
    public function actionView(){
        $id = \Yii::$app->request->get('id');

        return $this->render('/users/detail',['id'=>$id]);
    }
}