<?php

/**
 * This is the model class for table "ad".
 *
 * The followings are the available columns in table 'ad':
 * @property integer $id
 * @property string $name
 * @property string $display_url
 * @property string $dest_url
 * @property string $image_url
 * @property string $description
 * @property string $title
 * @property string $cpc
 * @property integer $ad_group_id
 * @property integer $campaign_id
 *
 * The followings are the available model relations:
 * @property Campaign $campaign
 * @property AdGroup $adGroup
 * @property Imp[] $imps
 * @property Txn[] $txns
 */
class Ad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('campaign_id', 'required'),
			array('ad_group_id, campaign_id', 'numerical', 'integerOnly'=>true),
			array('name, title, cpc', 'length', 'max'=>45),
			array('display_url, dest_url, image_url', 'length', 'max'=>1024),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, display_url, dest_url, image_url, description, title, cpc, ad_group_id, campaign_id', 'safe', 'on'=>'search'),
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
			'campaign' => array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
			'adGroup' => array(self::BELONGS_TO, 'AdGroup', 'ad_group_id'),
			'imps' => array(self::HAS_MANY, 'Imp', 'ad_id'),
			'txns' => array(self::HAS_MANY, 'Txn', 'ad_id'),
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
			'display_url' => 'Display Url',
			'dest_url' => 'Dest Url',
			'image_url' => 'Image Url',
			'description' => 'Description',
			'title' => 'Title',
			'cpc' => 'Cpc',
			'ad_group_id' => 'Ad Group',
			'campaign_id' => 'Campaign',
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
		$criteria->compare('display_url',$this->display_url,true);
		$criteria->compare('dest_url',$this->dest_url,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('cpc',$this->cpc,true);
		$criteria->compare('ad_group_id',$this->ad_group_id);
		$criteria->compare('campaign_id',$this->campaign_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
