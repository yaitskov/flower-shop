#!/usr/bin/env php
<?php
$adr ="{imap.gmail.com:993/imap/ssl}INBOX";
$mbox = imap_open($adr, "rtfm.rtfm.rtfm@gmail.com", "ye b ckj;ysq ;t password123") 
      or die("can't connect: " . imap_last_error());

echo "Getting list...\n";
$list = imap_search($mbox, 'ALL');
if ( $list ) {
  echo "Got list...\n";

  foreach( $list as $i => $email ){
    echo "reading: $i $email\n";
    $header = imap_fetch_overview( $mbox, $email, 0 );
    var_dump(  $header );
    exit;
    $header = mb_convert_encoding( $header   , "UTF-8", "UTF7-IMAP" );
    echo "reading body: $i\n";
    $body = mb_convert_encoding( imap_fetchbody( $mbox, $email, 2 ), "UTF-8", "UTF7-IMAP" );
    echo " ** $header **\n$body\n";    
  }
} else {
  echo "imap_search failed: " . imap_last_error() . "\n";
}

imap_close($mbox);
?>