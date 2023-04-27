//Contact Form in PHP
<?php
  // Pour la page contact-me je me suis renseigné sur internet pour savoir commment créer
  //surtout l'utilisation de la fonction built-in 'mail'
  //il va falloir configuer XAMP 
  //voir ce mail
  //https://www.codingnepalweb.com/configure-xampp-to-send-mail-from-localhost/
  //recuperation des donnees
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $website = htmlspecialchars($_POST['website']);
  $message = htmlspecialchars($_POST['message']);
  if(!empty($email) && !empty($message))//si le message n'est pas vide
  {
    //filter_var pour verifier le format de l'email
    //https://www.w3schools.com/php/filter_validate_email.asp
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $receiver = "saad.sbat22@gmail.com"; //inserez l'email ou vous souhaitez de recevoire les messages puis configurez le xamp (voir le lien au tete de la page)
      $subject = "From: $name <$email>";
      $body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage:\n$message\n\nRegards,\n$name";
      $sender = "From: $email";
      if(mail($receiver, $subject, $body, $sender)){
         echo "Your message has been sent";
      }else{//gerer les erreures
         echo "echec!";
         echo "Desole ca ne va pas marcher car il fallait mettre le email et le password dans la configuration du serveur (voir(https://www.codingnepalweb.com/configure-xampp-to-send-mail-from-localhost/) puis configuer le gmail(https://www.letscodemore.com/blog/smtplib-smtpauthenticationerror-username-and-password-not))";

      }
    }else{
      echo "Enter a valid email address!";
    }
  }else{
    echo "Email and message field obligatoire!";
  }
?>