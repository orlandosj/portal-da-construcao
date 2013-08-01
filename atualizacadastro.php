<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>Cadastro</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
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
		senha1 = document.cadastro.senha.value
		senha2 = document.cadastro.confirmasenha.value
	 
		if (senha1 != senha2){
			alert("Os campos senha e confirmação de senha devem ser iguais")
			document.cadastro.confirmasenha.select();
			document.cadastro.confirmasenha.focus();			
		}
	}
	</script>
	
	<script>
	function validarTamanhoSenha(){
		senha = document.cadastro.senha.value
		if (senha.length < "6"){
			alert("A senha deve conter pelo menos 6 caracteres")
			document.cadastro.senha.focus();						
		}
	}
	</script>
	
	<script charset="utf-8" src="scripts/slider.js" type="text/javascript"></script>

<?php
/*Página para CRUD de comentários*/
require_once "conexao.php";
	
	
	
	function updateProfissional($id, $email, $telefone, $telefone2, $estado, $cidade, $servicos, $info){
		conectar();
		
		if($telefone2 == "")
			$telefone2 = NULL;
	
		$consulta = "UPDATE profissionais  SET email = '$email', telefone = '$telefone', telefone_alternativo = '$telefone2', 
												estado = '$estado', cidade = '$cidade', servicos = '$servicos', 
												informacoes = '$info' WHERE id = '$id')";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
		
		echo "<script>alert('Dados alterados com sucesso!')</script>";
		
	
	}

	if(isset($_POST["atualiar"])){
		$nome = $_POST["author"];
		$cpf = $_POST["cpf"];
		$email = $_POST["email"];
		$telefone = $_POST["telefone"];
		$telefone2 = $_POST["telefone2"];
		$senha = $_POST["senha"];
		$profissao = $_POST["profissao"];
		$estado = $_POST["estado"];
		$cidade = $_POST["cidade"];
		$servicos = $_POST["servicos"];
		$info = $_POST["info"];
		$data =  date('Y-m-d H:i:s');
		updateProfissional($id, $email, $telefone, $telefone2, $estado, $cidade, $servicos, $info);		
	}	
?>	
	
<body class="home blog" data-twttr-rendered="true">

<div class="main_container">
	<div id="centercolumn">
	
	<!-- BEGIN HEADER -->
		<div id="top">
			<div id="logo">
				<div id="pad_logo">
					<h2>PORTAL DA CONSTRUÇÃO</h2>
				</div>
			</div><!-- end of logo -->
			<div id="topmenu">
				<div id="nav">
				  <ul id="menu" class="lavaLamp">
					<li class="current_page_item"><a href="index.php">Início</a></li>
					<li class="page_item page-item-2357"><a href="portal.html">O Portal</a></li>
					<li class="page_item page-item-2355"><a href="cadastro.html">Cadastre-se</a></li>
					<li class="page_item page-item-2355"><a href="contato.html">Contato</a></li>
					<li class="page_item page-item-7"><a href="#dialog" name="modal">Login</a></li>	

					<div id="boxes">
 
						<!-- #personalize sua janela modal aqui -->					 
						<div id="dialog" class="window">
							<!-- Botão para fechar a janela tem class="close" -->
							<a href="#" class="close">Fechar [X]</a><br />
							
							<div id="contactFormArea">
								<form action="# method="post" id="cForm">
									<fieldset>
										<div class="fields-form clearfix">
											<div class="form-input">
												<label for="usuario">Usuário:</label>
												<input class="inputcadastro" type="text" size="25" name="usuario" id="usuario" value="" tabindex="1" required/>
												<span class="hint">Informe seu nome de usuário (nº do cpf)</span><br /><br />
												
												<label for="senha">Senha:</label>
												<input class="inputcadastro" type="password" name="senha" id="senha" value="" tabindex="2" required/>
												<span class="hint">Informe sua senha</span><br /><br />						
											</div>
											
											<label>
												<input class="button"  type="submit" name="submit" id="button" value="Login" tabindex="" />
												<a rel="nofollow" id="cancel-comment-reply-link" href="/2010/05/desarrollo-de-widgets/#respond" style="display:none;">Click here to cancel reply.</a>  
											</label>
											<a href="#/">Esqueci minha senha</a></h3>
																					
										</div>										
									</fieldset>
								</form>
							</div>
						</div>
					 
						<!-- Não remova o div#mask, pois ele é necessário para preencher toda a janela -->
						<div id="mask"></div>
					</div>
				  <li class="back" style="left: 0px; width: 74px;"><div class="left"></div></li></ul>
				</div>
			</div><!-- end of topmenu -->
		</div>
	<!-- END OF HEADER -->
	
	


