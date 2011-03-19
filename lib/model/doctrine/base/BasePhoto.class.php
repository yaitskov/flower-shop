<?php

/**
 * BasePhoto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $numlinks
 * @property string $path
 * @property string $extention
 * @property integer $width
 * @property integer $height
 * @property Doctrine_Collection $AlbumElement
 * @property Doctrine_Collection $SiteUser
 * @property Doctrine_Collection $ProductCategory
 * @property Doctrine_Collection $Product
 * @property Doctrine_Collection $Flower
 * 
 * @method integer             getNumlinks()        Returns the current record's "numlinks" value
 * @method string              getPath()            Returns the current record's "path" value
 * @method string              getExtention()       Returns the current record's "extention" value
 * @method integer             getWidth()           Returns the current record's "width" value
 * @method integer             getHeight()          Returns the current record's "height" value
 * @method Doctrine_Collection getAlbumElement()    Returns the current record's "AlbumElement" collection
 * @method Doctrine_Collection getSiteUser()        Returns the current record's "SiteUser" collection
 * @method Doctrine_Collection getProductCategory() Returns the current record's "ProductCategory" collection
 * @method Doctrine_Collection getProduct()         Returns the current record's "Product" collection
 * @method Doctrine_Collection getFlower()          Returns the current record's "Flower" collection
 * @method Photo               setNumlinks()        Sets the current record's "numlinks" value
 * @method Photo               setPath()            Sets the current record's "path" value
 * @method Photo               setExtention()       Sets the current record's "extention" value
 * @method Photo               setWidth()           Sets the current record's "width" value
 * @method Photo               setHeight()          Sets the current record's "height" value
 * @method Photo               setAlbumElement()    Sets the current record's "AlbumElement" collection
 * @method Photo               setSiteUser()        Sets the current record's "SiteUser" collection
 * @method Photo               setProductCategory() Sets the current record's "ProductCategory" collection
 * @method Photo               setProduct()         Sets the current record's "Product" collection
 * @method Photo               setFlower()          Sets the current record's "Flower" collection
 * 
 * @package    donbuket
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePhoto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('photo');
        $this->hasColumn('numlinks', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'range' => 
             array(
              0 => 0,
              1 => 1000000,
             ),
             ));
        $this->hasColumn('path', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('extention', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 10,
             ));
        $this->hasColumn('width', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('height', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('AlbumElement', array(
             'local' => 'id',
             'foreign' => 'photo_id'));

        $this->hasMany('SiteUser', array(
             'local' => 'id',
             'foreign' => 'face_id'));

        $this->hasMany('ProductCategory', array(
             'local' => 'id',
             'foreign' => 'icon_id'));

        $this->hasMany('Product', array(
             'local' => 'id',
             'foreign' => 'icon_id'));

        $this->hasMany('Flower', array(
             'local' => 'id',
             'foreign' => 'icon_id'));
    }
}