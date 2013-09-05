<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>Cadastro</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
		
		<link media="screen" type="text/css" href="css/style.css" rel="stylesheet">

	
	<script id="twitter-wjs" src="http://platform.twitter.com/widgets.js"></script>
	<script src="scripts/jquery.js" type="text/javascript"></script>
	<script src="scripts/jquery.easing.min.js" type="text/javascript"></script>
	<script src="scripts/jquery.lavalamp.min.js" type="text/javascript"></script>
	<script src="scripts/js.js" type="text/javascript"></script>
	<script src="scripts/jquery.cycle.all.js" type="text/javascript"></script>
	
	<script src="scripts/jquery.min.js" type="text/javascript"></script>
	<script src="scripts/jquery.maskedinput.js" type="text/javascript"></script>
	
	<script src="scripts/combo.js"></script>	
	
	<link rel="stylesheet" href="scripts/coin-slider-styles.css" type="text/css" />
	
	<script type="text/javascript">
	$(document).ready(function() { 
		$('#slider').cycle({
			fx: 'fade',
			pause: 1,
		});
	});
	</script>
	
	<script type="text/javascript">  
		jQuery.noConflict(); 
		jQuery(function($){ 
		$("#telefone").mask("(99) 9999-9999");
		$("#telefone2").mask("(99) 9999-9999");		
		$("#cpf").mask("999.999.999-99");
		$("#usuario").mask("999.999.999-99");		
		}); 
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
		 
		//seleciona os elementos a com atributo name="modal"
		$('a[name=modal]').click(function(e) {
		//cancela o comportamento padrão do link
		e.preventDefault();
		 
		//armazena o atributo href do link
		var id = $(this).attr('href');
		 
		//armazena a largura e a altura da tela
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		 
		//Define largura e altura do div#mask iguais ás dimensões da tela
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		 
		//efeito de transição
		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);
		 
		//armazena a largura e a altura da janela
		var winH = $(window).height();
		var winW = $(window).width();
		//centraliza na tela a janela popup
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
		//efeito de transição
		$(id).fadeIn(2000);
		});
		 
		//se o botãoo fechar for clicado
		$('.window .close').click(function (e) {
		//cancela o comportamento padrão do link
		e.preventDefault();
		$('#mask, .window').hide();
		});
		 
		//se div#mask for clicado
		$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
		});
		});
	</script>
	
	<script>
		function validarSenha(){
			senha1 = document.updatesenha.senhanova.value
			senha2 = document.updatesenha.confirmasenha.value
		 
			if (senha1 != senha2){
				alert("Os campos senha e confirmação de senha devem ser iguais")
				document.updatesenha.confirmasenha.select();
				document.updatesenha.confirmasenha.focus();			
			}
		}
	</script>
	
	<script>	
		function validarTamanhoSenha(){
			senhanova = document.updatesenha.senhanova.value
			if (senhanova.length < "6"){
				alert("A senha deve conter pelo menos 6 caracteres")
				document.updatesenha.senhanova.focus();						
			}
		}
	</script>		
	<script>
		function validarSenhaAntiga(){
			senha = document.updatesenha.senhaantiga.value;
			id = $_SESSION['ProfissionalID'];
			jQuery.noConflict(); 
			jQuery(function($){
				$("#senhaantiga").load('verificasenha.php',{id: id, senha: senha});					
			});
		}
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){

		$('#tab-content .tab-content:first-child').css('display', 'block');
		$('#tab-nav li:first-child a').addClass('current');
		
		var alturaInicial = $('#tab-content .tab-content:first-child').innerHeight();
		$('#tab-content').height(alturaInicial);

		$('a', $('#tab-nav')).click(function() {
			var i = $('a', $('#tab-nav') ).index(this) + 1;
			$(this).parents('#tabs').children('#tab-content').children('.tab-content:visible').hide();
			$('#tab-' + i).show();
			$(this).parents('#tab-nav').find('a').removeClass('current');
			$(this).addClass('current');
			
			var altura = $('#tab-' + i ).innerHeight();
			$('#tab-content').stop().animate({
				height: altura
			}, 'slow' );

			return false;
		});
		
		})
	</script>
	
	<script charset="utf-8" src="scripts/slider.js" type="text/javascript"></script>

<?php

	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) 
		session_start();

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['ProfissionalID'])) {
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: index.php"); exit;
	}
	
	require_once "conexao.php";

	conectar();
	
	$limite = 20; // Define o limite de registros a serem exibidos com o valor cinco
	
	// Captura os dados da variável 'pag' vindo da url, onde contém o número da página atual
	$pagina = ( isset( $_GET['pag'] ) ? $_GET['pag'] : null);
		
	/* Se a variável $pagina não contém nenhum valor,
	então por padrão ela será posta com o valor 1 (primeira página) */
	if(!$pagina)
	{
		$pagina = 1;
	}
	
	/* Operação matemática que resulta no registro inicial
	a ser selecionado no banco de dados baseado na página atual */
	$inicio = ($pagina * $limite) - $limite;

