<?php

/**
 * This is the model class for table "articles".
 *
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property string $alias
 * @property string $preview_image
 * @property integer $preview_image_enable
 * @property string $preview_image_alt
 * @property string $title
 * @property string $intro
 * @property string $text
 * @property string $create_time
 * @property string $update_time
 */

use common\components\helpers\HArray as A;


class Article extends \common\components\base\ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'articles';
	}
    /**
     * (non-PHPdoc)
     * @see \CModel::behaviors()
     */
    public function behaviors()
    {
        return A::m(parent::behaviors(), [
            'aliasBehavior'=>'\DAliasBehavior',
            'metaBehavior'=>'\MetadataBehavior',
            'publishedBehavior'=> '\common\ext\active\behaviors\PublishedBehavior',
            'updateTimeBehavior'=>[
                'class'=>'\common\ext\updateTime\behaviors\UpdateTimeBehavior',
                'addColumn'=>false
            ],
            'mainImageBehavior'=>[
                'class'=>'\common\ext\file\behaviors\FileBehavior',
                'attribute'=>'preview_image',
                'attributeLabel'=>'Изображение',
                'attributeEnable'=>'preview_image_enable',
                'attributeAlt'=>'preview_image_alt',
                'attributeAltEmpty'=>'title',
                'enableValue'=>true,
                'defaultSrc'=>'/images/article/empty.jpg',
                'imageMode'=>true
            ],
            'sortFieldBehavior' => [
                'class'=>'\common\ext\sort\behaviors\SortFieldBehavior',
                'addColumn'=>false,
                'attribute'=>'sort',
                'attributeLabel'=>'Сортировка',
                'asc'=>false,
                'step'=>10,
                'default'=>0
            ]
        ]);
    }


    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return $this->getRules(array(
			array('create_time, title, text', 'required'),
			array('preview_image_enable', 'numerical', 'integerOnly'=>true),
			array('alias, preview_image, preview_image_alt, title', 'length', 'max'=>255),
			array('intro, text, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alias, preview_image, preview_image_enable, preview_image_alt, title, intro, text, create_time, update_time', 'safe', 'on'=>'search'),
		));
	}

    /**
     * @return array relational rules.
     */
    public function scopes()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return $this->getScopes(
            array()
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return $this->getRelations(
		    array()
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return $this->getAttributeLabels(array(
			'id' => 'ID',
			'alias' => 'Алиас',
			'title' => 'Заголовок статьи',
			'intro' => 'Превью текста',
			'text' => 'Статья',
			'create_time' => 'Время создания',
			'update_time' => 'Время изменения',
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('preview_image',$this->preview_image,true);
		$criteria->compare('preview_image_enable',$this->preview_image_enable);
		$criteria->compare('preview_image_alt',$this->preview_image_alt,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTmbSrc()
    {
        return $this->mainImageBehavior->getTmbSrc($width=248);
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
