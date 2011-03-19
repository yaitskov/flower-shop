<?php

/**
 * PosyViewList form base class.
 *
 * @method PosyViewList getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePosyViewListForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'itmorder'    => new sfWidgetFormInputText(),
      'posy_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => false)),
      'posyview_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PosyView'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'itmorder'    => new sfValidatorInteger(),
      'posy_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'))),
      'posyview_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PosyView'))),
    ));

    $this->widgetSchema->setNameFormat('posy_view_list[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PosyViewList';
  }

}
