<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/6
 * Time: 11:52
 */

$this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="site-index">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-3">
                    <a href="/status/teacher-index" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>个人信息</a>
                    <a href="/status/school-info" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>学校资讯</a>
                    <a href="/status/teacher-modify-score" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>学生成绩</a>
                    <a href="/status/teacher-assign-homework" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>布置作业</a>
                </div>
                <div class="col-lg-9">
                    <?=$content?>
                </div>
            </div>
        </div>


    </div>
<?php $this->endContent(); ?>