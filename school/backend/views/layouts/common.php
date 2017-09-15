<?php
/**
 * @Copyright Copyright (c) 2016 @common.php By Kami
 * @License http://www.yuzhai.tv/
 */

/**
 * @var $this yii\web\View
 */

use common\assets\AdminLteAsset;
use backend\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use \yii\web\Request;

$bundle = AdminLteAsset::register($this);

$baseUrl = str_replace('/backend/web', '/frontend/web', (new Request)->getBaseUrl());
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
<div class="wrapper">
    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo Yii::getAlias('@frontendUrl') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>E</b>du</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Edu</b> v0.1</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"><?php echo Yii::t('backend', 'Toggle navigation') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">message test</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <!--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                                            </div>
                                            <h4>
                                                from who's?
                                                <small><i class="fa fa-clock-o"></i> timestamp</small>
                                            </h4>
                                            <p>message content</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">notifications test</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> notifications content
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">tasks test</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                tasks something
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!--<img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                            <span class="hidden-xs"><?= empty(Yii::$app->user->identity->username)?"":Yii::$app->user->identity->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?= empty(Yii::$app->user->identity->username)?"":Yii::$app->user->identity->username ?>
                                    <small><?php echo Yii::t('backend', 'Member since {0, date, short}', empty(Yii::$app->user->identity->created_at)?"":Yii::$app->user->identity->created_at) ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!--<li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                            </li>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php echo Html::a(Yii::t('backend', 'Profile'),Yii::$app->urlManagerFrontend->createUrl('/user/settings/profile'), ['class'=>'btn btn-default btn-flat']) ?>
                                </div>
                                <div class="pull-right">
                                    <a href="/site/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <!--<div class="user-panel">
                <div class="pull-left image">
                    img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?/*= Yii::$app->user->identity->username */?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>-->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php echo Menu::widget([
                'options'=>['class'=>'sidebar-menu'],
                'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                'activateParents'=>true,
                'hideEmptyItems' => false,
                'items'=>[
                    [
                        'label'=>Yii::t('backend', 'Main'),
                        'options' => ['class' => 'header']
                    ],
                    [
                        'label'=>Yii::t('backend', 'School'),
                        'url' => '#',
                        'icon'=>'<i class="fa fa-edit"></i>',
                        'options'=>['class'=>'treeview'],
                        'items'=>[
//                            ['label'=>'学校列表', 'url'=>['/schools/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            [
                                'label'=>Yii::t('school', 'School Setting'),
                                'url'=>['/school/school/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>',
                                'visible'=>Yii::$app->user->can('/school/school/index'),
                                'items'=>[
                                    ['label'=>Yii::t('school', 'School List'), 'url'=>['/school/school'], 'icon'=>'<i class="fa fa-angle-double-right"></i>',  'options'=>['class'=>'click']],
                                    ['label'=>Yii::t('school', 'Create School'), 'url'=>['/school/school/create'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                    //['label'=>Yii::t('school', 'View School'), 'url'=>['/school/school/view'], 'icon'=>'<i class="fa fa-angle-double-right"></i>', 'visible'=> ($this->context->action->id == 'view' && $this ->context->id)],
                                ],
                            ],
                            [
                                'label'=>Yii::t('school', 'Grade Setting'),
                                'url'=>['/grade/grade/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>',
                                'visible'=>Yii::$app->user->can('/grade/grade/index'),
                                'items'=>[
                                    ['label'=>Yii::t('school', 'Grade List'), 'url'=>['/grade/grade'], 'icon'=>'<i class="fa fa-angle-double-right"></i>',  'options'=>['class'=>'click']],
                                    ['label'=>Yii::t('school', 'Create Grade'), 'url'=>['/grade/grade/create'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                    //['label'=>Yii::t('school', 'View School'), 'url'=>['/school/school/view'], 'icon'=>'<i class="fa fa-angle-double-right"></i>', 'visible'=> ($this->context->action->id == 'view' && $this ->context->id)],
                                ],
                            ],
                            [
                                'label'=>Yii::t('school', 'School Grade'),
                                'url'=>['/school/grade/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>',
                                'visible'=>Yii::$app->user->can('/school/grade/index'),
                                'items'=>[
                                    ['label'=>Yii::t('school', 'School Grade List'), 'url'=>['/school/grade/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                    ['label'=>Yii::t('school', 'Create Grade'), 'url'=>['/school/grade/create'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],

                                ],
                            ],
                            ['label'=>Yii::t('school', 'District Setting'), 'url'=>['/school/school-district/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            [
                                'label'=>Yii::t('backend', 'Users'),
                                'icon'=>'<i class="fa fa-users"></i>',
                                'url'=>['/user/admin/index'],
                                'visible'=>Yii::$app->user->can('/user/admin/index')
                            ],
                            /*['label'=>Yii::t('backend', 'Article Categories'), 'url'=>['/article-category/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ['label'=>Yii::t('backend', 'Text Widgets'), 'url'=>['/widget-text/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ['label'=>Yii::t('backend', 'Menu Widgets'), 'url'=>['/widget-menu/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ['label'=>Yii::t('backend', 'Carousel Widgets'), 'url'=>['/widget-carousel/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],*/
                        ]
                    ],
                    /*新增 用户管理*/
                    [
                        'label' => '用户',
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' =>[
//                            ['label'=>'用户列表', 'url'=>['/role/role-users/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            [
//                                'label'=>Yii::t('backend', 'Users'),
//                                'icon'=>'<i class="fa fa-users"></i>',
//                                'url'=>['/user/admin/index'],
//                                'visible'=>Yii::$app->user->can('/user/admin/index')
//                            ]
                            ['label' => '用户列表', 'url'=>['/users/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            ['label' => '用户列表new', 'url'=>['/user/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],

                        ]
                    ],
                    /*新增 班级管理*/
                    [
                        'label' => '班级',
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' =>[
                            ['label'=>'班级列表', 'url'=>['/grade/grade/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ['label'=>'课程列表', 'url'=>['/course/index'],'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            [
//                                'label'=>Yii::t('backend', 'Users'),
//                                'icon'=>'<i class="fa fa-users"></i>',
//                                'url'=>['/user/admin/index'],
//                                'visible'=>Yii::$app->user->can('/user/admin/index')
//                            ]
//                            ['label' => '角色列表', 'url'=>['/users/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],

                        ]
                    ],
                    /*新增 学生管理*/
                    [
                        'label' => Yii::t('backend','Student Manage'),
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' =>[
                            ['label'=>Yii::t('backend','Student List'), 'url'=>['/student/student/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            ['label'=>Yii::t('backend','Create Student'), 'url'=>['/student/student/create'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            ['label'=>'课程列表', 'url'=>['/course/index'],'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            [
//                                'label'=>Yii::t('backend', 'Users'),
//                                'icon'=>'<i class="fa fa-users"></i>',
//                                'url'=>['/user/admin/index'],
//                                'visible'=>Yii::$app->user->can('/user/admin/index')
//                            ]
//                            ['label' => '角色列表', 'url'=>['/users/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],

                        ]
                    ],
                    [
                        'label' => '教师管理',
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' =>[
                            ['label'=>'教职工列表', 'url'=>['/teacher-staff/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            ['label'=>'课程列表', 'url'=>['/course/index'],'icon'=>'<i class="fa fa-angle-double-right"></i>'],
//                            [
//                                'label'=>Yii::t('backend', 'Users'),
//                                'icon'=>'<i class="fa fa-users"></i>',
//                                'url'=>['/user/admin/index'],
//                                'visible'=>Yii::$app->user->can('/user/admin/index')
//                            ]
//                            ['label' => '角色列表', 'url'=>['/users/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],

                        ]
                    ],
                    [
                        'label' => '家长管理',
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' =>[
                            ['label'=>'家长列表', 'url'=>['#'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],

                        ]
                    ],
                    /*[
                        'label'=>Yii::t('backend', 'System'),
                        'options' => ['class' => 'header']
                    ],
                    [
                        'label'=>Yii::t('backend', 'Users'),
                        'icon'=>'<i class="fa fa-users"></i>',
                        'url'=>['/user/admin/index'],
                        'visible'=>Yii::$app->user->can('/user/admin/index')
                    ],
                    [
                        'label'=>Yii::t('backend', 'System'),
                        'url' => '#',
                        'icon'=>'<i class="fa fa-cogs"></i>',
                        'options'=>['class'=>'treeview'],
                        'items'=>[
                            [
                                'label'=>Yii::t('backend', 'i18n'),
                                'url' => '#',
                                'icon'=>'<i class="fa fa-flag"></i>',
                                'options'=>['class'=>'treeview'],
                                'items'=>[
                                    ['label'=>Yii::t('backend', 'i18n Source Message'), 'url'=>['/i18n/i18n-source-message/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                    ['label'=>Yii::t('backend', 'i18n Message'), 'url'=>['/i18n/i18n-message/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ]
                            ],
                            ['label'=>Yii::t('backend', 'Users'), 'url'=>['/user/admin/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>', 'visible'=>Yii::$app->user->can('/user/admin/index')],
                            ['label'=>Yii::t('backend', 'File Storage'), 'url'=>['/file-storage/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ['label'=>Yii::t('backend', 'Cache'), 'url'=>['/cache/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ['label'=>Yii::t('backend', 'File Manager'), 'url'=>['/file-manager/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            [
                                'label'=>Yii::t('backend', 'System Information'),
                                'url'=>['/system-information/index'],
                                'icon'=>'<i class="fa fa-angle-double-right"></i>'
                            ],
                        ]
                    ]*/
                ]
            ]) ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $this->title ?>
                <?php if (isset($this->params['subtitle'])): ?>
                    <small><?php echo $this->params['subtitle'] ?></small>
                <?php endif; ?>
            </h1>

            <?php echo Breadcrumbs::widget([
                'tag'=>'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php if (Yii::$app->session->hasFlash('alert')):?>
                <?php echo \yii\bootstrap\Alert::widget([
                    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                ])?>
            <?php endif; ?>
            <?php echo $content ?>
        </section><!-- /.content -->
        <div class="clearfix"></div>
    </div><!-- /.right-side -->

    <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.3
        </div>
        <strong>Copyright &copy; 2016 + <a href="<?= Yii::$app->urlManagerFrontend->baseUrl ?>">Xu Yan Industrial Investment Co., Ltd</a>.</strong> All rights Kami
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
<?php
$js = <<<EOF
<script>
    $(document).ready(function () {
        $('.click').click(function (event) {
            event.preventDefault();
            //$(this).children('.opened').toggle();
            //$(this).children('.closed').toggle();
            $(this).parent().children('ul').toggle();
            $(this).parent().toggleClass('active');
            return false;
        });
    });
</script>
EOF;

$this->registerJs($js);
?>

