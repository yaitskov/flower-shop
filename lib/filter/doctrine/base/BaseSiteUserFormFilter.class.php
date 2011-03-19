<?php

/**
 * SiteUser filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSiteUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'login'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'firstname'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lastname'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'patronymic'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'personal_phone' => new sfWidgetFormFilterInput(),
      'employee_phone' => new sfWidgetFormFilterInput(),
      'is_blogger'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'signature'      => new sfWidgetFormFilterInput(),
      'is_client'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'discount'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_root'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'registered_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_employee'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_login_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'face_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'login'          => new sfValidatorPass(array('required' => false)),
      'email'          => new sfValidatorPass(array('required' => false)),
      'firstname'      => new sfValidatorPass(array('required' => false)),
      'lastname'       => new sfValidatorPass(array('required' => false)),
      'patronymic'     => new sfValidatorPass(array('required' => false)),
      'personal_phone' => new sfValidatorPass(array('required' => false)),
      'employee_phone' => new sfValidatorPass(array('required' => false)),
      'is_blogger'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'signature'      => new sfValidatorPass(array('required' => false)),
      'is_client'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'discount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'password'       => new sfValidatorPass(array('required' => false)),
      'is_root'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'registered_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_employee'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'face_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Photo'), 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('site_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SiteUser';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'login'          => 'Text',
      'email'          => 'Text',
      'firstname'      => 'Text',
      'lastname'       => 'Text',
      'patronymic'     => 'Text',
      'personal_phone' => 'Text',
      'employee_phone' => 'Text',
      'is_blogger'     => 'Boolean',
      'signature'      => 'Text',
      'is_client'      => 'Boolean',
      'discount'       => 'Number',
      'password'       => 'Text',
      'is_root'        => 'Boolean',
      'registered_at'  => 'Date',
      'is_employee'    => 'Boolean',
      'last_login_at'  => 'Date',
      'face_id'        => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
