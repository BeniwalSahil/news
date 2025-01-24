<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
 ?>

<?php
$connect = new PDO("mysql:host=localhost;dbname=advertindiaco_news-site","advertindiaco_user-news-site", "user@321#@!");

if(isset($_POST['contact_submit'])){
$name = $_POST['name'];
$email= $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

    $statement = $connect->prepare('INSERT INTO contact(name, email, phone, message) values(:name, :email, :phone, :message)');
    $statement->bindParam(':name', $name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':message', $message);
    $statement->execute();
 

$to = "sb2866615@gmail.com";
$subject = "Enquiry From ". $name ." for  New Website";
$txt = "";
$txt = "<div style='margin:0 auto; width:700px; padding:10px 0 20px 0; background:#efefef;'>
    <h1 style='color:#4D4D4D; padding:0 0 0 32px; font:normal 20px Arial, Helvetica, sans-serif;'><b>Enquiry From ". $name ." for News Website</b></h1>
        <div style='padding:20px; margin:10px 35px; background:#FFF;'>
            <h2 style='color:#1D7BCF; font-size:26px; font:bold Arial, Helvetica, sans-serif;'>Dear Admin</h2>
            <p style='color:#4D4D4D; font:normal 16px Arial, Helvetica, sans-serif; line-height:1.8em;'>You have recieved enquiry</p>
              <p style='color:#4D4D4D; font:normal 16px Arial, Helvetica, sans-serif;'>
                <p>
                  <strong>Name:</strong> ".$name."<br />
                  <strong>Email :</strong> ".$email."<br />
                  <strong>Phone:</strong> ".$phone."<br />
                  <strong>Message:</strong> ".$message."<br />
               </p>
             </p>
         </div>
         <div style='float:left; width:220px; height:100px; margin:25px 10px 0 32px;'></div>
       </div>
</div>";
    

    ini_set("sendmail_path", "/usr/sbin/sendmail -t -i -f $form");
    ini_set("mail.add_x_header", TRUE);
    ini_set("SMTP", "mail.advertindia.co.in/vin_ecom/news-site/");
    ini_set("smtp_port", "465");
    ini_set("sendmail_from", "sahil@advertindia.com"); 

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html\r\n";
    $headers .= "charset=UTF-8\r\n";
    $headers .= "From: ".$email . "\r\n";
    $headers .= 'Cc:sahil@advertindia.com'. "\r\n";
    $headers .= 'Bcc:sb2866615@gmail.com'. "\r\n";

$anu = mail($to,$subject,$txt,$headers);
if($anu)
{
  echo '<script>window.location.href = "thankyou.php";</script>';;
}

else{
echo 'Mail Not Sent';
}
    
}

?>