<!-- SLIDES CONTAINER -->
 <div id="slides_container"> 
	<div id="teste" width="300px" style="float: left; padding-left: 2em; padding:30px 0px 0px 0px;">
		<!--<img src="images/img/projeto_casa.jpg"></a>-->
		
		<div id="headertext"> 
			<p style="font-family:arial;color:white;font-size:30px;">Aqui você encontra todos os</p>
			<p style="font-family:arial;color:white;font-size:30px;">profissionais que precisa para</p>
			<p style="font-family:arial;color:white;font-size:30px;">construir ou reformar sua casa.</p>
			<p style="font-family:arial;color:white;font-size:30px;">  </p>
			<p style="font-family:arial;color:white;font-size:30px;"><br>Clique e confira!!!</br></p>
		</div>		
	
	</div>
	
	<div id="slider">  
		
		<img src="images/img/projeto_casa.jpg"></a>
		<img src="images/img/esboco_interno.jpg"></a>			
		<img src="images/img/casa_pronta.jpg"></a>
		<img src="images/img/casa_pronta4.jpg"></a>
		<img src="images/img/telhado.jpg"></a>
		<img src="images/img/pintura_interna.jpg"></a>
		<img src="images/img/parte_interna.jpg"></a>			
	
	</div><!-- end of slider -->
	
  </div> 
  
