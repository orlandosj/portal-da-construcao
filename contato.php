﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>Contato</title>
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
	
	<script charset="utf-8" src="scripts/slider.js" type="text/javascript"></script>
	
	<?php
	/*Página para CRUD de comentários*/
		require_once "conexao.php";
		
		$nome = $_POST["author"];
		$email = $_POST["email"];
		$telefone = $_POST["telefone"];
		$assunto = $_POST["assunto"];
		$mensagem = $_POST["mensagem"];
		$hora =  date('Y-m-d H:i:s');
		
		function cadMensagem($nome, $email, $telefone, $assunto, $mensagem, $hora){
			conectar();
		
			$consulta = "INSERT INTO mensagens (nome_contato, email_contato, telefone_contato, assunto, mensagem, data)
						 VALUES ('$nome', '$email', '$telefone', '$assunto', '$mensagem', '$hora')";
			$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução!\");</script>");	
			
			echo "<script>alert('Mensagem enviada com sucesso! Em breve entraremos em contato!')</script>";
			
		
		}	
		
		if(isset($_POST["comentar"])){
			cadMensagem($nome, $email, $telefone, $assunto, $mensagem, $hora);		
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
					<li class="current_page_item"><a href="index.html">Início</a></li>
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
												<input class="button"  type="submit" name="submit" id="button" value="Login" tabindex="3" />												
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
			<p style="font-family:arial;color:white;font-size:30px;">construir sua casa.</p>
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
		<div class="clearfix" id="topcontent">
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/arquiteto.jpg">
			<h3><a href="#/">Arquitetos e Engenheiros</a></h3>
			<p>Escolha o profissional para projetar sua casa</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/pedreiro.jpg">
			<h3><a href="#">Pedreiros</a></h3>
			<p>Escolha o profissional para executar sua obra</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/carpinteiro.jpg">
			<h3><a href="#">Carpinteiros</a></h3>
			<p>Escolha o profissional para fazer seu telhado</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/pintor.jpg">
			<h3><a href="#">Pintores</a></h3>
			<p>Escolha o profissional para pintar sua casa</p>
			</div>			
		</div><!-- end of topcontent -->
		<div id="maincontent">
			<div id="main">
				<div id="maintext">

					<!--<h1>O Bar da Vez</h1>
					<img style="float:right;margin:10px 0px 10px 0;width:120px" src="images/book.png">
					<p>  Mais do que uma ferramenta de busca, O Bar da Vez é o primeiro e único site que tráz tudo sobre os bares de Pedro Leopoldo e região. 
					Participe, vote nos seus bares favoritos, contribua deixando os seus comentários, indicando novos bares e espalhando a novidade. 
					O Bar da vez, sempre a melhor opção! </p>
					<p> 

					</p>-->
					<h2>Contato</h2>
					
					<p></p>
					
					<div id="portal">
						Deseja saber mais alguma informação sobre o Portal da Construção? Preencha o formulário abaixo e entraremos em contato.
					</div>
					
					<p></p>
					
					<div id="respond">
						<div id="contactFormArea">
							<form action="# method="post" id="cForm">
								<fieldset>
									<label for="author">Nome:</label>
									<input class="inputcadastro" type="text" size="25" name="author" id="author" value="" tabindex="1" required/>
									<span class="hint">Informe seu nome completo</span><br /><br />
									
									<label for="email">Email:</label>
									<input class="inputcadastro" type="text" size="25" name="email" id="email" value="" tabindex="2" required />
									<span class="hint">Informe um email válido para que possamos entrar em contato. Este email não será compartilhado com ninguém.</span><br /><br />
									
									<label for="telefone">Telefone:</label>
									<input class="inputcadastro" type="text" size="25" name="telefone" id="telefone" value="" tabindex="3" required/>
									<span class="hint">Informe um número de telefone para contato</span><br /><br />

									<label for="assunto">Assunto:</label>
									<select required aria-required="true" class="dropdownlist" name="assunto" id="assunto" tabindex="4"> 
											<option selected value="">Selecione o assunto</option>
											<option value="duvidas">Dúvidas</option>
											<option value="sugestoes">Sugestões</option>
											<option value="reclamacoes">Reclamações</option>											
									</select>
									<span class="hint">Selecione o assunto a tratar conosco</span><br /><br />
									
									<label for="comment">Mensagem:</label>
									<textarea cols="50" rows="6" name="comment" id="comment" class="inputtextarea" tabindex="5" required></textarea>
									<span class="hint">Digite a sua mensagem. Em breve entraremos em contato</span><br /><br />
									<label>
										<input class="button"  type="submit" name="submit" id="button" value="Enviar" tabindex="6" />										
									</label>
													
									<input type='hidden' name='comment_post_ID' value='2374' id='comment_post_ID' />
									<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
									<p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="8d90ccd5ef" /></p>	
								</fieldset>
							</form>
						</div>
					</div>
				</div><!-- end of maintext -->
			</div><!-- end of main -->
						<div id="side">
				<div class="sidebox">
					<div class="c_bottomsidebox">
						<!--<div class="contentbox">
						<iframe width="300" scrolling="no" height="500" frameborder="0" id="twitter-widget-0" class="twitter-timeline twitter-timeline-rendered" allowtransparency="true" style="border: medium none; max-width: 100%; min-width: 180px;" title="Twitter Timeline Widget"></iframe>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

						</div>-->
						<div id="anuncios" class="sidetext">
									<h2>Parceiros</h2>
									<ul class="advertisers clearfix">
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>
										<li><a href="#">Anuncie aqui</a></li>																				
									</ul>
								</div><!-- end of sidetext -->
					</div>
				</div><!-- end of sidebox -->
			</div><!-- end of side -->
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
						<p>O conteúdo deste site é protegido por O bar da Vez, é proibido publicar nossas informações em outro meio sem autorização prévia.
</p>
						<p>Copyright &copy; 2013. O bar da vez</p>
					</div><!-- end of footleft -->
					<div class="footleft">
						<h3>Advertise here
</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
 <a href="#/">contact us
</a>.</p>
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