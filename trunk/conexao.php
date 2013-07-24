<?php
$db_banco ="portaldaconstrucao";
$db_user = "root";
$db_pass = "";
$host = "127.0.0.1";

function conectar(){

	$conexao = @mysql_connect("127.0.0.1","root","");
	if (!($conexao)){
		print("<script language=JavaScript>
			  alert(\"Não foi possível conectar ao Banco de Dados.\");
			  </script>");
		echo $conexao;
		exit;
	}

	$db = mysql_select_db("portaldaconstrucao") or
		die("<script language=JavaScript>alert(\"Tabela inexistente!\");</script>"); 
}	
?>