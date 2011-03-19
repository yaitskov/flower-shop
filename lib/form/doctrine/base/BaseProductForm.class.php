<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'vendor'            => new sfWidgetFormInputText(),
      'amount'            => new sfWidgetFormInputText(),
      'price'             => new sfWidgetFormInputText(),
      'last_entrance'     => new sfWidgetFormDateTime(),
      'is_home_plant'     => new sfWidgetFormInputCheckbox(),
      'temperature_range' => new sfWidgetFormInputText(),
      'blossoming_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Blossoming'), 'add_empty' => true)),
      'blossoming_start'  => new sfWidgetFormDate(),
      'blossoming_end'    => new sfWidgetFormDate(),
      'sun'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SunSense'), 'add_empty' => true)),
      'sprinkling_period' => new sfWidgetFormInputText(),
      'size'              => new sfWidgetFormInputText(),
      'weight'            => new sfWidgetFormInputText(),
      'category_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductCategory'), 'add_empty' => false)),
      'icon_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'album_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'color_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'add_empty' => true)),
      'publisher_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'description'       => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'vendor'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'amount'            => new sfValidatorInteger(array('required' => false)),
      'price'             => new sfValidatorNumber(array('required' => false)),
      'last_entrance'     => new sfValidatorDateTime(),
      'is_home_plant'     => new sfValidatorBoolean(),
      'temperature_range' => new sfValidatorRegex(array('max_length' => 20, 'pattern' => '/^[0-9]+-[0-9]+$/', 'required' => false)),
      'blossoming_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Blossoming'), 'required' => false)),
      'blossoming_start'  => new sfValidatorDate(array('required' => false)),
      'blossoming_end'    => new sfValidatorDate(array('required' => false)),
      'sun'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SunSense'), 'required' => false)),
      'sprinkling_period' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'size'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'weight'            => new sfValidatorNumber(array('required' => false)),
      'category_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductCategory'))),
      'icon_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'required' => false)),
      'album_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'color_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'required' => false)),
      'publisher_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

}
