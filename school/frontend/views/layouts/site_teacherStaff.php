<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/6
 * Time: 11:52
 */
$session = Yii::$app->session;
$this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="site-index">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-3">
                    <a href="/status/teacher-index" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>个人信息</a>
                    <a href="/status/school-info" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>学校资讯</a>
                    <a href="/status/teacher-modify-score" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>学生成绩</a>
                    <?php
                    if($session['status']!='校长'){?>
                        <a href="/status/teacher-assign-homework" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>布置作业</a>
                        <?php
                    }
                    ?>
                    <?php
                    if($session['status'] == '班主任'){
                        ?>
                        <a href="/status/student-of-class" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>本班学生</a>
                        <?php
                    }
                    ?>

                </div>
                <div class="col-lg-9">
                    <?=$content?>
                </div>
            </div>
        </div>


    </div>
<?php $this->endContent(); ?>