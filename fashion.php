<?php 

$from_email= 'MyrtYurt@gmail.com';
$recipient_email='kingkthegreatperiod@gmail.com';


$sender_name=$_POST["sender_name"];
$reply_to_email= $_POST["sender_email"];
$subject=$_POST["sender_subject"];
$message=$_POST["message"];

if ( isset( $_POST["button"] ) && isset($_FILES ["attachment"]) ) {

   

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




<!DOCTYPE html>
<html>

<head>
  <title> Html form</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>replit</title>
  <link href="fashion.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Oswald&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Oswald&family=Oxygen:wght@300&display=swap"
    rel="stylesheet">
</head>

<body>



  <div class="nav">


    <ul>
      <center>
        <li><a href="index.html">Back to Homepage</a></li>

        <li><a href="Game.html">Game Stuff</a></li>
      </center>
    </ul>


  </div>

  <script src="script.js"></script>
  <div class="images">
    <img class="rack"
      src="https://images.squarespace-cdn.com/content/v1/5b9c8fb3c258b42748351a07/1594493752583-38ZW9S80BR6DZYKQQFGU/Fast+fashion%2C+nina+gbor%2C+secondhand+clothing+to+africa?format=1000w"
      height=600 width=600>
    <center>
      <div class="f1">
        <h1 class="F">F</h1>
      </div>
    </center>

    <div class="f">
      <h1 class="A1">A</h1>
    </div>


    <div class="f">
      <h1 class="S">S</h1>
    </div>


    <div class="f">
      <h1 class="H">H</h1>
    </div>

    <div class="f">
      <h1 class="I">I</h1>
    </div>


    <div class="f">
      <h1 class="O">O</h1>
    </div>


    <div class="f">
      <h1 class="N">N</h1>
    </div>

    <img class="shoes" src="https://cdn.mos.cms.futurecdn.net/H3SSyTL6wvJqLWHPqV7DPm.jpg" height=600 width=600>
  </div>


  <!-- <center>
    <p>Upload a file for a custom Garment
      .</p>
  </center>




  <center>
    <form action="fashion.php" method="post" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload" name="submit">
    </form>
    <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  </center> -->


  <form enctype="multipart/form-data" method="POST" action = "fashion.php">
    <div class= "input-group" >
             <input class= "form-control" type="text" name="sender_name" placeholder="Your Name" required/>
    </div>
    <div class= "input-group" >
             <input class= "form-control" type="email" name="sender_email" placeholder="Your email" required/>
    </div>
    <div class= "input-group" >
             <input class= "form-control" type="text" name="sender_subject" placeholder="Subject" />
    </div>
    <div class= "input-group" >
             <textarea  rows = "4" cols="50" class= "form-control"  name="message" placeholder="Message"></textarea>
    </div>
    <div class= "input-group" >
             <input class= "form-control btn-secondary" type="file" name="attachment" placeholder="attach file" />
    </div>
    <div class= "input-group" >
             <input class= "btn-primary" type="submit" name="button" placeholder="Submit"  />
    </div>

</form>


</body>

</html>



