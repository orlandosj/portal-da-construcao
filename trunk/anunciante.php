<?php
/*Página para CRUD de comentários*/
require_once "conexao.php";
require_once "enviaemail.php";
	
	function cadAnunciante($nome, $cnpj, $email, $telefone, $url, $imagem, $tipo, $plano, $data){
		conectar();
		
		if($url == "")
			$url = NULL;
	
		$consulta = "INSERT INTO anunciantes (nome, cnpj, email, telefone, url, imagem, tipo, plano, data)
					 VALUES ('$nome', '$cnpj', '$email', '$telefone', '$url', '$imagem', '$tipo', '$plano', '$data')";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");

		/*$mensagem = 'Obrigado por se cadastrar como anunciante no Portal da Construção'."\n";
		$mensagem.= 'Para efetuar o pagamento da anuidade, acesse ....';*/
				
		//envia email com nova senha 
		/*if (smtpmailer($email, 'orlandosj@gmail.com', $nome, 'Cadastro no Portal da Construção', $mensagem)) {

			echo "<script>alert('Cadastro realizado com sucesso! Foi enviado um email contendo os dados para pagamento para $email'); location = 'index.php';</script>"; exit;
		}*/
		echo "<script>location = 'confirmaanunciante.php';</script>"; exit;
		
		
	}

	if(isset($_POST["cadastraranunciante"])){
		$nome = $_POST["nome"];
		$nome = ucwords($nome);
		$cnpj = $_POST["cnpj"];
		$email = $_POST["email"];
		$email = strtolower($email);
		$telefone = $_POST["telefone"];
		$url = $_POST["url"];
		$imagem = $_FILES["imagem"]["tmp_name"]; 
		$tipo = $_FILES["imagem"]["type"];
		$nome_imagem  = $_FILES["imagem"]["name"];
		$plano = $_POST["planoanuncio"];
		
		 
		
		//lemos o  conteudo do arquivo usando afunção do PHP  file_get_contents
		//$binario = file_get_contents($imagem);
		// evitamos erro de sintaxe do MySQL
		//$binario = mysql_real_escape_string($binario); 
		
		//$imagem = addslashes(file_get_contents($imagem));
		//MOVE                                     
		//move_uploaded_file($imagem, "c:\\temp\\latest.img");
		//ABRE ARQUIVO                      
		//$pont = fopen("c:\\temp\\latest.img", "rb");   
         
		 //PERCORRE O ARQUIVO                                       
        //$dados = addslashes(fread($pont, filesize("c:\\temp\\latest.img"))); 
		/*$pont = fopen($imagem, "rb"); 
		$dados = fread($pont,filesize($imagem));
		fclose($pont);
		$dados = addslashes($dados);*/
		$data =  date('Y-m-d H:i:s');
		
		if(filesize($imagem) < 921600){
			$fp = fopen($imagem, "rb");
			$conteudo = fread($fp, filesize($imagem));
			$conteudo = addslashes($conteudo);
			fclose($fp);
			cadAnunciante($nome, $cnpj, $email, $telefone, $url, $conteudo, $tipo, $plano, $data);
		
		}
		else{
			echo "<script>alert('O tamanho da imagem deve ser menor que 900KB'); location = 'anunciante.html'</script>"; exit;
			
		}
	}	
?>