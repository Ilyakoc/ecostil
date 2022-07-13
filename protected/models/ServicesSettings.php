<?php
/**
 * Настройки Услуг
 * 
 */
use common\components\helpers\HArray as A;

class ServicesSettings extends \settings\components\base\SettingsModel
{
	/**
	 * SEO
	 */
	public $meta_title;
	public $meta_desc;
	public $meta_key;
	public $meta_h1;
	
	/**
	 * @var string текст на главной странице
	 */
	public $main_text;
    
    /**
	 * @var string второй текст на главной странице
	 */
	public $main_text2;
    
	/**
	 * @var boolean для совместимости со старым виджетом
	 * редактора admin.widget.EditWidget.TinyMCE
	 */
	public $isNewRecord=false;

	public $template_type;
	
	/**
	 * Для совместимости со старым виджетом
	 * редактора admin.widget.EditWidget.TinyMCE
	 */
	public function tableName()
	{
		return 'services_settings';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \common\components\base\FormModel::behaviors()
	 */
	public function behaviors()
	{
		return A::m(parent::behaviors(), [
		]);
	}

	/**
	 * (non-PHPdoc)
	 * @see \settings\components\base\SettingsModel::rules()
	 */
	public function rules()
	{
		return $this->getRules([
			['meta_h1, meta_title, meta_key, meta_desc, main_text, main_text2, template_type', 'safe'],
		]);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \settings\components\base\SettingsModel::attributeLabels()
	 */
	public function attributeLabels()
	{
		return $this->getAttributeLabels([
			'meta_h1'=>'H1',
			'meta_title' => 'Meta Title',
			'meta_key' => 'Meta Keywords',
			'meta_desc' => 'Meta Description',
			'main_text'=>'Верхний текст на главной странице',
			'main_text2'=>'Нижний текст на главной странице',
			'template_type'=>'Тип шаблона',
		]);
	}

    public function getTemplateTypeList()
    {
        return [
            1 => 'service-template-type1',
            2 => 'service-template-type2',
        ];
    }

    public function getCurrentTemplateType()
    {
        return $this->getTemplateTypeList()[$this->template_type]??null;
    }
}
