<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rick
 * Date: 05.03.12
 * Time: 11:49
 * To change this template use File | Settings | File Templates.
 */

use common\ext\email\components\helpers\HEmail;
use common\components\helpers\HArray as A;
use common\components\helpers\HAjax;
use common\components\helpers\HDb;


class QuestionController extends Controller
{
    /**
     * (non-PHPdoc)
     * @see AdminController::filters()
     */
    public function filters()
    {
        return A::m(parent::filters(), [
            ['\DModuleFilter', 'name' => 'question'],
            'ajaxOnly +addQuestion'
        ]);
    }

    public function actionIndex()
    {
        $model = new Question();

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];

            if ($model->save()) {
                HEmail::cmsAdminSend(true, ['model' => $model], 'application.views.question._email');
                echo 'ok';
            } else {
                echo 'error';
            }

            Yii::app()->end();
        }

        $dataProvider = Question::model()
            ->published()
            ->byCreateDateDesc()
            ->getDataProvider(['pagination' => ['pageSize' => 2, 'pageVar' => 'page']]);


        $this->prepareSeo('Вопрос-ответ');

        $this->breadcrumbs->add('Вопрос-ответ');

        $this->render('index1', compact('dataProvider', 'model'));
    }

    public function actionAddQuestion()
    {
        $model = new Question('frontend_insert');
        if(HDb::massiveAssignment($model)) {
            $save = $model->save();

            if ($save) {
                HEmail::cmsAdminSend(true, ['model'=>$model], '_email');
            }

            HAjax::end($save, ['message'=>''], $model->getErrors());
        }

        HAjax::end(false);
    }
}
