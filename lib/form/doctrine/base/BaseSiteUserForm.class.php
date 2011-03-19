<?php

/**
 * SiteUser form base class.
 *
 * @method SiteUser getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSiteUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'login'          => new sfWidgetFormInputText(),
      'email'          => new sfWidgetFormInputText(),
      'firstname'      => new sfWidgetFormInputText(),
      'lastname'       => new sfWidgetFormInputText(),
      'patronymic'     => new sfWidgetFormInputText(),
      'personal_phone' => new sfWidgetFormInputText(),
      'employee_phone' => new sfWidgetFormInputText(),
      'is_blogger'     => new sfWidgetFormInputCheckbox(),
      'signature'      => new sfWidgetFormInputText(),
      'is_client'      => new sfWidgetFormInputCheckbox(),
      'discount'       => new sfWidgetFormInputText(),
      'password'       => new sfWidgetFormInputText(),
      'is_root'        => new sfWidgetFormInputCheckbox(),
      'registered_at'  => new sfWidgetFormDateTime(),
      'is_employee'    => new sfWidgetFormInputCheckbox(),
      'last_login_at'  => new sfWidgetFormDateTime(),
      'face_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'login'          => new sfValidatorString(array('max_length' => 30)),
      'email'          => new sfValidatorString(array('max_length' => 100)),
      'firstname'      => new sfValidatorString(array('max_length' => 100)),
      'lastname'       => new sfValidatorString(array('max_length' => 100)),
      'patronymic'     => new sfValidatorString(array('max_length' => 100)),
      'personal_phone' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'employee_phone' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'is_blogger'     => new sfValidatorBoolean(array('required' => false)),
      'signature'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_client'      => new sfValidatorBoolean(array('required' => false)),
      'discount'       => new sfValidatorNumber(array('required' => false)),
      'password'       => new sfValidatorString(array('max_length' => 255)),
      'is_root'        => new sfValidatorBoolean(array('required' => false)),
      'registered_at'  => new sfValidatorDateTime(),
      'is_employee'    => new sfValidatorBoolean(array('required' => false)),
      'last_login_at'  => new sfValidatorDateTime(),
      'face_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'SiteUser', 'column' => array('login'))),
        new sfValidatorDoctrineUnique(array('model' => 'SiteUser', 'column' => array('email'))),
      ))
    );

    $this->widgetSchema->setNameFormat('site_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteUser';
  }

}
