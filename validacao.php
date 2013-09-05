<?php

require_once "conexao.php";

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
	header("Location: index.php"); exit;
}
	
conectar();

$usuario = $_POST['usuario'];
$senha = sha1(md5($_POST['senha']));

// Validação do usuário/senha digitados
if($usuario != "031.779.426-41")
	$sql = "SELECT id, nome FROM profissionais WHERE (cpf = '$usuario') AND (senha = '$senha') AND (status = 1) LIMIT 1";
else
	$sql = "SELECT id, nome FROM administrador WHERE (cpf = '$usuario') AND (senha = '$senha')";

$query = mysql_query($sql);

if (mysql_num_rows($query) != 1) {
	// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
	echo "<script>alert('Usuário e/ou senha inválidos!'); location = 'index.php';</script>";exit;		
} else {
	// Salva os dados encontados na variável $resultado
	$resultado = mysql_fetch_assoc($query);
	
	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['ProfissionalID'] = $resultado['id'];
	$_SESSION['ProfissionalNome'] = $resultado['nome'];	
	
	// Redireciona o visitante
	if($usuario == "031.779.426-41"){
		header("Location: administracao.php"); exit;
	}
	else{ 
		header("Location: atualizacadastro.php"); exit;
	}
}

?>