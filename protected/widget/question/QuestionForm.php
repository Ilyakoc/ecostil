<?php
/**
 * Виджет формы добавления нового вопроса
 *
 */

use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;

class QuestionForm extends \CWidget
{
    /**
     * @var string ссылка на действие добавления
     */
    public $actionUrl;

    /**
     * @var boolean режим всплывающего окна
     */
    public $popup = true;

    public $view = 'question_form';

    public $params = [];

    public $options = [];

    /**
     * (non-PHPdoc)
     * @see \CWidget::init()
     */
    public function init()
    {
        $path = dirname(__FILE__) . Y::DS . 'assets' . Y::DS . 'question_form';

        Y::publish([
            'path' => $path,
            'js' => 'js/QuestionFormWidget.js',
            'css' => 'css/styles.css'
        ]);

        $t = Y::ct('question');
        $options = A::m([
            'w_nrf_mgs_success' => $t('msg.success'),
            'w_nrf_mgs_error' => $t('msg.error'),
            'w_nrf_mgs_error_max_try' => $t('msg.error.maxTry')
        ], $this->options);
        Y::js('QuestionFormWidget', ';window.QuestionFormWidget.init(' . \CJavaScript::encode($options) . ');', \CClientScript::POS_READY);
    }

    /**
     * (non-PHPdoc)
     * @see \CWidget::run()
     */
    public function run()
    {
        $model = new Question('frontend_insert');
        $this->render($this->view, compact('model'));
    }
}
