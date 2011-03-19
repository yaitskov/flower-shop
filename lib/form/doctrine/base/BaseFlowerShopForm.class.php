<?php

/**
 * FlowerShop form base class.
 *
 * @method FlowerShop getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFlowerShopForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'phone'         => new sfWidgetFormInputText(),
      'start_work_at' => new sfWidgetFormTime(),
      'end_work_at'   => new sfWidgetFormTime(),
      'name'          => new sfWidgetFormInputText(),
      'email_address' => new sfWidgetFormInputText(),
      'mail_address'  => new sfWidgetFormTextarea(),
      'outline_route' => new sfWidgetFormTextarea(),
      'map_x'         => new sfWidgetFormInputText(),
      'map_y'         => new sfWidgetFormInputText(),
      'place_x'       => new sfWidgetFormInputText(),
      'place_y'       => new sfWidgetFormInputText(),
      'map_scale'     => new sfWidgetFormInputText(),
      'map_width'     => new sfWidgetFormInputText(),
      'map_heigth'    => new sfWidgetFormInputText(),
      'views'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'phone'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'start_work_at' => new sfValidatorTime(array('required' => false)),
      'end_work_at'   => new sfValidatorTime(array('required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'email_address' => new sfValidatorEmail(array('max_length' => 100, 'required' => false)),
      'mail_address'  => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'outline_route' => new sfValidatorString(array('max_length' => 3000, 'required' => false)),
      'map_x'         => new sfValidatorNumber(array('required' => false)),
      'map_y'         => new sfValidatorNumber(array('required' => false)),
      'place_x'       => new sfValidatorNumber(array('required' => false)),
      'place_y'       => new sfValidatorNumber(array('required' => false)),
      'map_scale'     => new sfValidatorInteger(array('required' => false)),
      'map_width'     => new sfValidatorInteger(array('required' => false)),
      'map_heigth'    => new sfValidatorInteger(array('required' => false)),
      'views'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'))),
    ));

    $this->widgetSchema->setNameFormat('flower_shop[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FlowerShop';
  }

}
