<?php

class ErrorController extends Controller
{
    public $layout = 'error';

    /**
     * Отображение ошибки
     * @param int $code код ошибки
     */
    public function actionIndex($code)
    {
        http_response_code($code);

        $this->prepareSeo(\Yii::t('error', 'error.' . $code));

        $this->breadcrumbs->add('Страница не найдена');

        $this->render('index', compact('code'));
    }

    /**
     * Обработка ошибок
     */
    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;
        $this->actionIndex($error['code']);
        exit;

        if (YII_DEBUG) {
            echo 'IS DEBUG MODE<br/>Error code: ' . $error['code'] . '<br/>Error message: ' . $error['message'];
            \Yii::app()->end();
            die;
        }

        /*if($error && in_array($error['code'], array(400, 403, 404, 500))) {
            $this->redirect('/'.$error['code']);
        }*/

        $this->redirect("/404");
    }
}
