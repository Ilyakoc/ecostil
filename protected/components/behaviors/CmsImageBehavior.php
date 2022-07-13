<?php
use common\components\helpers\HYii as Y;
use common\components\helpers\HArray as A;

/**
 * Поведение изображения
 * 
 * !NOTE: Краткая инструкция по подключению
 * - Перевести модель \SettingsForm на \common\components\base\FormModel
 * - Добавить свойство public для $attribute
 * - Добавить метод: public function update($attributes=[]) { parent::update(); $this->saveSettings(); }
 * - Заменить в DefaultController saveSettings() на save()
 * - для поля формы использовать $model->имяПоведения->renderCmsImageField($form);
 */
class CmsImageBehavior extends \CBehavior
{
    public $attribute;
    public $label;
    public $path='webroot.images.cms';
    public $baseUrl='/images/cms';
    public $types='png, jpg, jpeg, svg';
    public $saveCallback=null;

    public function events()
    {
        return [
            'onBeforeSave'=>'beforeSave'
        ];
    }

    public function attach($owner)
    {
        parent::attach($owner);
        $this->owner->addDynamicAttribute($this->getCmsImageAttributeFile());
    }

    public function rules()
    {
        return [
            [$this->getCmsImageAttributeFile(), 'file', 'allowEmpty'=>true, 'types'=>$this->types]
        ];
    }

    public function attributeLabels()
    {
        return [
            $this->attribute=>$this->label
        ];
    }

    public function getCmsImagePath()
	{
		$path = Yii::getPathOfAlias($this->path);
		if(!is_dir($path)) {
			mkdir($path, 0755, true);
			chmod($path, 0755);
		}
		return $path;
	}

	public function getCmsImageAttributeFile()
	{
		return $this->attribute . '__file';
    }

	public function getCmsImageAttributeDeleteFile()
	{
		return $this->attribute . '__deletefile';
    }
    
    public function getCmsImageFileName()
    {
        if($this->owner->{$this->attribute}) {
            $filename=$this->getCmsImagePath() . '/' . $this->owner->{$this->attribute};
            if(is_file($filename)) {
                return $filename;
            }
        }
        return null;
    }

	public function getCmsImageSrc()
	{
        if($this->getCmsImageFileName()) {
			return $this->baseUrl . '/' . $this->owner->{$this->attribute};
		}
		return null;
    }
    
    public function getCmsImage($htmlOptions=[], $defaultSrc=null)
    {
        $src=$this->getCmsImageSrc() ?: $defaultSrc;        
        if($src) {
            return \CHtml::image($src, A::get($htmlOptions, 'alt', ''), $htmlOptions);
        }
    }

	public function beforeSave()
	{
        $attributeDeleteFile=$this->getCmsImageAttributeDeleteFile();
        if(isset($_REQUEST[$attributeDeleteFile]) && $_REQUEST[$attributeDeleteFile]=='delete') {
            $this->removeCmsImage();
        }
        
        $attributeFile=$this->getCmsImageAttributeFile();
        $file = \CUploadedFile::getInstance($this->owner, $attributeFile);
        if ($file instanceof \CUploadedFile) {
            $this->removeCmsImage();
            $this->createCmsImage($file);
        }

        if(!is_string($this->saveCallback) && is_callable($this->saveCallback)) {
            call_user_func($this->saveCallback, $this);
        }
        
		$this->owner->$attributeFile=null;
	}

	/**
	 * Создание изображения для CMS
	 *
	 * @param \CUploadedFile $file
	 * @param string $attribute
	 * @return string
	 */
	public function createCmsImage($file)
    {
		$path=$this->getCmsImagePath();
		$filename = $this->attribute . '.' . strtolower($file->extensionName);
		$file->saveAs($path . '/' . $filename);		
		$this->owner->{$this->attribute}=$filename;
    }

	/**
	 * Удаление изображения CMS
	 *
	 * @param string $attribute
	 * @return void
	 */
	public function removeCmsImage()
	{
        if($filename=$this->getCmsImageFileName()) {
            unlink($filename);
        }
		$this->owner->{$this->attribute}='';
    }

    public function renderCmsImageField($form)
    {
        $htmlImageBox='';
        if($src=$this->getCmsImageSrc()) {
            Y::js('cmsimage__field', '
                $(document).on("click", ".js-cmsimage-change", function(e) {$(e.target).parents(".row").find(":file").toggleClass("hidden");});
                $(document).on("click", ".js-cmsimage-delete", function(e) {
                    if(confirm("Вы действительно хотите удалить файл?\nУдаление произойдет после сохранения формы")){
                        $(e.target).siblings(".js-cmsimage-delete-field").val("delete");
                        $(e.target).parents(".cmsimage__box").hide();
                        $(e.target).parents(".cmsimage__box").parent().find(":file").removeClass("hidden");
                    }
                });
            ', \CClientScript::POS_READY);
            $htmlImageBox=<<<EOL
            <div id="{$this->attribute}__imagebox" class="cmsimage__box {$this->attribute}__imagebox">
                <div class="img">
                    <img src="{$src}" alt="" />
                </div>
                <p>
                    <a class="js-link js-cmsimage-change" style="margin-right:20px">Изменить</a>
                    <a class="js-link js-cmsimage-delete">Удалить</a>
                    <input type="hidden" class="js-cmsimage-delete-field" name="{$this->getCmsImageAttributeDeleteFile()}" value="" />
                </p>
            </div>
EOL;
        }

        $fileHtmlOptions=$htmlImageBox ? ['class'=>'hidden'] : [];

        $html=<<<EOL
        <div class="row">
            {$form->labelEx($this->owner, $this->attribute)}
            {$htmlImageBox}
            {$form->fileField($this->owner, $this->getCmsImageAttributeFile(), $fileHtmlOptions)}
            {$form->error($this->owner, $this->getCmsImageAttributeFile())}
        </div>
EOL;

        echo $html;
    }
}