<?php

/**
 * DayStatistic form base class.
 *
 * @method DayStatistic getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDayStatisticForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'hour'                 => new sfWidgetFormInputText(),
      'visits'               => new sfWidgetFormInputText(),
      'orders'               => new sfWidgetFormInputText(),
      'messages'             => new sfWidgetFormInputText(),
      'authenticated_visits' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'hour'                 => new sfValidatorInteger(),
      'visits'               => new sfValidatorInteger(),
      'orders'               => new sfValidatorInteger(),
      'messages'             => new sfValidatorInteger(),
      'authenticated_visits' => new sfValidatorInteger(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'DayStatistic', 'column' => array('hour')))
    );

    $this->widgetSchema->setNameFormat('day_statistic[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DayStatistic';
  }

}
