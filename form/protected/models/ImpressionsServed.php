<?php

/**
 * This is the model class for table "impressions_served".
 *
 * The followings are the available columns in table 'impressions_served':
 * @property integer $id
 * @property string $advertiser_site_id
 * @property string $advertiser_account_id
 * @property string $adv_campaign_id
 * @property string $adv_ad_group
 * @property string $adv_ad
 * @property string $publisher_placement_id
 * @property string $publisher_account_id
 * @property integer $clicked
 */
class ImpressionsServed extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'impressions_served';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clicked', 'numerical', 'integerOnly'=>true),
			array('advertiser_site_id, advertiser_account_id, adv_campaign_id, adv_ad_group, adv_ad, publisher_placement_id, publisher_account_id', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, advertiser_site_id, advertiser_account_id, adv_campaign_id, adv_ad_group, adv_ad, publisher_placement_id, publisher_account_id, clicked', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'advertiser_site_id' => 'Advertiser Site',
			'advertiser_account_id' => 'Advertiser Account',
			'adv_campaign_id' => 'Adv Campaign',
			'adv_ad_group' => 'Adv Ad Group',
			'adv_ad' => 'Adv Ad',
			'publisher_placement_id' => 'Publisher Placement',
			'publisher_account_id' => 'Publisher Account',
			'clicked' => 'Clicked',
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
		$criteria->compare('advertiser_site_id',$this->advertiser_site_id,true);
		$criteria->compare('advertiser_account_id',$this->advertiser_account_id,true);
		$criteria->compare('adv_campaign_id',$this->adv_campaign_id,true);
		$criteria->compare('adv_ad_group',$this->adv_ad_group,true);
		$criteria->compare('adv_ad',$this->adv_ad,true);
		$criteria->compare('publisher_placement_id',$this->publisher_placement_id,true);
		$criteria->compare('publisher_account_id',$this->publisher_account_id,true);
		$criteria->compare('clicked',$this->clicked);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImpressionsServed the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
