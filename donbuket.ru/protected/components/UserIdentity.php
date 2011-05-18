<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
  private $_id = null;
  /**
   * Authenticates a user.
   * The example implementation makes sure if the username and password
   * are both 'demo'.
   * In practical applications, this should be changed to authenticate
   * against some persistent user identity storage (e.g. database).
   * @return boolean whether authentication succeeds.
   */
  public function authenticate()
  {
    $user = User::model()->findByLoginPassword ( $this->username, $this->password ) ;
    if ( is_null ( $user ) ){
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
      $this->errorMessage = 'Incorrect username or password.';
    }elseif ( !$user->registered ) {
      $this->errorCode = self::ERROR_PASSWORD_INVALID;      
      $this->errorMessage = 'You did\'t confirm your email address.';
    }elseif ( !$user->active ){
      $this->errorCode = 2 ;      // the user is locked
      $this->errorMessage = "The user is locked. Request to the administrator." ;
    }else
      $this->errorCode = self::ERROR_NONE;
    if ( $user ) $this->_id = $user->id ;
    return !$this->errorCode;
  }
  public function getId() {
    return $this->_id; 
  }
}