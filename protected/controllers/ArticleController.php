<?php

use common\components\helpers\HYii as Y;
class ArticleController extends Controller
{
    /**
     * (non-PHPdoc)
     * @see AdminController::filters()
     */
    public function filters()
    {
        return CMap::mergeArray(parent::filters(), array(
            array('DModuleFilter', 'name' => 'articles'),
        ));
    }

    public function actionIndex()
    {
        $dataProvider = Article::model()->published()->getDataProvider([
            'pagination' => ['pageSize' => 12]
        ]);

        $this->prepareSeo('Статьи');
        $this->breadcrumbs->add('Статьи');

        if (Y::request()->isAjaxRequest) {
            $this->renderPartial('_article_loop', compact('dataProvider'), false, true);
            Y::end();
        }

        $this->render('index', compact('dataProvider'));
    }

    public function actionView($alias)
    {
        $article = \Article::model()->findByAttributes(['alias' => $alias]);
        if (!$article) {
            throw new CHttpException('404', 'Страница не найдена');
        }
        $this->prepareSeo($this->getArticlesHomeTitle());
        $this->breadcrumbs->add($this->getArticlesHomeTitle(), '/articles');
        $this->breadcrumbs->add($article['title']);
        $this->render('view', compact('article'));
    }

    public function getArticlesHomeTitle()
    {
        return D::cms('article_title', Yii::t('article', 'article_title'));
    }
}