/**********************************************************************************************************/
	/*** Parte dos profissionais ***/
	
	/* monta a instrucao SQL*/
	$strSql = "SELECT * FROM profissionais ORDER BY id LIMIT $inicio,$limite";
 
	/* executa a query*/
	$query = mysql_query($strSql) or die("<script language=JavaScript>alert(\"Não foi possível carregar os dados!\");</script>");
	 
	//$result = mysql_fetch_assoc($query);
	
	$consulta_total = mysql_query("SELECT id FROM profissionais"); // Seleciona o campo id da nossa tabela profissionais
	// Captura o número do total de registros no nosso banco a partir da nossa consulta
	$total_registros = mysql_num_rows($consulta_total);
	
	/* Define o total de páginas a serem mostradas baseada
	na divisão do total de registros pelo limite de registros a serem mostrados */
	$total_paginas = Ceil($total_registros / $limite);
	
	function updateStatus($id_prof, $status, $validade_cadastro){
		conectar();
		
		if($validade_cadastro == "")
			$validade_cadastro = null;
		$consulta = "UPDATE profissionais  SET status = $status, 
			validade_cadastro = '$validade_cadastro' WHERE id = '$id_prof'";
		
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
		
		echo "<script>alert('Dados alterados com sucesso!')</script>";
	}		

	if(isset($_POST["update_status"])){
		$id_prof = $_POST["id"];
		$status = $_POST["status"];
		$validade_cadastro = date($_POST["validade_cadastro"]);
		updateStatus($id_prof, $status, $validade_cadastro);		
	}
	
	function enviaBoleto($id_prof, $nome, $cpf, $validade_cadastro){
		
		
		//echo "<script>alert($total)</script>";
	}
	
	if(isset($_POST["notifica"])){
		$id_prof = $_POST["id"];
		$nome = $_POST["nome"];
		$cpf = $_POST["cpf"];
		$validade_cadastro = date($_POST["validade_cadastro"]);
		enviaBoleto($id_prof, $nome, $cpf, $validade_cadastro);		
	}
	
/**********************************************************************************************************/	
	/*** Parte dos comentários ***/
	$strSqlComent = "SELECT * FROM comentarios ORDER BY id LIMIT $inicio,$limite";
 
	/* executa a query*/
	$queryComent = mysql_query($strSqlComent) or die("<script language=JavaScript>alert(\"Não foi possível carregar os dados!\");</script>");
	 
	//$result = mysql_fetch_assoc($query);
	
	$consulta_total_coment = mysql_query("SELECT id FROM comentarios"); // Seleciona o campo id da nossa tabela profissionais
	// Captura o número do total de registros no nosso banco a partir da nossa consulta
	$total_registros_coment = mysql_num_rows($consulta_total_coment);
	
	/* Define o total de páginas a serem mostradas baseada
	na divisão do total de registros pelo limite de registros a serem mostrados */
	$total_paginas_coment = Ceil($total_registros_coment / $limite);
	
	function updateStatusComent($id_coment, $status_coment){
		conectar();
		
		$consulta = "UPDATE comentarios  SET status = $status_coment WHERE id = '$id_coment'";
		
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
		
		echo "<script>alert('Dados alterados com sucesso!')</script>";
	}		

	if(isset($_POST["update_status_coment"])){
		$id_coment = $_POST["id_coment"];
		$status_coment = $_POST["status_coment"];
		
		updateStatusComent($id_coment, $status_coment);		
	}

/**********************************************************************************************************/	
	/*** Parte das mensagens ***/
	$strSqlMens = "SELECT * FROM mensagens WHERE status = 'responder' ORDER BY id LIMIT $inicio,$limite";
 
	/* executa a query*/
	$queryMens = mysql_query($strSqlMens) or die("<script language=JavaScript>alert(\"Não foi possível carregar os dados!\");</script>");
	 
	//$result = mysql_fetch_assoc($query);
	
	$consulta_total_mens = mysql_query("SELECT id FROM mensagens"); // Seleciona o campo id da nossa tabela profissionais
	// Captura o número do total de registros no nosso banco a partir da nossa consulta
	$total_registros_mens = mysql_num_rows($consulta_total_mens);
	
	/* Define o total de páginas a serem mostradas baseada
	na divisão do total de registros pelo limite de registros a serem mostrados */
	$total_paginas_mens = Ceil($total_registros_mens / $limite);
	
	function responderMensagem($id_mens){
		conectar();
		
		$consulta = "UPDATE mensagens  SET status = 'respondido' WHERE id = $id_mens";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
		
		echo "<script>alert('Status da mensagem alterado!')</script>";
	}
	
	if(isset($_POST["respondermensagem"])){
		$id_mens = $_POST["id_mens"];
		responderMensagem($id_mens);		
	}
	
/**********************************************************************************************************/
	/*** Parte dos anunciantes ***/
	
	/* monta a instrucao SQL*/
	$strSql_anunc = "SELECT * FROM anunciantes ORDER BY id LIMIT $inicio,$limite";
 
	/* executa a query*/
	$query_anunc = mysql_query($strSql_anunc) or die("<script language=JavaScript>alert(\"Não foi possível carregar os dados!\");</script>");
	 
	//$result = mysql_fetch_assoc($query);
	
	$consulta_total_anunc = mysql_query("SELECT id FROM anunciantes"); // Seleciona o campo id da nossa tabela profissionais
	// Captura o número do total de registros no nosso banco a partir da nossa consulta
	$total_registros_anunc = mysql_num_rows($consulta_total_anunc);
	
	/* Define o total de páginas a serem mostradas baseada
	na divisão do total de registros pelo limite de registros a serem mostrados */
	$total_paginas_anunc = Ceil($total_registros_anunc / $limite);
	
	function updateStatusAnunc($id_anunc, $status_anunc, $validade_cadastro_anunc){
		conectar();
		
		if($validade_cadastro_anunc == "")
			$validade_cadastro_anunc = null;
		$consulta_anunc = "UPDATE anunciantes  SET status = $status_anunc, 
			validade_cadastro = '$validade_cadastro_anunc' WHERE id = '$id_anunc'";
		
		$resultado_anunc = mysql_query($consulta_anunc) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
		
		echo "<script>alert('Status anunciante alterado com sucesso!')</script>";
	}		

	if(isset($_POST["update_status_anunc"])){
		$id_anunc = $_POST["id_anunc"];
		$status_anunc = $_POST["status_anunc"];
		$validade_cadastro_anunc = date($_POST["validade_cadastro_anunc"]);
		updateStatusAnunc($id_anunc, $status_anunc, $validade_cadastro_anunc);		
	}
	
	function enviaBoletoAnunc($id_anunc, $nome_anunc, $cnpj_anunc, $validade_cadastro_anunc){
		
		
		//echo "<script>alert($total)</script>";
	}
	
	if(isset($_POST["notifica_anunc"])){
		$id_anunc = $_POST["id_anunc"];
		$nome_anunc = $_POST["nome_anunc"];
		$cnpj_anunc = $_POST["cnpj_anunc"];
		$validade_cadastro_anunc = date($_POST["validade_cadastro_anunc"]);
		enviaBoletoAnunc($id_anunc, $nome_anunc, $cnpj_anunc, $validade_cadastro_anunc);		
	}


	/*** Fim parte dos anunciantes ***/
