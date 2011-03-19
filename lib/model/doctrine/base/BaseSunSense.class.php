<?php

/**
 * BaseSunSense
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Product
 * 
 * @method string              getName()    Returns the current record's "name" value
 * @method Doctrine_Collection getProduct() Returns the current record's "Product" collection
 * @method SunSense            setName()    Sets the current record's "name" value
 * @method SunSense            setProduct() Sets the current record's "Product" collection
 * 
 * @package    donbuket
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSunSense extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sun_sense');
        $this->hasColumn('name', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Product', array(
             'local' => 'id',
             'foreign' => 'sun'));
    }
}