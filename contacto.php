<?php
    include_once("PHPMailer/src/PHPMailer.php");
    include_once("PHPMailer/src/SMTP.php");

$pg = "contacto";

if($_POST){ /* es postback */
    $nombre = $_POST["txtNombre"];
    $correo = $_POST["txtCorreo"];
    //$asunto = $_POST["txtAsunto"];
    $mensaje = $_POST["txtMensaje"];

    if($nombre != "" && $correo != ""){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.dominio.com"; // SMTP a utilizar
        $mail->Username = "info@dominio.com.ar"; // Correo completo a utilizar
        $mail->Password = "aqui va la clave de tu correo";
        $mail->Port = 25;
        $mail->From = "info@dominio.com.ar"; //Desde la cuenta donde enviamos
        $mail->FromName = "Jose Hidalgo";
        $mail->IsHTML(true);
        $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

         //Destinatarios
         $mail->addAddress($correo);
         $mail->addBCC("jhidalgomez@gmail.com"); //Copia oculta
         $mail->Subject = utf8_decode("Contacto página Web");
         $mail->Body = "Recibimos tu consulta, te responderemos a la brevedad.";
         /*if(!$mail->Send()){ //cuando este en el servidor descomentar
             $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
         }*/
         $mail->ClearAllRecipients(); //Borra los destinatarios
 
         //Envía ahora un correo a nosotros con los datos de la persona
         $mail->addAddress("info@dominio.com.ar");
         $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
         $mail->Body = "Te escribio $nombre cuyo correo es $correo, con el asunto $asunto y el siguiente mensaje:<br><br>$mensaje";
        
         //if($mail->Send()){ /* Si fue enviado correctamente redirecciona */
             header('Location: confirmacion-envio.php');
         //} else {
             $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
         //}    
     } else {
         $msg = "Complete todos los campos";
     }

}




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">  
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="css/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="css/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body id="contacto">
    <header>
        <div class="container">
             <?php include_once("menu.php"); ?>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-sm-5">
                    <h1>Contacto</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12 mt-4">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta nihil, dolore dolor veritatis, asperiores nemo fuga quos soluta facilis excepturi magnam cupiditate itaque assumenda nam quae delectus aut similique perferendis.</p>
                </div>
                <div class="col-sm-6 col-12 mt-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control shadow" placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <input type="email" id="txtCorreo" name="txtCorreo" class="form-control shadow" placeholder="Correo">
                        </div>
                        <div class="mb-3">
                            <textarea id="txtMensaje" name="txtMensaje" class="form-control shadow"></textarea>
                        </div>
                    
                        <div class="text-right">
                            <button type="submit" class="btn">ENVIAR</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>   
    </main>
    <footer>
        <div class="container">
            <div class="row mt-5">
                <div class="col-sm-3 col-12 text-sm-left text-center pb-sm-0 pb-3">
                    <a href="https://github.com/jhidalgomez" target="_blank" title="Github"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/nelson-daniel-tarche/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-sm-3 col-12 text-sm-left text-center pb-sm-0 pb-3">
                        Sponsor <a href="https://depcsuite.com" target="_blank" title="DEPCSUITE">DePC Suite</a>
                </div>
                <div class="col-sm-3 col-12 text-sm-left text-center pb-sm-0 pb-3">
                    <a href="mailto:info@depcsuite.com">info@depcsuite</a>
                </div>
                <div class="col-sm-3 col-12 text-sm-right text-right pb-sm-0 pb-3 pb-sm-0 pb-3">
                    <a href="https://api.whatsapp.com/send?phone=541168567414" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>  
    </footer> 
</body>
</html>