/**********************************************************************************************************/
		

	function updateSenha($senha){
		conectar();
		
		$senha = sha1(md5($senha));
		
		$consulta = "UPDATE administrador  SET senha = '$senha' WHERE id = 1";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
		
		echo "<script>alert('Senha alterada com sucesso!')</script>";
	}
	
	if(isset($_POST["alterarsenha"])){
		$senha = $_POST["senhanova"];
		updateSenha($senha);		
	}

	
	
?>	
	
<body class="home blog" data-twttr-rendered="true">

<div class="main_container">
	<div id="centercolumn">
	
	<!-- BEGIN HEADER -->
		<div id="top">
			<div id="logo">
				<div id="pad_logo">
					<h2>FERAS DA CONSTRUÇÃO</h2>
				</div>
			</div><!-- end of logo -->
			<div id="topmenu">
				<div id="nav">
				  <ul id="menu" class="lavaLamp">
					<li class="current_page_item"><a href="index.php">Início</a></li>
					<li class="page_item page-item-2357"><a href="portal.php">O Portal</a></li>
					<li class="page_item page-item-2355"><a href="formcadastro.php">Cadastre-se</a></li>
					<li class="page_item page-item-2355"><a href="formcontato.php">Contato</a></li>
					<li class="page_item page-item-7"><a href="logout.php">Logoff</a></li>	

					
				  <!--<li class="back" style="left: 0px; width: 74px;"><div class="left"></div></li></ul>-->
				</div>
			</div><!-- end of topmenu -->
		</div>
	<!-- END OF HEADER -->
	
	


<!-- SLIDES CONTAINER -->
  <div id="slides_container"> 
  
  </div> 
  
