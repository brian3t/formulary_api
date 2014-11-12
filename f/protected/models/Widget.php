<?php

/**
 * This is the model class for table "widget".
 *
 * The followings are the available columns in table 'widget':
 * @property integer $id
 * @property string $name
 * @property integer $publisher_id
 * @property integer $website_id
 * @property string $type
 * @property string $display_options
 * @property string $content_options
 * @property string $installation_code
 * @property integer $campaign_id
 * @property integer $placement_id
 *
 * The followings are the available model relations:
 * @property Imp[] $imps
 * @property Txn[] $txns
 * @property Account $publisher
 * @property Website $website
 * @property Campaign $campaign
 * @property Placement $placement
 */
class Widget extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'widget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publisher_id, website_id, campaign_id, placement_id', 'numerical', 'integerOnly'=>true),
			array('name, type', 'length', 'max'=>255),
			array('display_options, content_options', 'length', 'max'=>800),
			array('installation_code', 'length', 'max'=>8000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, publisher_id, website_id, type, display_options, content_options, installation_code, campaign_id, placement_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'imps' => array(self::HAS_MANY, 'Imp', 'widget_id'),
			'txns' => array(self::HAS_MANY, 'Txn', 'widget_id'),
			'publisher' => array(self::BELONGS_TO, 'Account', 'publisher_id'),
			'website' => array(self::BELONGS_TO, 'Website', 'website_id'),
			'campaign' => array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
			'placement' => array(self::BELONGS_TO, 'Placement', 'placement_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'publisher_id' => 'Publisher',
			'website_id' => 'Website',
			'type' => 'Type',
			'display_options' => 'Display Options',
			'content_options' => 'Content Options',
			'installation_code' => 'Installation Code',
			'campaign_id' => 'Campaign',
			'placement_id' => 'Placement',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('publisher_id',$this->publisher_id);
		$criteria->compare('website_id',$this->website_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('display_options',$this->display_options,true);
		$criteria->compare('content_options',$this->content_options,true);
		$criteria->compare('installation_code',$this->installation_code,true);
		$criteria->compare('campaign_id',$this->campaign_id);
		$criteria->compare('placement_id',$this->placement_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Widget the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
