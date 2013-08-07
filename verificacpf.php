<?php
/*Página para CRUD de comentários*/
require_once "conexao.php";

 // extrai os dados do post
 extract($_POST);
 
 conectar();
 
 // monta a instrucao SQL
 $strSql = "SELECT id FROM profissionais WHERE cpf = '$cpf'";
 
 // executa a query
 $query = mysql_query($strSql) or die("<script language=JavaScript>alert(\"Falha na execução da consulta!\");</script>");
 
 $total_registros = mysql_num_rows($query);
  
 if ($total_registros != 0){
	echo "<script>alert('Já existe profissional cadastrado com esse cpf.')</script>";
	echo "<script>document.cadastro.cpf.focus();</script>";	
	echo "<script>document.cadastro.cpf.select();</script>";		
 }
 
  
?>