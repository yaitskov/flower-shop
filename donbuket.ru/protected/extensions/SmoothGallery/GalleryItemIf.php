<?php

interface GalleryItemIf {
  /**
   * @return string image caption
   */
  function getTitle();
  /**
   * @return string image description
   */
  function getDescription();
  /**
   * @return string url to original image
   */
  function getOriginal();
  /**
   * @return string url to thumnail image
   */
  function getThumbnail();
  }
}

?>