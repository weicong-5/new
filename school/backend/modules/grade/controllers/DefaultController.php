<?php

namespace backend\modules\grade\controllers;

use yii\web\Controller;

/**
 * Default controller for the `grade` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
