<?php
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
	public $validacion;

	public function rules()
	{
		return array(
			array('validacion',
				'application.extensions.recaptcha.EReCaptchaValidator',
				'privateKey'=>'6Le_pPsSAAAAAET7g5GPtDYZxM3HSlXaxWLHNYSd'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'validacion'=>Yii::t('demo', 'Enter both words separated by a space: '),
		);
	}

	public function checkAccess($operation, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $roles = explode(',', $this->getState("roles"));
        if (in_array('admin', $roles) || in_array($operation, $roles)){
            return true;
		}
		else{
			return false;
		}
    }
	public function getAccount(){
//		return $this->account_id;
//		return Account::model()->findByPk(user()->account_id);
	}


	public function hasRole($role){
		$roles = $this->roles;
		$roles = explode(",",$roles);
		return in_array($role,$roles,true);
	}
}
