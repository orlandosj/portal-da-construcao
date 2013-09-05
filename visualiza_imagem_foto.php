<?php
require_once "conexao.php";
	
	conectar();

	$id = $_GET['id'];

	// Executa a query, trazendo os dados do banco
	$sql = "SELECT tipo, imagem FROM anunciantes WHERE id = ".$id."";
	$query = mysql_query($sql);
	
	$tipo = mysql_result($query, 0, "tipo"); 
	$foto = mysql_result($query, 0, "imagem"); 
	header("Content-type: $tipo"); 
	echo $foto;
	/*if($query){
		$row = mysql_fetch_assoc($query);    
		$tipo   = $row["tipo"];                        
		$foto  = $row["imagem"]; 
		
		
		//EXIBE IMAGEM                                 
		header("Content-type: $tipo");
		echo $foto;
	}*/
?>