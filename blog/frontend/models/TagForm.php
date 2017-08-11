<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/9
 * Time: 11:03
 * 标签表单模型
 */
namespace frontend\models;

use common\models\Tags;
use yii\base\Exception;
use yii\base\Model;

class TagForm extends Model{

    public $id;
    public $tags;//标签组

    public function rules(){
        return [
            ['tags','required'],
            ['tags','each','rule' =>['string']]
        ];
    }

    //保存标签在tags表中
    public function saveTags(){
        $ids = [];
        if(!empty($this->tags)){
            foreach($this->tags as $tag){
                $ids[] = $this::_saveTag($tag);
            }
        }

        return $ids;
    }

    /**
     * 单个保存标签
     */
    private function _saveTag($tag){
        $model = new Tags();
        //先检查是否已经存在该标签
        $res = $model->find()->where(['tag_name' => $tag])->one();
        //新建标签
        if(!$res){
            //找不到 插入新数据
            $model->tag_name = $tag;
            $model->post_num = 1;
            if(!$model->save()){
                throw new \Exception('保存标签失败');
            }
            return $model->id;
        }else{
            //找到，在原有基础上修改
            $res->updateCounters(['post_num'=>1]);//post_num字段累加        //不用去找到原数据 字段值+1 后再重新写入数据表  这样更高效 简洁
        }
        return $res->id;
    }
}