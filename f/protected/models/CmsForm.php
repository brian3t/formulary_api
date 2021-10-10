<?php

/**
 * This is the model class for table "cms_drug_form".
 *
 * The followings are the available columns in table 'cms_drug_form':
 * @property integer $id
 * @property string $formulary_id
 * @property string $formulary_version
 * @property string $contract_year
 * @property integer $rxcui
 * @property string $orig_ndc
 * @property string $ndc
 * @property int $tier_level_value
 * @property int $quantity_limit_yn
 * @property int $quantity_limit_amount
 * @property int $quantity_limit_days
 * @property string $created_at
 */
class CmsForm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_drug_form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('formulary_id, ndc', 'required'),
			// The following rule is used by search().
			array('id, formulary_id, ndc, tier_level_value', 'safe', 'on'=>'search'),
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
			'formulary_id' => 'Formulary ID',
			'formulary_version' => 'Formulary Version',
			'contract_year' => 'Contract Year',
			'rxcui' => 'RXCUI',
			'ndc' => 'NDC',
			'tier_level_value' => 'Tier Level',
			'quantity_limit_yn' => 'Qty Limit?',
			'quantity_limit_amount' => 'Qty Limit Amt',
			'quantity_limit_days' => 'Qty Limit Days',
			'created_at' => 'Created At',
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
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('formulary_id',$this->formulary_id);
		$criteria->compare('tier_level_value',$this->tier_level_value);
		$criteria->compare('ndc',$this->ndc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DrugFormulary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
