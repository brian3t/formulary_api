<?php

/**
 * This is the model class for table "campaign".
 *
 * The followings are the available columns in table 'campaign':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $create_date
 * @property string $end_date
 * @property string $geo
 * @property string $mo_budget
 * @property string $device
 * @property string $language
 * @property integer $website_id
 * @property double $cpc
 *
 * The followings are the available model relations:
 * @property Ad[] $ads
 * @property AdGroup[] $adGroups
 * @property Website $website
 * @property Widget[] $widgets
 */
class Campaign extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'campaign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('website_id', 'required'),
			array('website_id', 'numerical', 'integerOnly'=>true),
			array('cpc', 'numerical'),
			array('name, start_date, end_date, geo, mo_budget, device, language', 'length', 'max'=>45),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, start_date, create_date, end_date, geo, mo_budget, device, language, website_id, cpc', 'safe', 'on'=>'search'),
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
			'ads' => array(self::HAS_MANY, 'Ad', 'campaign_id'),
			'adGroups' => array(self::HAS_MANY, 'AdGroup', 'campaign_id'),
			'website' => array(self::BELONGS_TO, 'Website', 'website_id'),
			'widgets' => array(self::HAS_MANY, 'Widget', 'campaign_id'),
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
			'start_date' => 'Start Date',
			'create_date' => 'Create Date',
			'end_date' => 'End Date',
			'geo' => 'Geo',
			'mo_budget' => 'Monthly Budget',
			'device' => 'Device',
			'language' => 'Language',
			'website_id' => 'Website',
			'cpc' => 'Cpc',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('geo',$this->geo,true);
		$criteria->compare('mo_budget',$this->mo_budget,true);
		$criteria->compare('device',$this->device,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('website_id',$this->website_id);
		$criteria->compare('cpc',$this->cpc);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Campaign the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
