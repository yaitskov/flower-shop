<?php

class HelloCommand extends CConsoleCommand {
  public function getHelp(){
    return <<<EOD
USAGE
      hello
DESCRIPTION
      This command prints "HELLO WORLD" message.
EOD;
      
  }
  //  public function getOptions(){
  //  }
  public function run($args){
    echo "HELLO WORLD\n";
    echo implode( ' ' , $args );
  }
}

?>