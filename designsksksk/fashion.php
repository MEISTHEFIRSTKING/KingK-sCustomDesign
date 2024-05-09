<?php 
if ( isset( $_POST["botton"] ) && isset($_FILES ["attachment"]) ) {

    $from_email= 'sender@abc.com';
    $recipient_email='kingkthegreatperiod@gmail.com';

    $sender_name=$_POST["sender_name"];
    $reply_to_email= $_POST["sender_email"];
    $subject=$_POST["sender_subject"];
    $message=$_POST["message"];

    if(strlen($sender_name)< 1){
        die("name is too short or doesn't exist");
    }

    if(strlen($reply_to_email)< 1){
        die("invalid email");
    }

    if(strlen($subject)< 1){
        die("invalid subject");
    }
    if(strlen($message)< 1){
        die("incorrect");
    }

    $temp_name= $_FILES ['attachment'] ['temp_name'];
    $name =  $_FILES ['attachment'] ['name'];
    $size =  $_FILES ['attachment'] ['size'];
    $type = $_FILES ['attachment'] ['type'];
    $error=  $_FILES ['attachment'] ['error'];




    if ($error>0)
{
    die('Upload error or No files uploaded');
}

    $handle = fopen($temp_name, "r");
    $content = fread($handle, $size);
    fclose($handle);
    $encoded_content= chunk_split (base64_encode($content)); 
    $boundary = md5 ("random"); //ENCRYPTION


    $headers = "MIME-Version:1.0\r\n";
    $headers .= "From:".$from_email."\r\n";
    $headers .= "Reply-to: ".$reply_to_email."\r\n";
    $headers .= "Content-Type: multipart/mixed;"; 
    $headers .= "boudary= $boundry\r\n";


    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: based 64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));
    $body = "--$boundary\r\n";
    $body .= "Content-Type:$type; name=".$name."\r\n";
    $body .= "Content-Disposition: attachment; filename=".$name."\r\n";
    $body .= "Content-Transfer-Encoding: base64 \r\n";
    $body .= "X-Attachment-Id: ".$rand(1000,99999). "\r\n\r\n";
    $body .= $encoded_content;

    $sentMailResult = mail($recipient_email, $subject, $body, $headers);

    if($sentMailResult ){
        echo"<h3>File Sent Successfully.<h3>";
    }
    else{
        die("Sorry but the email could not be sent.
                  Please go back and try again");
    }

}
?>