<!-- END OF SLIDES CONTAINER -->
		
	<!-- BEGIN CONTENT -->
	<div class="clearfix" id="content">
	<div id="padding_content">
		<div id="maincontent">
			<div id="main">
				<div id="maintext">

					
					
					<div id="portal">
						Abaixo você pode alterar os dados cadastrados, alterar sua senha, inserir fotos ou 
						substituir as fotos cadastradas e dar dicas para os clientes sobre sua área de atuação.
					</div>
					
					<p></p>
					
					<h2>Cadastro</h2>				
					
					<p></p>
					
					<div id="respond">
						<div id="contactFormArea">
							<form action="" method="post" id="update" name="update" >
								<fieldset>
									
									<label for="author">Nome:</label>
									<input class="inputcadastro" type="text" size="25" name="author" id="author" value="" tabindex="1" required/>
									<span class="hint">Informe seu nome completo</span><br /><br />
									
									<label for="cpf">CPF:</label>
									<input class="inputcadastro" type="text" name="cpf" id="cpf" value="" tabindex="2" required/>
									<span class="hint">Informe seu CPF</span><br /><br />
									
									<label for="email">Email:</label>
									<input class="inputcadastro" type="text" size="25" name="email" id="email" value="" tabindex="3" required/>
									<span class="hint">Informe um email válido para que possamos entrar em contato. Este email não será compartilhado com ninguém.</span><br /><br />
									
									<label for="telefone">Telefone:</label>
									<input class="inputcadastro" type="text" size="25" name="telefone" id="telefone" value="" tabindex="4" required/>
									<span class="hint">Informe um telefone para contato</span><br /><br />
									
									<label for="telefone2">Telefone Alternativo:</label>
									<input class="inputcadastro input-help" type="text" size="25" name="telefone2" id="telefone2" value="" tabindex="5" />
									<span class="hint">Informe outro número de telefone para contato (não obrigatório)</span><br /><br />
									
									<label for="senha">Senha:</label>
									<input class="inputcadastro input-help" type="password" size="25" name="senha" id="senha" value="" tabindex="6" onBlur="validarTamanhoSenha()"/>
									<span class="hint">Escolha sua senha para acesso ao portal (deve ter pelo menos 6 caracteres)</span><br /><br />
									
									<label for="confirmasenha">Confirmação de Senha:</label>
									<input class="inputcadastro input-help" type="password" size="25" name="confirmasenha" id="confirmasenha" value="" tabindex="7" onBlur="validarSenha()"/>
									<span class="hint">Repita a senha escolhida para acesso ao portal</span><br /><br />
									
									<label for="profissao">Profissão:</label>
									<select required aria-required="true" class="dropdownlist" name="profissao" id="profissao" tabindex="8"> 
											<option selected value="">Selecione a profissão</option>
											<option value="arquiteto">Arquiteto</option>
											<option value="carpinteiro">Carpinteiro</option>
											<option value="eletricista">Eletricista</option>
											<option value="encanador">Encanador</option>
											<option value="engenheiro">Engenheiro</option>
											<option value="paisagista">Paisagista</option>
											<option value="pedreiro">Pedreiro</option>
											<option value="pintor">Pintor</option>										
											<option value="serralheiro">Serralheiro</option>											
									</select>
									<span class="hint">Selecione a sua profissão</span><br /><br />
									
									<label for="estado">Estado:</label>
									<select required aria-required="true" class="dropdownlist" name="estado" id="estado" tabindex="9"> 																																			
										
									</select>
									<span class="hint">Selecione o estado no qual trabalha</span><br /><br />
									
									<label for="cidade">Cidade:</label>
									<select required aria-required="true" class="dropdownlist" name="cidade" id="cidade" tabindex="10"> 
										<option value="0">---Selecione primeiro o estado---</option>	
									</select>
									<span class="hint">Selecione a cidade na qual trabalha</span><br /><br/>

									<label for="servico">Serviços prestados:</label>
									<textarea class="inputtextarea" cols="60" rows="5" name="servicos" id="servicos" tabindex="11" required></textarea>
									<span class="hint">Digite aqui os principais serviços que realiza, separados por vírgula</span><br /><br />
									
									<label for="info">Informações adicionais:</label>
									<textarea class="inputtextarea" cols="60" rows="5" name="info" id="info" tabindex="12" ></textarea>
									<span class="hint">Digite aqui outras informações relevantes a seus clientes (preenchimento não obrigatório)</span><br /><br />
									<label>
										<input class="button"  type="submit" name="atualizar" id="button" value="Atualizar" tabindex="13" />										
									</label><br></br>
													
									
																			
								</fieldset>
							</form>
						</div>
					</div>
					
					<br></br>
					
					<h2>Alterar senha (colocar em uma div no lugar dos anuncios)</h2>
					
					<br></br>
					
					<div id="senha">
						<div id="formsenha">
							<form action="" method="post" id="updatesenha" name="updatesenha" >
								<fieldset>
									
									<label for="senha">Senha atual:</label>
									<input class="inputcadastro input-help" type="password" size="25" name="senhaantiga" id="senhaantiga" value="" tabindex="1" onBlur="validarSenhaAntiga()"/>
									<span class="hint">Informe a sua senha atual</span><br /><br />
									
									<label for="senha">Nova senha:</label>
									<input class="inputcadastro input-help" type="password" size="25" name="senhanova" id="senhanova" value="" tabindex="2" onBlur="validarTamanhoSenha()"/>
									<span class="hint">Informe a sua nova senha</span><br /><br />
									
									<label for="confirmasenha">Confirmação de Senha:</label>
									<input class="inputcadastro input-help" type="password" size="25" name="confirmasenha" id="confirmasenha" value="" tabindex="3" onBlur="validarSenha()"/>
									<span class="hint">Repita a nova senha escolhida para acesso ao portal</span><br /><br />								
									
									<label>
										<input class="button"  type="submit" name="alterarsenha" id="button" value="Alterar senha" tabindex="4" />										
									</label><br></br>
													
									
																			
								</fieldset>
							</form>
						</div>
					</div>
				</div><!-- end of maintext -->
			</div><!-- end of main -->
			
		</div><!-- end of maincontent -->
	</div>
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
						<p>O conteúdo deste site é protegido por Portal da Construção, sendo proibido publicar nossas informações em outro meio sem autorização prévia.
</p>
						<p>Copyright &copy; 2013. Portal da Construção</p>
					</div><!-- end of footleft -->
					<div class="footleft">
						<h3>Advertise here
</h3>
						<p>O Portal da Construção não se responsabiliza pelas informações fornecidas pelos profissionais cadastrados.
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