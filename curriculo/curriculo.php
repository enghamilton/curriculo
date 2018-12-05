<?php
/*
https://www.codexworld.com/send-email-with-attachment-php/
https://www.youtube.com/watch?v=zYocypr0Xig
*/

//recipient
//$to = 'hamilton.kamiya@hotmail.com';
$to = 'leila@conceptblindagens.com.br';


//sender
$from = 'hamiltonkamiya@gmail.com';
$fromName = 'Hamilton';

//email subject
$subject = 'Currículo Hamilton engenheiro mec automotivo oleoduto, vendas imobiliárias, aplicativos android iPhone e sites, consultas VBA Excel'; 

//attachment file path
$file = "curriculo/cv_hamilton_kamiya_engenheiro_mec_cad_3d_vba_SQL_full-stack_Outubro2018.pdf";

//email body content
$htmlContent = '<h1>Hamilton</h1>
    <p>curriculo no link do Google Drive : </p>
	<a href="https://drive.google.com/open?id=1JgXDqBzPtcNxDeJn0_IBGoHPhy99MCdH">https://drive.google.com/open?id=1JgXDqBzPtcNxDeJn0_IBGoHPhy99MCdH</a>
	<p>curriculo no link do OneDrive Word online : </p>
	<a href="https://1drv.ms/w/s!AmcKlYTatlApgmXFB_Tfl6at_8ln">https://1drv.ms/w/s!AmcKlYTatlApgmXFB_Tfl6at_8ln</a>
	<p>curriculo no LinkedIn : </p>
	<a href="https://www.linkedin.com/in/hamilton-kamiya-061a1923/">https://www.linkedin.com/in/hamilton-kamiya-061a1923/</a>
	<p>Obrigado !! Hamilton Kamiya</p>';

//header for sender info
$headers = "From: $fromName"." <".$from.">";

//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//headers for attachment 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

//multipart boundary 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

//preparing attachment
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($file)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//send email
$mail = @mail($to, $subject, $message, $headers, $returnpath); 

//email sending status
echo $mail?"<h1>Mail sent.</h1>":"<h1>Mail sending failed.</h1>";
?>