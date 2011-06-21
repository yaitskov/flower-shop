<?php

/**
 * delete files which haven't any references
 */
class TrashFiles {
  protected $text, $files;
  /**
   * @param array<DescriptionFiles> files to be tested
   * @param String $text is a place where search is executed of links of testing files
   */
  public function __construct($files, $text) {
    $this->text = $text;
    $this->files= $files;
  }
  public function run() {
    // find all files related with common site description and test each of them
    $descfiles = $this->files;
    // dictionary by primary key
    $usedPhotoes = array();
    foreach ($descfiles as $dfile) {
      if (strpos($this->text, $dfile->file->hashName) !== false) {
        if (isset($usedPhotoes[$dfile->photo_id])) {
          if (!$dfile->delete())
            throw new Exception('cannot delete duplicated reference to file '
                                . $dfile->file->hashName );
        } else {
            $usedPhotoes[$dfile->photo_id] = $dfile;          
        }
        continue;
      }
      // file tuble cannot be deleted here cause it may be used other objects
      if (!$dfile->delete())
        throw new Exception("file '" . $dfile->file->hashName
                            . "' cannot be deleted");
    }    
  }
}

?>