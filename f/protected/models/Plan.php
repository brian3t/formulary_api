<?php

/**
 * This is the model class for table "plan".
 *
 * The followings are the available columns in table 'plan':
 * @property integer $id
 * @property integer $f_id
 * @property string $name
 * @property string $origin_url
 * @property string $state_code
 * @property integer $is_medicare
 * @property string $is_medicare_char
 */
class Plan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_id, is_medicare', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>800),
			array('origin_url', 'length', 'max'=>5000),
			array('state_code', 'length', 'max'=>2),
			array('is_medicare_char', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, f_id, name, origin_url, state_code, is_medicare, is_medicare_char', 'safe', 'on'=>'search'),
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
			'f_id' => 'F',
			'name' => 'Name',
			'origin_url' => 'Origin Url',
			'state_code' => 'State Code',
			'is_medicare' => 'Is Medicare',
			'is_medicare_char' => 'Is Medicare Char',
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
		$criteria->compare('f_id',$this->f_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('origin_url',$this->origin_url,true);
		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('is_medicare',$this->is_medicare);
		$criteria->compare('is_medicare_char',$this->is_medicare_char,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
