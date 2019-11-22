<?php

namespace app\modules\v1\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class SiteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        exit('V1 Modules SiteController Index ');
        return $this->render('index');
    }
}
