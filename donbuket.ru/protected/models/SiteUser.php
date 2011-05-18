<?php

/**
 * This is the model class for table "site_user".
 *
 * The followings are the available columns in table 'site_user':
 * @property string $id
 * @property string $login
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic
 * @property string $personal_phone
 * @property string $employee_phone
 * @property integer $is_blogger
 * @property string $signature
 * @property integer $is_client
 * @property double $discount
 * @property string $password
 * @property integer $is_root
 * @property string $registered_at
 * @property integer $is_employee
 * @property string $last_login_at
 * @property string $face_id
 *
 * The followings are the available model relations:
 * @property Flower[] $flowers
 * @property ForumPost[] $forumPosts
 * @property ForumTheme[] $forumThemes
 * @property Orders[] $orders
 * @property Posy[] $posys
 * @property Product[] $products
 * @property ProductCategory[] $productCategories
 * @property Photo $face
 */
class SiteUser extends CActiveRecord {

    public function  __set($name, $value) {
        if ( $name === 'password')
            $value = hash ( 'sha1', $value );
        parent::__set($name, $value);
    }
    /**
     * Returns the static model of the specified AR class.
     * @return SiteUser the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'site_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, email, firstname, lastname, patronymic, password, registered_at, last_login_at', 'required'),
            array('is_blogger, is_client, is_root, is_employee', 'numerical', 'integerOnly' => true),
            array('discount', 'numerical'),
            array('login', 'length', 'max' => 30),
            array('email, firstname, lastname, patronymic', 'length', 'max' => 100),
            array('personal_phone, employee_phone', 'length', 'max' => 50),
            array('signature', 'length', 'max' => 255),
            array('password', 'length', 'max' => 64),
            array('face_id', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, login, email, firstname, lastname, patronymic, personal_phone, employee_phone, is_blogger, signature, is_client, discount, password, is_root, registered_at, is_employee, last_login_at, face_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'flowers' => array(self::HAS_MANY, 'Flower', 'publisher_id'),
            'forumPosts' => array(self::HAS_MANY, 'ForumPost', 'author_id'),
            'forumThemes' => array(self::HAS_MANY, 'ForumTheme', 'author_id'),
            'orders' => array(self::HAS_MANY, 'Orders', 'responsible_id'),
            'posys' => array(self::HAS_MANY, 'Posy', 'publisher_id'),
            'products' => array(self::HAS_MANY, 'Product', 'publisher_id'),
            'productCategories' => array(self::HAS_MANY, 'ProductCategory', 'publisher_id'),
            'face' => array(self::BELONGS_TO, 'Photo', 'face_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'patronymic' => 'Patronymic',
            'personal_phone' => 'Personal Phone',
            'employee_phone' => 'Employee Phone',
            'is_blogger' => 'Is Blogger',
            'signature' => 'Signature',
            'is_client' => 'Is Client',
            'discount' => 'Discount',
            'password' => 'Password',
            'is_root' => 'Is Root',
            'registered_at' => 'Registered At',
            'is_employee' => 'Is Employee',
            'last_login_at' => 'Last Login At',
            'face_id' => 'Face',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('patronymic', $this->patronymic, true);
        $criteria->compare('personal_phone', $this->personal_phone, true);
        $criteria->compare('employee_phone', $this->employee_phone, true);
        $criteria->compare('is_blogger', $this->is_blogger);
        $criteria->compare('signature', $this->signature, true);
        $criteria->compare('is_client', $this->is_client);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('is_root', $this->is_root);
        $criteria->compare('registered_at', $this->registered_at, true);
        $criteria->compare('is_employee', $this->is_employee);
        $criteria->compare('last_login_at', $this->last_login_at, true);
        $criteria->compare('face_id', $this->face_id, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
}