<?php

/**
 * WebSite filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWebSiteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'visitors_a_hour' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'visitors_a_day'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'support_email'   => new sfWidgetFormFilterInput(),
      'birth_year'      => new sfWidgetFormFilterInput(),
      'about'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'visitors_a_hour' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'visitors_a_day'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'support_email'   => new sfValidatorPass(array('required' => false)),
      'birth_year'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'about'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('web_site_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WebSite';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'visitors_a_hour' => 'Number',
      'visitors_a_day'  => 'Number',
      'support_email'   => 'Text',
      'birth_year'      => 'Number',
      'about'           => 'Text',
    );
  }
}