<!-- END OF SLIDES CONTAINER -->
		
	<!-- BEGIN CONTENT -->
	<div class="clearfix" id="content">
		<div id="padding_content">
			<div id="portal">
				Olá, Administrador <?php echo $_SESSION['ProfissionalNome']; ?>! <br></br>				
			</div>
			<br></br>
			
			<div id="maincontent">
				<div id="main">
					<div id="maintext">
					
						<div id="tabs" class="site-tabs">
							<ul id="tab-nav" class="nav-tabs">
								<li class="tab-item"><a href="#tab-1" class="current">Cadastro Admin</a></li>
								<li class="tab-item"><a href="#tab-2">Comentários</a></li>
								<li class="tab-item"><a href="#tab-3">Profissionais</a></li>
								<li class="tab-item"><a href="#tab-4">Mensagens</a></li>
								<li class="tab-item"><a href="#tab-5">Anunciantes</a></li>
							</ul>
							<div id="tab-content" class="content-tabs">
								<div id="tab-1" class="tab-content" style="display: block;">
									<div id="respond" class="oculto">
										<div id="contactFormArea" class="oculto">
											<form class="oculto" action="" method="post" id="update" name="update" >
												<fieldset>
													
													<label for="author">Nome:</label>
													<input class="inputcadastro" type="text" size="25" name="author" id="author" value="<?php echo ""; ?>" tabindex="1" readonly="readonly" required/>
													<br></br>
													
													<label for="cpf">CPF:</label>
													<input class="inputcadastro" type="text" name="cpf" id="cpf" value="<?php echo ""; ?>" tabindex="2" readonly="readonly" required/>
													<br /><br />
													
													<label for="email">Email:</label>
													<input class="inputcadastro" type="text" size="25" name="email" id="email" value="<?php echo ""; ?>" tabindex="3" required/>
													<span class="hint">Informe um email válido para que possamos entrar em contato. Este email não será compartilhado com ninguém.</span><br /><br />
													
													<label for="telefone">Telefone:</label>
													<input class="inputcadastro" type="text" size="25" name="telefone" id="telefone" value="<?php echo ""; ?>" tabindex="4" required/>
													<span class="hint">Informe um telefone para contato</span><br /><br />
													
													<label for="telefone2">Telefone Alternativo:</label>
													<input class="inputcadastro input-help" type="text" size="25" name="telefone2" id="telefone2" value="<?php echo ""; ?>" tabindex="5" />
													<span class="hint">Informe outro número de telefone para contato (não obrigatório)</span><br /><br />
													
													<label for="profissao">Profissão:</label>
													<select required aria-required="true" class="dropdownlist" name="profissao" id="profissao" tabindex="6"> 
															<option selected value="<?php echo $result['profissao']; ?>"><?php echo ""; ?></option>
															<!--<option value="arquiteto">Arquiteto</option>
															<option value="carpinteiro">Carpinteiro</option>
															<option value="eletricista">Eletricista</option>
															<option value="encanador">Encanador</option>
															<option value="engenheiro">Engenheiro</option>
															<option value="paisagista">Paisagista</option>
															<option value="pedreiro">Pedreiro</option>
															<option value="pintor">Pintor</option>										
															<option value="serralheiro">Serralheiro</option>-->											
													</select>
													<!--<span class="hint">Selecione a sua profissão</span>--><br /><br />
													
													<label for="estado">Estado:</label>
													<select required aria-required="true" class="dropdownlist" name="estado" id="estado" tabindex="7" required> 																																			
															
													</select>
													<span class="hint">Selecione o estado no qual trabalha</span><br /><br />
													
													<label for="cidade">Cidade:</label>
													<select required aria-required="true" class="dropdownlist" name="cidade" id="cidade" tabindex="8"> 
														<option value="">---Selecione primeiro o estado---</option>	
													</select>
													<span class="hint">Selecione a cidade na qual trabalha</span><br /><br/>

													<label for="servico">Serviços prestados:</label>
													<textarea class="inputtextarea" cols="60" rows="5" name="servicos" id="servicos" tabindex="9" required><?php echo "";?></textarea>
													<span class="hint">Digite aqui os principais serviços que realiza, separados por vírgula</span><br /><br />
													
													<label for="info">Informações adicionais:</label>
													<textarea class="inputtextarea" cols="60" rows="5" name="info" id="info" tabindex="10" ><?php echo "";?></textarea>
													<span class="hint">Digite aqui outras informações relevantes a seus clientes (preenchimento não obrigatório)</span><br /><br />
													<label>
														<input class="button"  type="submit" name="atualizar" id="atualizar" value="Atualizar" tabindex="11" />										
													</label><br></br>
																	
													
																							
												</fieldset>
											</form>
										</div>
									</div>
									
									<br></br>
								
								
									<div id="senha" class="updateinfo">
										<h2>Alterar senha</h2>				
										<p></p>
										
										<div id="senha" class="boxsenha">
										<form action="" method="post" id="updatesenha" name="updatesenha" >
												<fieldset>
													
													<!--<label for="senhaantiga">Senha atual:</label>
													<input class="inputcadastro input-help" type="password" size="25" name="senhaantiga" id="senhaantiga" value="" tabindex="12" onBlur="validarSenhaAntiga()" required/>
													<span class="hint">Informe a sua senha atual</span><br /><br />-->
													
													<label for="senhanova">Nova senha:</label>
													<input class="inputcadastro input-help" type="password" size="25" name="senhanova" id="senhanova" value="" tabindex="13" onBlur="validarTamanhoSenha()" required/>
													<span class="hint">Informe a sua nova senha</span><br /><br />
													
													<!--<label for="confirmasenha">Confirmação de Senha:</label>
													<input class="inputcadastro input-help" type="password" size="25" name="confirmasenha" id="confirmasenha" value="" tabindex="14" onBlur="validarSenha()" required/>
													<span class="hint">Repita a nova senha escolhida para acesso ao portal</span><br /><br />	-->							
													
													<label>
														<input class="button"  type="submit" name="alterarsenha" id="alterarsenha" value="Alterar senha" tabindex="15" />										
													</label><br></br>							
																							
												</fieldset>
											</form>						
										</div>
										
										<br></br>						
									</div><!-- end of updatesenha -->
								</div><!--end of tab cadastro admin -->
								
								<div id="tab-2" class="tab-content">
									<h2>Comentários</h2>
									<p></p>
									<div style="float:left; width: 70px;">ID</div>
									<div style="float:left; width: 220px;">Email</div>
									<div style="float:left; width: 460px;">Comentário</div>
									<div style="float:left; width: 40px;">Status</div><br></br>
									<?php
										//echo "ID      NOME    EMAIL    COMENTÁRIO\n";
										
										if($total_registros_coment > 0):
											while($linhaComent = mysql_fetch_assoc($queryComent)):
												$id_coment = $linhaComent['id'];
												$nome_usuario = $linhaComent['nome_usuario'];
												$email = $linhaComent['email_usuario'];
												$comentario = $linhaComent['comentario'];
												$status_coment = $linhaComent['status'];						
									?>
										<div>
											<div class="box-02">
											  <div class="box-03" >
												<form action="" method="post" id="alterastatus" name="alterastatus" >
													<fieldset>
														<input type="text" size="4" name="id_coment" id="id_coment" value="<?php echo $id_coment; ?>" tabindex="2" readonly="readonly" required/>
														<!--<input type="text" size="25" name="nome" id="nome" value="<?php echo $nome_usuario; ?>" tabindex="2" readonly="readonly" required/>-->
														<input type="text" size="30" name="email" id="email" value="<?php echo $email; ?>" tabindex="3" readonly="readonly" required/>
														<input type="textarea" size="70" name="comentario" id="comentario" value="<?php echo $comentario; ?>" tabindex="3" readonly="readonly" required/>
														<input type="text" size="1" name="status_coment" id="status_coment" value="<?php echo $status_coment; ?>" tabindex="4" required/>
														<input type="submit" name="update_status_coment" id="update_status_coment" value="Alterar status" tabindex="5" />
													</fieldset>
												</form>			
											  </div>
											</div>
										</div><p></p>
									<?php 
										endwhile;
										endif;
										$ant = $pagina - 1;						
										$prox = $pagina + 1;												
										$ultima_pag = $total_paginas_coment;
										$penultima = $ultima_pag - 1;  
										$adjacentes = 2;
									?>
									
									<!-- PAGINAÇÃO -->
									<nav class="site-pagination">
										<?php
											if($total_paginas_coment > 0){
												if($total_paginas_coment <= 5){
													if($total_paginas_coment > 1 && $pagina > 1){
														echo '<a href="administracao.php?pag=1#tab-2" > Primeira </a>';
													}
													
													if($pagina > 1){
														echo '<a href="administracao.php?pag='.$ant.'#tab-2" class="prev" > <img src="images/pag-ant.png"> </a>';
													}
													for($i=1; $i <= $total_paginas_coment; $i++){
														if($i == $pagina)
															echo '<a href="administracao.php?pag='.$i.'#tab-2" class= "active" > '.$i.'</a>';
														else
															echo '<a href="administracao.php?pag='.$i.'#tab-2"> '.$i.'</a>';								
													} 
													if($pagina < $ultima_pag && $ultima_pag > 2){
														echo '<a href="administracao.php?pag='.$prox.'#tab-2" class="next" > <img src="images/pag-prox.png"> </a>';
													}
													
													if($total_paginas_coment > 1 && $pagina < $ultima_pag){
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-2" > Última </a>';
													}
												}
												else{
													if ($pagina < 1 + (2 * $adjacentes)){
														if($pagina > 1){
															echo '<a href="administracao.php?pag=1#tab-2" > Primeira </a>';
															echo '<a href="administracao.php?pag='.$ant.'#tab-2" class="prev" > <img src="images/pag-ant.png"> </a>';
														}
														
														for($i=1; $i < 2 + (2 * $adjacentes); $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-2" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-2"> '.$i.'</a>';									
														}
														echo '...';
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-2" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-2" > Última </a>';
														}
													}								
													else if($pagina > (2 * $adjacentes) && $total_paginas_coment < 8){
														echo '<a href="administracao.php?pag=1#tab-2" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-2" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $total_paginas_coment; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-2" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-2"> '.$i.'</a>';									
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-2" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-2" > Última </a>';
														}
													}
													else if($pagina > (2 * $adjacentes) && $pagina < $ultima_pag - 3){
														echo '<a href="administracao.php?pag=1#tab-2" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-2" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $pagina + $adjacentes; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-2" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-2"> '.$i.'</a>';									
														}
														echo '...';
														echo '<a href="administracao.php?pag='.$prox.'#tab-2" class="next" > <img src="images/pag-prox.png"> </a>';
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-2" > Última </a>';
													}
													else{
														echo '<a href="administracao.php?pag=1#tab-2" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-2" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for ($i = $pagina - $adjacentes; $i <= $ultima_pag; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-2" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-2"> '.$i.'</a>';
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-2" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-2" > Última </a>';
														}
													}							
												}
											}
											else{
												?>
												<div id="portal">
													Nenhum comentário cadastrado. 
												</div>
											<?php }					
											
										?>						
									</nav> <br></br>
									<!-- END OF PAGINAÇÃO -->
								</div> <!--end of tab comentarios -->
								
								<div id="tab-3" class="tab-content">
									<h2>Profissionais</h2>
									
												
									<p></p>
									<div style="float:left; width: 70px;">Id</div>
									<div style="float:left; width: 190px;">Nome</div>
									<div style="float:left; width: 125px;">CPF</div>
									<div style="float:left; width: 60px;">Status</div>
									<div style="float:left; width: 122px;">Validade</div>
									<div style="float:left; width: 40px;">Plano</div><br></br>
									<?php
										if($total_registros > 0):
											while($linha = mysql_fetch_assoc($query)):
												$id_prof = $linha['id'];
												$nome = $linha['nome'];
												$cpf = $linha['cpf'];
												$status = $linha['status'];
												$validade_cadastro = $linha['validade_cadastro'];
												$plano = $linha['plano'];
												
												//verifica dias até o vencimento do plano
												$dataatual =  date('Y-m-d H:i:s');
		
												$hoje = new DateTime($dataatual);
												
												$cadastro = new DateTime(date($validade_cadastro));
												
												$dias = $cadastro->diff($hoje)->d;
												$meses = $cadastro->diff($hoje)->m;
												$anos = $cadastro->diff($hoje)->y;
												
												$total = (int)(($anos * 365) + ($meses * 30) + $dias);												
									?>
										<div>
											<div class="box-02">
											  <div class="box-03" >
												<form action="" method="post" id="alterastatus" name="alterastatus" >
													<fieldset>
														<input type="text" size="4" name="id" id="id" value="<?php echo $id_prof; ?>" tabindex="1" readonly="readonly" required/>
														<input type="text" size="25" name="nome" id="nome" value="<?php echo $nome; ?>" tabindex="2" readonly="readonly" required/>
														<input type="text" size="14" name="cpf" id="cpf" value="<?php echo $cpf; ?>" tabindex="3" readonly="readonly" required/>
														<input type="text" size="2" name="status" id="status" value="<?php echo $status; ?>" tabindex="4" required/>
														<input type="text" size="14" name="validade_cadastro" id="validade_cadastro" value="<?php echo $validade_cadastro; ?>" tabindex="5" >
														<input type="text" size="10" name="plano" id="plano" value="<?php echo $plano; ?>" tabindex="6" readonly="readonly">
														
														<input type="submit" name="update_status" id="update_status" value="Alterar status" tabindex="7" />
														<?php if($total <= 15):?>
															<input type="submit" name="notifica" id="notifica" value="Avisa vencimento" tabindex="8" />
														<?php endif;?>
													</fieldset>
												</form>			
											  </div>
											</div>
										</div><p></p>
									<?php 
										endwhile;
										endif;
										$ant = $pagina - 1;						
										$prox = $pagina + 1;												
										$ultima_pag = $total_paginas;
										$penultima = $ultima_pag - 1;  
										$adjacentes = 2;
									?>
									
									<!-- PAGINAÇÃO -->
									<nav class="site-pagination">
										<?php
											if($total_paginas > 0){
												if($total_paginas <= 5){
													if($total_paginas > 1 && $pagina > 1){
														echo '<a href="administracao.php?pag=1#tab-3" > Primeira </a>';
													}
													
													if($pagina > 1){
														echo '<a href="administracao.php?pag='.$ant.'#tab-3" class="prev" > <img src="images/pag-ant.png"> </a>';
													}
													for($i=1; $i <= $total_paginas; $i++){
														if($i == $pagina)
															echo '<a href="administracao.php?pag='.$i.'#tab-3" class= "active" > '.$i.'</a>';
														else
															echo '<a href="administracao.php?pag='.$i.'#tab-3"> '.$i.'</a>';															
													} 
													if($pagina < $ultima_pag && $ultima_pag > 2){
														echo '<a href="administracao.php?pag='.$prox.'#tab-3" class="next" > <img src="images/pag-prox.png"> </a>';
													}
													
													if($total_paginas > 1 && $pagina < $ultima_pag){
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-3" > Última </a>';
													}
												}
												else{
													if ($pagina < 1 + (2 * $adjacentes)){
														if($pagina > 1){
															echo '<a href="administracao.php?pag=1#tab-3" > Primeira </a>';
															echo '<a href="administracao.php?pag='.$ant.'#tab-3" class="prev" > <img src="images/pag-ant.png"> </a>';
														}
														
														for($i=1; $i < 2 + (2 * $adjacentes); $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-3" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-3"> '.$i.'</a>';									
														}
														echo '...';
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-3" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-3" > Última </a>';
														}
													}								
													else if($pagina > (2 * $adjacentes) && $total_paginas < 8){
														echo '<a href="administracao.php?pag=1#tab-3" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-3" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $total_paginas; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-3" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-3"> '.$i.'</a>';									
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-3" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-3" > Última </a>';
														}
													}
													else if($pagina > (2 * $adjacentes) && $pagina < $ultima_pag - 3){
														echo '<a href="administracao.php?pag=1#tab-3" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-3" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $pagina + $adjacentes; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-3" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-3"> '.$i.'</a>';									
														}
														echo '...';
														echo '<a href="administracao.php?pag='.$prox.'#tab-3" class="next" > <img src="images/pag-prox.png"> </a>';
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-3" > Última </a>';
													}
													else{
														echo '<a href="administracao.php?pag=1#tab-3" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-3" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for ($i = $pagina - $adjacentes; $i <= $ultima_pag; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-3" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-3"> '.$i.'</a>';
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-3" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-3" > Última </a>';
														}
													}							
												}
											}
											else{
												?>
												<div id="portal">
													Nenhum profissional cadastrado. 
												</div>
											<?php }					
											
										?>						
									</nav> <br></br>
									<!-- END OF PAGINAÇÃO -->								
								</div> <!--end of tab profissionais -->
								
								<div id="tab-4" class="tab-content">
									<h2>Mensagens</h2>
									
									<p></p>
									<div style="float:left; width: 140px;">Id</div>
									<div style="float:left; width: 260px;">Nome</div>
									<div style="float:left; width: 225px;">Email</div>
									<div style="float:left; width: 178px;">Telefone</div>
									<div style="float:left; width: 122px;">Assunto</div>
									<?php
										if($total_registros_mens > 0):
											while($linhaMens = mysql_fetch_assoc($queryMens)):
												$id_mens = $linhaMens['id'];
												$nome_contato = $linhaMens['nome_contato'];
												$email = $linhaMens['email_contato'];
												$telefone = $linhaMens['telefone_contato'];
												$assunto = $linhaMens['assunto'];
												$mensagem = $linhaMens['mensagem'];												
																								
									?>
										<div>
											<div class="box-02">
											  <div class="box-03" >
												<form action="" method="post" id="respondermensagem" name="respondermensagem" >
													<fieldset>
														<input type="text" size="4" name="id_mens" id="id_mens" value="<?php echo $id_mens; ?>" tabindex="1" readonly="readonly" required/>
														<input type="text" size="25" name="nome" id="nome" value="<?php echo $nome_contato; ?>" tabindex="2" readonly="readonly" required/>
														<input type="text" size="20" name="email" id="email" value="<?php echo $email; ?>" tabindex="3" readonly="readonly" required/>
														<input type="text" size="12" name="telefone" id="telefone" value="<?php echo $telefone; ?>" tabindex="4" required/>
														<input type="text" size="14" name="assunto" id="assunto" value="<?php echo $assunto; ?>" tabindex="5" >
														<input type="textarea" size="148" name="mensagem" id="mensagem" value="<?php echo $mensagem; ?>" tabindex="6" readonly="readonly">
														
														<input type="submit" name="respondermensagem" id="respondermensagem" value="Responder" tabindex="7" />
														
													</fieldset>
												</form>	
												<p></p>
												**********************************************************************************************************************************************************
												**********************************************************************************************************************************************************
												<p></p>
											  </div>
											</div>
										</div><p></p>
									<?php 
										endwhile;
										endif;
										$ant = $pagina - 1;						
										$prox = $pagina + 1;												
										$ultima_pag = $total_paginas_mens;
										$penultima = $ultima_pag - 1;  
										$adjacentes = 2;
									?>
									
									<!-- PAGINAÇÃO -->
									<nav class="site-pagination">
										<?php
											if($total_paginas_mens > 0){
												if($total_paginas_mens <= 5){
													if($total_paginas_mens > 1 && $pagina > 1){
														echo '<a href="administracao.php?pag=1#tab-4" > Primeira </a>';
													}
													
													if($pagina > 1){
														echo '<a href="administracao.php?pag='.$ant.'#tab-4" class="prev" > <img src="images/pag-ant.png"> </a>';																												
													}
													for($i=1; $i <= $total_paginas_mens; $i++){
														if($i == $pagina)
															echo '<a href="administracao.php?pag='.$i.'#tab-4" class= "active" > '.$i.'</a>';															
														else
															echo '<a href="administracao.php?pag='.$i.'#tab-4"> '.$i.'</a>';																																						
													} 
													if($pagina < $ultima_pag && $ultima_pag > 2){
														echo '<a href="administracao.php?pag='.$prox.'#tab-4" class="next" > <img src="images/pag-prox.png"> </a>';
													}
													
													if($total_paginas_mens > 1 && $pagina < $ultima_pag){
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-4" > Última </a>';
													}
												}
												else{
													if ($pagina < 1 + (2 * $adjacentes)){
														if($pagina > 1){
															echo '<a href="administracao.php?pag=1#tab-4" > Primeira </a>';
															echo '<a href="administracao.php?pag='.$ant.'#tab-4" class="prev" > <img src="images/pag-ant.png"> </a>';
														}
														
														for($i=1; $i < 2 + (2 * $adjacentes); $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-4" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-4"> '.$i.'</a>';									
														}
														echo '...';
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-4" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-4" > Última </a>';
														}
													}								
													else if($pagina > (2 * $adjacentes) && $total_paginas_mens < 8){
														echo '<a href="administracao.php?pag=1#tab-4" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-4" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $total_paginas_mens; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-4" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-4"> '.$i.'</a>';									
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-4" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-4" > Última </a>';
														}
													}
													else if($pagina > (2 * $adjacentes) && $pagina < $ultima_pag - 3){
														echo '<a href="administracao.php?pag=1#tab-4" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-4" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $pagina + $adjacentes; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-4" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-4"> '.$i.'</a>';									
														}
														echo '...';
														echo '<a href="administracao.php?pag='.$prox.'#tab-4" class="next" > <img src="images/pag-prox.png"> </a>';
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-4" > Última </a>';
													}
													else{
														echo '<a href="administracao.php?pag=1#tab-4" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-4" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for ($i = $pagina - $adjacentes; $i <= $ultima_pag; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-4" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-4"> '.$i.'</a>';
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-4" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-4" > Última </a>';
														}
													}							
												}
											}
											else{
												?>
												<div id="portal">
													Nenhuma mensagem cadastrada. 
												</div>
											<?php }					
											
										?>						
									</nav> <br></br>
									<!-- END OF PAGINAÇÃO -->								
								</div><!--end of tab mensagens -->
								
								<div id="tab-5" class="tab-content">
									<h2>Anunciantes</h2>								
												
									<p></p>
									<div style="float:left; width: 60px;">Id</div>
									<div style="float:left; width: 140px;">Nome</div>
									<div style="float:left; width: 135px;">CNPJ</div>
									<div style="float:left; width: 125px;">Email</div>
									<div style="float:left; width: 100px;">Telefone</div>
									<div style="float:left; width: 70px;">Plano</div>
									<div style="float:left; width: 60px;">Status</div>
									<div style="float:left; width: 122px;">Validade</div><br></br>
									<?php
										if($total_registros_anunc > 0):
											while($linha_anunc = mysql_fetch_assoc($query_anunc)):
												$id_anunc = $linha_anunc['id'];
												$nome_anunc = $linha_anunc['nome'];
												$cnpj_anunc = $linha_anunc['cnpj'];
												$email_anunc = $linha_anunc['email'];
												$telefone_anunc = $linha_anunc['telefone'];
												$plano_anunc = $linha_anunc['plano'];
												$status_anunc = $linha_anunc['status'];
												$validade_cadastro_anunc = $linha_anunc['validade_cadastro'];
												
												//verifica dias até o vencimento do plano
												$dataatual =  date('Y-m-d H:i:s');
		
												$hoje = new DateTime($dataatual);
												
												$cadastro = new DateTime(date($validade_cadastro_anunc));
												
												$dias = $cadastro->diff($hoje)->d;
												$meses = $cadastro->diff($hoje)->m;
												$anos = $cadastro->diff($hoje)->y;
												
												$total = (int)(($anos * 365) + ($meses * 30) + $dias);												
									?>
										<div>
											<div class="box-02">
											  <div class="box-03" >
												<form action="" method="post" id="alterastatusanunc" name="alterastatusanunc" >
													<fieldset>
														<input type="text" size="2" name="id_anunc" id="id_anunc" value="<?php echo $id_anunc; ?>" tabindex="1" readonly="readonly" required/>
														<input type="text" size="15" name="nome_anunc" id="nome_anunc" value="<?php echo $nome_anunc; ?>" tabindex="2" readonly="readonly" required/>
														<input type="text" size="10" name="cnpj_anunc" id="cnpj_anunc" value="<?php echo $cnpj_anunc; ?>" tabindex="3" readonly="readonly" required/>
														<input type="text" size="20" name="email_anunc" id="email_anunc" value="<?php echo $email_anunc; ?>" tabindex="4" readonly="readonly" required/>
														<input type="text" size="10" name="telefone_anunc" id="telefone_anunc" value="<?php echo $telefone_anunc; ?>" tabindex="5" readonly="readonly" required/>
														<input type="text" size="6" name="plano_anunc" id="plano_anunc" value="<?php echo $plano_anunc; ?>" tabindex="6" readonly="readonly" required/>
														<input type="text" size="1" name="status_anunc" id="status_anunc" value="<?php echo $status_anunc; ?>" tabindex="7" required/>
														<input type="text" size="8" name="validade_cadastro_anunc" id="validade_cadastro_anunc" value="<?php echo $validade_cadastro_anunc; ?>" tabindex="8" >
														
														<input type="submit" name="update_status_anunc" id="update_status_anunc" value="Alterar status" tabindex="9" />
														<?php if($total <= 15 && $status_anunc == 1):?>
															<input type="submit" name="notifica_anunc" id="notifica_anunc" value="Avisa vencimento" tabindex="10" />
														<?php endif;?>
													</fieldset>
												</form>			
											  </div>
											</div>
										</div><p></p>
									<?php 
										endwhile;
										endif;
										$ant = $pagina - 1;						
										$prox = $pagina + 1;												
										$ultima_pag = $total_paginas;
										$penultima = $ultima_pag - 1;  
										$adjacentes = 2;
									?>
									
									<!-- PAGINAÇÃO -->
									<nav class="site-pagination">
										<?php
											if($total_paginas_anunc > 0){
												if($total_paginas_anunc <= 5){
													if($total_paginas_anunc > 1 && $pagina > 1){
														echo '<a href="administracao.php?pag=1#tab-5" > Primeira </a>';
													}
													
													if($pagina > 1){
														echo '<a href="administracao.php?pag='.$ant.'#tab-5" class="prev" > <img src="images/pag-ant.png"> </a>';
													}
													for($i=1; $i <= $total_paginas_anunc; $i++){
														if($i == $pagina)
															echo '<a href="administracao.php?pag='.$i.'#tab-5" class= "active" > '.$i.'</a>';
														else
															echo '<a href="administracao.php?pag='.$i.'#tab-5"> '.$i.'</a>';								
													} 
													if($pagina < $ultima_pag && $ultima_pag > 2){
														echo '<a href="administracao.php?pag='.$prox.'#tab-5" class="next" > <img src="images/pag-prox.png"> </a>';
													}
													
													if($total_paginas_anunc > 1 && $pagina < $ultima_pag){
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-5" > Última </a>';
													}
												}
												else{
													if ($pagina < 1 + (2 * $adjacentes)){
														if($pagina > 1){
															echo '<a href="administracao.php?pag=1#tab-5" > Primeira </a>';
															echo '<a href="administracao.php?pag='.$ant.'#tab-5" class="prev" > <img src="images/pag-ant.png"> </a>';
														}
														
														for($i=1; $i < 2 + (2 * $adjacentes); $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-5" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-5"> '.$i.'</a>';									
														}
														echo '...';
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-5" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-5" > Última </a>';
														}
													}								
													else if($pagina > (2 * $adjacentes) && $total_paginas_anunc < 8){
														echo '<a href="administracao.php?pag=1#tab-5" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-5" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $total_paginas_anunc; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-5" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-5"> '.$i.'</a>';									
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-5" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-5" > Última </a>';
														}
													}
													else if($pagina > (2 * $adjacentes) && $pagina < $ultima_pag - 3){
														echo '<a href="administracao.php?pag=1#tab-5" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-5" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for($i = $pagina-$adjacentes; $i<= $pagina + $adjacentes; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-5" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-5"> '.$i.'</a>';									
														}
														echo '...';
														echo '<a href="administracao.php?pag='.$prox.'#tab-5" class="next" > <img src="images/pag-prox.png"> </a>';
														echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-5" > Última </a>';
													}
													else{
														echo '<a href="administracao.php?pag=1#tab-5" > Primeira </a>';
														echo '<a href="administracao.php?pag='.$ant.'#tab-5" class="prev" > <img src="images/pag-ant.png"> </a>';
														echo '...';
														for ($i = $pagina - $adjacentes; $i <= $ultima_pag; $i++){
															if($i == $pagina)
																echo '<a href="administracao.php?pag='.$i.'#tab-5" class= "active" > '.$i.'</a>';
															else
																echo '<a href="administracao.php?pag='.$i.'#tab-5"> '.$i.'</a>';
														}
														if($pagina < $ultima_pag){
															echo '<a href="administracao.php?pag='.$prox.'#tab-5" class="next" > <img src="images/pag-prox.png"> </a>';
															echo '<a href="administracao.php?pag='.$ultima_pag.'#tab-5" > Última </a>';
														}
													}							
												}
											}
											else{
												?>
												<div id="portal">
													Nenhum anunciante cadastrado. 
												</div>
											<?php }					
											
										?>						
									</nav> <br></br>
									<!-- END OF PAGINAÇÃO -->								
								</div> <!--end of tab anunciantes -->
							</div>
						</div>

						
						
						
					</div><!-- end of maintext -->
				</div><!-- end of main -->
				
				
				
			</div><!-- end of maincontent -->	
			
		</div> <!-- end of paddingcontent -->	
	
	</div>
