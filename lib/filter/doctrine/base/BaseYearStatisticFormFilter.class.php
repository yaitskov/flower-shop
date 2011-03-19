<?php

/**
 * YearStatistic filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseYearStatisticFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'visits'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orders'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'messages'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'authenticated_visits' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'visits'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orders'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'messages'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'authenticated_visits' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('year_statistic_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'YearStatistic';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'created_at'           => 'Date',
      'visits'               => 'Number',
      'orders'               => 'Number',
      'messages'             => 'Number',
      'authenticated_visits' => 'Number',
    );
  }
}
