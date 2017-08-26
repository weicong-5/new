<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/8
 * Time: 9:32
 * 文章控制器
 */
namespace frontend\controllers;

use common\models\Cats;
use frontend\models\PostForm;
use Yii;
use frontend\controllers\base\BaseController;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

class PostController extends  BaseController{

    /**
     * @return array 行为过滤
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create','upload','ueditor'],//指定动作
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
//                        'roles' => ['?'],//? 表示不登录才能访问
                    ],
                    [
                        'actions' => ['create','upload','ueditor'],
                        'allow' => true,
                        'roles' => ['@'],//@ 表示登录之后才能访问
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get','post']//所有方法都可以是get post方式,
                ],
            ],
        ];
    }

    public function actionIndex(){

//        $cat = new \common\models\Cats();
//        $cat->setScenario('scenario2');
//        $testData = [
//            'data' => [
//                'id' => 5,
//                'cat_name' => '分类five',
//            ],
//        ];
//        $cat->load($testData,'data');
//        echo $cat->id;
//        echo $cat->cat_name;
        $model = new PostForm();

        return $this->render('index',['model'=>$model]);
    }

    //创建文章控制器
    public function actionCreate(){
        $model = new PostForm();
        //设置场景 场景一般在表单模型中定义
        $model->setScenario(PostForm::SCENARIOS_CREATE);
        if($model->load(Yii::$app->request->post()) && $model->validate()){//有数据提交以及验证提交数据成功
            if(!$model->create()){//如果创建不成功
                Yii::$app->session->setFlash('warning',$model->_lastError);//setFlash闪存数据
            }else{
                return $this->redirect(['post/view','id'=>$model->id]);
            }
        }
        //需要拿到分类的数据
        $cats = Cats::getAllCats();
        return $this->render('create',['model'=>$model,'cats'=>$cats]);
    }

    public function actionSearchcat($q=null,$id=null){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results'=>['id'=>'','text'=>'']];
        if(!is_null($q)){
            $query = new Query();
            $query->select('id,cat_name as text')->from('cats')->where(['like','cat_name',$q])->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }elseif($id>0){
            $out['results'] = ['id'=>$id ,'text'=>Cats::findOne($id)->cat_name];
        }
//
//        $data = Cats::find()->select('id cat_name as text')->andFilterWhere(['like','cat_name',$q])->limit(50)->asArray()->all();
//
//        $out['results'] = array_values($data);

        return $out;
    }


    //在使用图片上传控件的控制器中  附上以下代码
    public function actions(){
        return [
            'upload' =>[
                'class' => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    'imagePathFormat' => "/static/images/uploads/{yyyy}{mm}{dd}/{time}{rand:6}",//存放在static/images/uploads/
                ]
            ],
            'ueditor' =>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'imageUrlPrefix' => "",//图片访问路径前缀
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
        ];
    }
}