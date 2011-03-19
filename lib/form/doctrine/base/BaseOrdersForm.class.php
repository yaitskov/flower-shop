<?php

/**
 * Orders form base class.
 *
 * @method Orders getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrdersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'number'              => new sfWidgetFormInputText(),
      'ordered_at'          => new sfWidgetFormDateTime(),
      'deadline'            => new sfWidgetFormDateTime(),
      'accepted_at'         => new sfWidgetFormDateTime(),
      'completed_at'        => new sfWidgetFormDateTime(),
      'canceled_at'         => new sfWidgetFormDateTime(),
      'cancel_description'  => new sfWidgetFormInputText(),
      'client_requirements' => new sfWidgetFormTextarea(),
      'client_phone'        => new sfWidgetFormInputText(),
      'client_name'         => new sfWidgetFormInputText(),
      'client_email'        => new sfWidgetFormInputText(),
      'order_amount'        => new sfWidgetFormInputText(),
      'client_id'           => new sfWidgetFormInputText(),
      'responsible_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => true)),
      'posy_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'number'              => new sfValidatorString(array('max_length' => 40)),
      'ordered_at'          => new sfValidatorDateTime(),
      'deadline'            => new sfValidatorDateTime(),
      'accepted_at'         => new sfValidatorDateTime(array('required' => false)),
      'completed_at'        => new sfValidatorDateTime(array('required' => false)),
      'canceled_at'         => new sfValidatorDateTime(array('required' => false)),
      'cancel_description'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'client_requirements' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'client_phone'        => new sfValidatorString(array('max_length' => 50)),
      'client_name'         => new sfValidatorString(array('max_length' => 100)),
      'client_email'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'order_amount'        => new sfValidatorNumber(),
      'client_id'           => new sfValidatorInteger(array('required' => false)),
      'responsible_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'required' => false)),
      'posy_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Orders', 'column' => array('number')))
    );

    $this->widgetSchema->setNameFormat('orders[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }

}
