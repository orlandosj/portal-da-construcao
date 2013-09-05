<?php
/*Página para CRUD de comentários*/
require_once "conexao.php";

 // extrai os dados do post
 extract($_POST);
 
 conectar();
 
 // monta a instrucao SQL
 $strSql = "SELECT senha FROM profissionais WHERE id = $id";
 
 // executa a query
 $query = mysql_query($strSql) or die("<script language=JavaScript>alert(\"Falha na execução da consulta!\");</script>");
 
 $linha = mysql_fetch_assoc($query);
 
 $senha = sha1(md5($senha));
 
 if ($linha['senha'] != $senha){
	echo "<script>alert('Senha incorreta. Informe sua senha.')</script>";
	echo "<script>document.updatesenha.senhaantiga.focus();</script>";	
	echo "<script>document.updatesenha.senhaantiga.select();</script>";		
 }
 else{
	echo '<script>document.getElementById("senhanova").disabled = false;</script>';
	echo "<script>document.updatesenha.senhanova.focus();</script>";
}	
  
?>