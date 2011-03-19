<?php

/**
 * PosyViewList filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePosyViewListFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'itmorder'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'posy_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => true)),
      'posyview_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PosyView'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'itmorder'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'posy_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posy'), 'column' => 'id')),
      'posyview_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PosyView'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('posy_view_list_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PosyViewList';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'itmorder'    => 'Number',
      'posy_id'     => 'ForeignKey',
      'posyview_id' => 'ForeignKey',
    );
  }
}
