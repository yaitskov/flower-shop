<?php

/**
 * DayStatistic filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDayStatisticFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hour'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'visits'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orders'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'messages'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'authenticated_visits' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'hour'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'visits'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orders'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'messages'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'authenticated_visits' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('day_statistic_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DayStatistic';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'hour'                 => 'Number',
      'visits'               => 'Number',
      'orders'               => 'Number',
      'messages'             => 'Number',
      'authenticated_visits' => 'Number',
    );
  }
}
