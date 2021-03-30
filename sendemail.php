<?php
  function sendEmail($subject,$to_email,$from_email,$to_fullname,$from_fullname,$filename)
  {
    $filepath = "../emailtemplate/uploadtemplate/";
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "To: $to_fullname <$to_email>\r\n";
    $headers .= "From: $from_fullname <$from_email>\r\n";
    $message= file_get_contents($filepath.$filename);
    
    if (!mail($to_email, $subject, $message, $headers)) { 
      $errorMsg = error_get_last();
      return $errorMsg;
    }
    else 
    { 
      $successMsg = "Email Sent Successfull Successfull";
      return $successMsg;
    }
  }
  
?>