<?php

/**
 * Posy form base class.
 *
 * @method Posy getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePosyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'client_made'  => new sfWidgetFormInputCheckbox(),
      'numlinks'     => new sfWidgetFormInputText(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'published_at' => new sfWidgetFormDateTime(),
      'created_at'   => new sfWidgetFormDateTime(),
      'price_type'   => new sfWidgetFormChoice(array('choices' => array('unknown' => 'unknown', 'constant' => 'constant', 'variable' => 'variable'))),
      'const_price'  => new sfWidgetFormInputText(),
      'icon'         => new sfWidgetFormInputText(),
      'publisher_id' => new sfWidgetFormInputText(),
      'author_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => false)),
      'album_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => false)),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'client_made'  => new sfValidatorBoolean(array('required' => false)),
      'numlinks'     => new sfValidatorInteger(array('required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 100)),
      'description'  => new sfValidatorString(array('max_length' => 3000, 'required' => false)),
      'published_at' => new sfValidatorDateTime(),
      'created_at'   => new sfValidatorDateTime(),
      'price_type'   => new sfValidatorChoice(array('choices' => array(0 => 'unknown', 1 => 'constant', 2 => 'variable'))),
      'const_price'  => new sfValidatorNumber(array('required' => false)),
      'icon'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'publisher_id' => new sfValidatorInteger(),
      'author_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'))),
      'album_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'))),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Posy', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('posy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Posy';
  }

}
