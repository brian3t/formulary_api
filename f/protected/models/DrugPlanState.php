<?php

/**
 * This is the model class for table "drug_plan_state".
 *
 * The followings are the available columns in table 'drug_plan_state':
 * @property integer $id
 * @property integer $f_plan_id
 * @property string $state_code
 * @property string $drug_name_param
 * @property integer $drug_id
 * @property string $tier_code
 * @property string $additional_info
 * @property string $restriction_code
 */
class DrugPlanState extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'drug_plan_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_plan_id, state_code, drug_name_param, drug_id', 'required'),
			array('f_plan_id, drug_id', 'numerical', 'integerOnly'=>true),
			array('state_code, restriction_code', 'length', 'max'=>2),
			array('drug_name_param', 'length', 'max'=>2000),
			array('tier_code', 'length', 'max'=>4),
			array('additional_info', 'length', 'max'=>2500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, f_plan_id, state_code, drug_name_param, drug_id, tier_code, additional_info, restriction_code', 'safe', 'on'=>'search'),
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
			'f_plan_id' => 'F Plan',
			'state_code' => 'State Code',
			'drug_name_param' => 'Drug Name Param',
			'drug_id' => 'Drug',
			'tier_code' => 'Tier Code',
			'additional_info' => 'Additional Info',
			'restriction_code' => 'Restriction Code',
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
		$criteria->compare('f_plan_id',$this->f_plan_id);
		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('drug_name_param',$this->drug_name_param,true);
		$criteria->compare('drug_id',$this->drug_id);
		$criteria->compare('tier_code',$this->tier_code,true);
		$criteria->compare('additional_info',$this->additional_info,true);
		$criteria->compare('restriction_code',$this->restriction_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DrugPlanState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