<!-- END OF CONTENT -->
					

	</div>
</div>

	<!-- BEGIN FOOTER -->
		<div id="bottom_container">
			<div id="footer">
				<div class="clearfix" id="foot">
					<div class="footleft">
						<h3>Copyright &amp; Usage
</h3>
						<p>O conteúdo deste site é protegido por Feras da Construção, sendo proibido publicar nossas informações em outro meio sem autorização prévia.
</p>
						<p>Copyright &copy; 2013. Feras da Construção</p>
					</div><!-- end of footleft -->
					<div class="footleft">
						<h3>Advertise here
</h3>
						<p>O Portal Feras da Construção não se responsabiliza pelas informações fornecidas pelos profissionais cadastrados.
							<!--<a href="#/">contact us
							</a>.--></p>
					</div><!-- end of footleft -->
					<div style="margin:0px;padding-top:10px" class="footright">
						<div id="bookmark">
						<h3>Bookmark us
</h3>
						<ul>
							<li><a href="#"><img alt="RSS Feeds" src="images/icon1.gif"></a></li>
							<li><a href="#"><img alt="Twitter" src="images/icon2.gif"></a></li>
							<li><a href="#"><img alt="Facebook" src="images/icon3.gif"></a></li>
					
							<li><a href="http://del.icio.us/post?url=&amp;title=Border%20layout"><img alt="" src="images/icon7.gif"></a></li>
						</ul>
						</div>
					</div><!-- end of footright -->
				</div>
			</div><!-- end of footer -->
		</div><!-- end of bottom container -->
	<!-- END OF FOOTER -->
	
		</body></html>