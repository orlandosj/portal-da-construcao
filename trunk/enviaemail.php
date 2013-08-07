<?php

// Dados de envio e da mensagem
	
/*$Nome		= $_POST["Nome"];	// Pega o valor do campo Nome
$Fone		= $_POST["Fone"];	// Pega o valor do campo Telefone
$Email		= $_POST["Email"];	// Pega o valor do campo Email
$Mensagem	= $_POST["Mensagem"];	// Pega os valores do campo Mensagem

// Variável que junta os valores acima e monta o corpo do email

//$Vai 		= "Nome: '$Nome\n\nE-mail: $Email\n\nTelefone: $Fone\n\nMensagem: $Mensagem\n";
$Vai 		= "teste";*/

require_once "./phpmailer/class.phpmailer.php";

define('GUSER', 'orlandosj@gmail.com');	// <-- Insira aqui o seu GMail
define('GPWD', 'Osj_985607');		// <-- Insira aqui a senha do seu GMail
define("PHPMAILERHOST",'localhost');

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->Mailer = "smtp";
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 465 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	$mail->WordWrap = 50; // quebra linha sempre que uma linha atingir 50 caracteres
	$mail->IsHTML(true); //ajusto envio do email no formato HTML
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		//echo "<script>alert('Não foi possível enviar email com a senha')</script>";
		return false;
	} else {
		//$error = 'Mensagem enviada!';
		//echo "<script>alert('Email com a nova senha enviado')</script>";
		return true;
	}
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

 /*if (smtpmailer('orlando@fcsl.edu.br', 'orlandosj@gmail.com', 'Orlando', 'Assunto do Email', $Vai)) {

	//Header("location:index.php"); // Redireciona para uma página de obrigado.
	echo "<script>alert('Email com a nova senha enviado')</script>";
}
if (!empty($error)) echo $error;*/

?>