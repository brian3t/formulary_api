<?php

/**
 * This is the model class for table "fda_ndc".
 *
 * The followings are the available columns in table 'fda_ndc':
 * @property integer $id
 * @property string $productndc
 * @property string $nonproprietaryname
 * @property string $substancename
 * @property string $active_numerator_strength
 * @property string $active_ingred_unit
 */
class Drug extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fda_ndc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productndc', 'required'),
//			array('name, name_param', 'length', 'max'=>800),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('productndc, nonproprietaryname', 'safe', 'on'=>'search'),
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
			'productndc' => 'NDC',
			'nonproprietaryname' => 'Non Proprietary Name',
			'substancename' => 'Substance Name',
			'active_numerator_strength' => 'Active Numerator Strength',
			'active_ingred_unit' => 'Active Ingredient Unit',
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
		$criteria->compare('productndc',$this->productndc,true);
		$criteria->compare('nonproprietaryname',$this->nonproprietaryname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Drug the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
