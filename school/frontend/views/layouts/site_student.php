<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/4
 * Time: 11:31
 */

$this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="site-index">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-3">
                    <a href="student-index" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right" ></i>个人信息</a>
                    <a href="school-info" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>学校资讯</a>
                    <a href="student-class-table" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>查看课程</a>
                    <a href="student-score?sid=" class="list-group-item"><i class="glyphicon glyphicon-chevron-right pull-right"></i>个人成绩</a>
                </div>
                <div class="col-lg-9">
                    <?=$content?>
                </div>
            </div>
        </div>


    </div>
<?php $this->endContent(); ?>