<?php
echo "<pre>";
$username = 'rtfm.rtfm.rtfm@gmail.com';  //user@gmail.com или user@yourdomain (HOSTED ACCOUNT)
$password = 'ye b ckj;ysq ;t password123'; // your pass
$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX'; //без INBOX тоже работает.
$mbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
//print_r($inbox);

echo "<p><h1>Mailboxes</h1>\n";
$folders = imap_listmailbox ($mbox, "{myimap}", "*");

   if ($folders == false) {
      echo "Call failed<br>\n";
   } else {
   /*while (list ($key, $val) = each ($folders)) { // не понимаю я как это работает
   echo $val."<br>\n";
   }*/
      foreach ($folders as $k => $v){
         $v = str_replace('&-', '&', $v); //если у ярлыка в конце стоит "&" то к нему добавится "-" и строка пойдёт на раскодировку и вместо "ярлык&" получится "ярлык+"
         if (preg_match("/&(?!-)|-(?= )|[^&]-$/", $v) === 1) {
            //echo "1 ";
            echo gm_utf7_decode($v)."<br>\n"; //кривая кодировка Gmail'a см тут http://xpoint.ru/forums/programming/PHP/thread/44035.xhtml
         } else {
            // echo "2 ";
            echo $v."<br>\n";
         }
      }
   }

echo "<hr>\n<p><h1>Headers in INBOX</h1>\n";

for ($i=0,$m=1; $i<5; $i++,$m++){
   $headers[] = imap_header($mbox, $m);
   echo $i.' '.$m.' ';
   echo mime_charset_to_utf8($headers[$i]->subject)."\n";
}

echo "\n\n\n print_r(\$headers)= "; print_r($headers);
imap_close($mbox);
// мои функции
   function mime_charset_to_utf8($string){
     $output = '';
      $SS = imap_mime_header_decode($string);
         for($i=0;$i<count($SS);$i++) {
            $income_charset = $SS[$i]->charset;
            $income_text = $SS[$i]->text;
            if ($income_charset == 'default') {
               $output .= $income_text;
            } else {
               $output .= iconv($income_charset,'UTF-8', $income_text);
            }
         }
      return $output;
   }

   function gm_utf7_decode($val){
     return mb_convert_encoding( $val    , "UTF-8", "UTF7-IMAP" ); 
   }
?>