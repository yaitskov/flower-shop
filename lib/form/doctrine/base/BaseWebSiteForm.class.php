<?php

/**
 * WebSite form base class.
 *
 * @method WebSite getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWebSiteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'visitors_a_hour' => new sfWidgetFormInputText(),
      'visitors_a_day'  => new sfWidgetFormInputText(),
      'support_email'   => new sfWidgetFormInputText(),
      'birth_year'      => new sfWidgetFormInputText(),
      'about'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'visitors_a_hour' => new sfValidatorInteger(array('required' => false)),
      'visitors_a_day'  => new sfValidatorInteger(array('required' => false)),
      'support_email'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'birth_year'      => new sfValidatorInteger(array('required' => false)),
      'about'           => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('web_site[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WebSite';
  }

}
