<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/8
 * Time: 10:43
 * 文章表单模型
 */
namespace frontend\models;

use common\models\Posts;
use common\models\RelationPostTags;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\db\Query;

class PostForm extends Model{

    //声明属性
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;//标签
    public $_lastError = "";//错误信息

    //用常量作为场景应用的变量
    const SCENARIOS_CREATE = 'create';//创建
    const SCENARIOS_UPDATE = 'update';//更新

    /**
     * 定义事件
     */
    const EVENT_AFTER_CREATE = 'eventAfterCreate';//创建之后的事件
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';//更新之后的事件

    //验证规则
    public function rules()
    {
        return[
            [['id','title','content','cat_id'],'required'],
            [['id','cat_id'],'integer'],
            ['title','string','min'=>4,'max'=>50],
        ];
    }

    //属性labels
    public function attributeLabels()
    {
        return[
            'id' => \Yii::t('common','ID'),
            'title' => \Yii::t('common','Title'),
            'content' => \Yii::t('common','Content'),
            'label_img' => \Yii::t('common','Label Img'),
            'cat_id' => \Yii::t('common','Cat Id'),
            'tags'=> \Yii::t('common','Tags'),
        ];
    }

    /**
     * 场景设置 scenarios()
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title','content','label_img','cat_id','tags'],//该场景需要用到的字段
            self::SCENARIOS_UPDATE => ['title','content','label_img','cat_id','tags'],
        ];
        return array_merge(parent::scenarios(),$scenarios);//与继承下来的场景
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     * 创建Post对象是否成功
     */
    public function create(){
        //事务 如果存储数据库失败可以调用食事务的回滚
        $transaction = Yii::$app->db->beginTransaction();
        try{
            //文章模型数据处理
            $model = new Posts();
            $model->setAttributes($this->attributes);//表单上的所有属性
            $model->summary = $this->_getSummary();
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->created_at = time();
            $model->updated_at = time();
            //是否发布
            $model->is_valid = Posts::IS_VALID;
//            print_r($this->attributes);
//            print_r($model);
//            $data = array_merge($this->getAttributes(),$model->getAttributes());//得到更全面数据
//            print_r($data);
//            exit();

            if(!$model->save()){//如果保存失败
                throw new \Exception(Yii::t('common','Article create failed!'));
            }

            $this->id = $model->id;//文章id在后面页面跳转中需要用到

//            调用事件
            $data = array_merge($this->getAttributes(),$model->getAttributes());//得到更全面数据
//            print_r($data);
//            exit();
            $this->_eventAfterCreate($data);

            $transaction->commit();//提交事务
            return true;
        }catch(\Exception $e){
            $transaction->rollBack();//回滚
            $this->_lastError = $e->getMessage();//存储错误信息
            return false;
        }
    }

    /**
     * @param int $s
     * @param int $e
     * @param string $char
     * @return null
     * 截取文章摘要
     */
    private function _getSummary($s = 0,$e = 90,$char = 'utf-8'){
        //判断文章内容是否为空
        if(empty($this->content)){
            return null;
        }else{
            return mb_substr(str_replace('&nbsp;',' ',strip_tags($this->content)),$s,$e,$char);
        }
    }

    /**
     * 创建post完成后调用的事件方法
     */
    public function _eventAfterCreate($data){//相当于对很多事件打了个包
        //事件添加
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddTag'],$data);
//        $this->on(self::EVENT_AFTER_CREATE,[$this,'其他方法名'],$data); 其他方法
        //触发
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    //添加标签事件
    public function _eventAddTag($event){
        $tag = new TagForm();
        $tag->tags = $event->data['tags'];
        $tagids = $tag->saveTags();//保存标签

        //删除原先的关联关系
        RelationPostTags::deleteAll(['post_id' => $event->data['id']]);  //只有编辑的时候才会

        //重新保存
        //批量保存文章-》标签的关联关系  因为标签可能有多个
        if(!empty($tagids)){//标签不为空
            foreach($tagids as $k => $id){
//                $row[$k]['post_id'] = $this->id;
                $row[$k]['post_id'] = $this->id;
                $row[$k]['tag_id'] = $id;

            }
            $res = (new Query())->createCommand()
                ->batchInsert(RelationPostTags::tableName(),['post_id','tag_id'],$row)
                ->execute();
            //第一个参数表名，第二个参数字段数组，第三个参数插入数据
            if(!$res){
                throw new Exception('关联关系保存失败');
            }
        }
    }
}