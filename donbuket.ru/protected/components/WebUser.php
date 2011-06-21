<?php


class WebUser extends CWebUser {
  private $_user_model = null;
  public function getUserModel(){
    if ( ! $this->_user_model && $this->id )
      $this->_user_model = User::model()->findByPk( $this->id );
    return $this->_user_model ;
  }
  /**
   * @return bool true if current user can change the account of user $u
   */
  public function canChangeAccount( $u ){
    return is_object( $u ) and ( $this->id === $u->id or $this->isRoot );
  }
  public function canDeleteAccount( $u ) {
    return is_object( $u ) and  $this->isRoot and $u->id !== $this->id;
  }
  public function canRemoveFile ( $fid ){
    $f = File::model() -> findByPk( $fid  );
    return is_object ( $f ) and ( $f->owner_id === $this->id or $this->isRoot );
  }
  public function canCreateAccount(){
    return $this->isRoot;
  }
  public function getIsRoot () {
    return $this->userModel && $this->userModel->is_root;
  }
  public function getCanArticle () {
    return $this->_user_model && $this->_user_model->can_write_articles ;    
  }
  public function getCanComment () {
    return $this->_user_model && $this->_user_model->can_write_comments ;    
  }
  public function login( $identity, $duration = 0 ){
    parent::login( $identity, $duration );
    $this->userModel->logined();    
  }
  public function canSendMessage ( User $u  ) {
    // may be to add black list.
    return $u !== null
      and ! $this->isGuest
      and $u->publicArticle 
      and $u->publicArticle->canComment ( $this, $u->publicArticle->id );
  }
  public function logout() {
    if ( $this->userModel )
      $this->userModel->logouted();
    parent::logout();    
  }
  public function getCurrentUrl(){
    $r =Yii::app()->request;
    return 'http://' . $r->serverName . $r->url;
  }
  public function getPreviousUrl(){
    return $this->getState( 'current_url', '' );
  }
  protected function renewCookie(){
    if ( $this->userModel )
      $this->userModel->acted();
    /* $this->returnUrl = $was_current_url = $this->getState ( 'current_url', $this->currentUrl ); */
    /* if ( $was_current_url != $this->currentUrl ) */
    /*   $this->setState( 'previous_url', $was_current_url );          */
    /* $this->setState( 'current_url', $this->currentUrl ); */
    parent::renewCookie();
    //if ( $this->userModel )     
  }
  public function setReturnUrl( $url ) {
    if ( preg_match ( '/upload/', $url ) ) {
      throw new Exception ( "zzzzzzzzzzzzzz" . $url ) ;
    }
    Return parent::setReturnUrl( $url ) ;
  }
}

?>