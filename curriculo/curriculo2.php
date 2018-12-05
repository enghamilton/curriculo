<?php
/*
curriculo.php
https://www.codexworld.com/send-email-with-attachment-php/
https://www.youtube.com/watch?v=zYocypr0Xig

curriculo2.php
https://www.tutdepot.com/php-e-mail-attachment-script/
*/

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
 $file = $path.$filename;
 $file_size = filesize($file);
 $handle = fopen($file, "r");
 $content = fread($handle, $file_size);
 fclose($handle);
 $content = chunk_split(base64_encode($content));
 $uid = md5(uniqid(time()));
 $header = "From: ".$from_name." <".$from_mail.">\r\n";
 $header .= "Reply-To: ".$replyto."\r\n";
 $header .= "MIME-Version: 1.0\r\n";
 $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
 $header .= "This is a multi-part message in MIME format.\r\n";
 $header .= "--".$uid."\r\n";
 $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
 $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
 $header .= $message."\r\n\r\n";
 $header .= "--".$uid."\r\n";
 $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
 $header .= "Content-Transfer-Encoding: base64\r\n";
 $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
 $header .= $content."\r\n\r\n";
 $header .= "--".$uid."--";
 if (mail($mailto, $subject, "", $header)) {
 echo "mail send ... OK"; // or use booleans here
 } else {
 echo "mail send ... ERROR!";
 }
 
}

/*
$my_file = "somefile.zip";
$my_path = "/your_path/to_the_attachment/";
$my_name = "Olaf Lederer";
$my_mail = "my@mail.com";
$my_replyto = "my_reply_to@mail.net";
$my_subject = "This is a mail with attachment.";
$my_message = "Hallo,rndo you like this script? I hope it will help.rnrngr. Olaf";
*/
$my_file = "cv_hamilton_kamiya_engenheiro_mec_cad_3d_vba_SQL_full-stack_Outubro2018.pdf";
$my_path = "curriculo/";
$my_name = "Hamilton";
$my_mail = "hamiltonkamiya@gmail.com";
$my_replyto = "hamilton.kamiya@hotmail.com";
$my_subject = "This is a mail with attachment.";
$my_message = "Atenciosamente Hamilton !!";
//($my_file, $my_path, "recipient@mail.org", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
mail_attachment($my_file, $my_path, "hamilton.kamiya@hotmail.com", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);

?>