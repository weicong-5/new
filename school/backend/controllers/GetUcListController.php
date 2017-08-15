<?php
/**
 * @Copyright Copyright (c) 2016 @GetUcListController.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use yii\data\SqlDataProvider;

use dektrium\user\helpers\Password;

class GetUcListController extends Controller
{
    public function Behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['get', 'error', 'index'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionGet()
    {

        //$page = Yii::$app->request->get("start") ? Yii::$app->request->get('start') : 1;
        $count = Yii::$app->db2->createCommand('SELECT COUNT(1) FROM pre_common_member m
                 INNER JOIN pre_common_member_profile p ON m.uid = p.uid')->queryScalar();
        //$query = Yii::$app->db2->createCommand('SELECT * FROM pre_school_student')->queryAll();
        $provider = new SqlDataProvider([
            'db' => 'db2',
            'sql' => 'SELECT * FROM pre_common_member m
                 INNER JOIN pre_common_member_profile p ON m.uid = p.uid ORDER BY m.uid',
            'params' => [':status' => 1],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // 返回包含每一行的数组
        $models = $provider->getModels();
        foreach ($models as $key => $value)
        {
            $insertNewArray[$key][] = $value['uid'];
            $insertNewArray[$key][] = $value['username'];
            $insertNewArray[$key][] = $value['email'];
            $insertNewArray[$key][] = Password::hash('1');
            $insertNewArray[$key][] = $value['regdate'];
            $insertNewArray[$key][] = Yii::$app->request->userIP;
            $insertNewArray[$key][] = Yii::$app->security->generateRandomString();
            $insertNewArray[$key][] = time();
            $insertNewArray[$key][] = $value['mobile'];

            $insertNewProfile[$key][] = $value['uid'];
            $insertNewProfile[$key][] = $value['realname'];
            //$insertNewProfile[$key][] = iconv('UTF-8', 'latin1//ignore', $value['realname']);
        }
        /*var_dump($models);
        exit();*/
        //return $this->redirect(['get-uc-list/get']);

        //return Yii::$app->getResponse()->redirect(['get-uc-list/get', 'id' => Yii::$app->request->get('id') + 1]);
        if (Yii::$app->request->get('page') < 3)
        {
            $db = Yii::$app->db;
            $sql1 = $db->queryBuilder->batchInsert('user',
                ['id', 'username', 'email', 'password_hash', 'created_at', 'registration_ip', 'auth_key', 'updated_at', 'mobile'],
                $insertNewArray);
            $sql1 = 'INSERT IGNORE' . mb_substr( $sql1, strlen( 'INSERT' ) );
            $db->createCommand($sql1)->execute();

            $sql2 = $db->queryBuilder->batchInsert('profile',
                ['user_id', 'name'],
                $insertNewProfile);
            $sql2 = 'INSERT IGNORE' . mb_substr( $sql2, strlen( 'INSERT' ) );
            $db->createCommand($sql2)->execute();
            /*//插入主表
            Yii::$app->db->createCommand()->batchInsert('user',
            ['id', 'username', 'email', 'password_hash', 'created_at', 'registration_ip', 'auth_key', 'updated_at', 'mobile'],
            $insertNewArray)->execute();

            //插入信息表
            Yii::$app->db->createCommand()->batchInsert('profile',
                ['user_id', 'name'],
                $insertNewProfile
            )->execute();*/

            Yii::$app->getSession()->setFlash('success', '采集第' . Yii::$app->request->get('page') . '页成功!');
            /*echo 'collection complete';
            exit();*/
            return $this->render('/site/uc.php', [
                'models' => $provider,
                'time' => date('H:i:s'),
            ]);
        } else {
            Yii::$app->getSession()->setFlash('success', '采集完成!');
            return $this->render('/site/uc.php', [
                'models' => $provider,
                'time' => date('H:i:s'),
            ]);
        }

        var_dump($models);

    }

    public function actionUpdate($id)
    {
        echo $id;
    }

    /*protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }*/
}