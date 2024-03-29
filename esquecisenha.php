<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>Esqueci minha senha</title>
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
			$("#usuario").mask("999.999.999-99");
			$("#user").mask("999.999.999-99");
		}); 
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
		 
		//seleciona os elementos a com atributo name="modal"
		$('a[name=modal]').click(function(e) {
		//cancela o comportamento padr�o do link
		e.preventDefault();
		 
		//armazena o atributo href do link
		var id = $(this).attr('href');
		 
		//armazena a largura e a altura da tela
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		 
		//Define largura e altura do div#mask iguais �s dimens�es da tela
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		 
		//efeito de transi��o
		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);
		 
		//armazena a largura e a altura da janela
		var winH = $(window).height();
		var winW = $(window).width();
		//centraliza na tela a janela popup
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
		//efeito de transi��o
		$(id).fadeIn(2000);
		});
		 
		//se o bot�oo fechar for clicado
		$('.window .close').click(function (e) {
		//cancela o comportamento padr�o do link
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
	
	/*P�gina para CRUD de coment�rios*/
		require_once "conexao.php";
		
		require_once "enviaemail.php";
		
		function geraSenha($usuario, $email){
			conectar();
		
			$sql = "SELECT email, nome FROM profissionais WHERE cpf = '$usuario'";
			$query = mysql_query($sql) or die("<script language=JavaScript>alert(\"Falha na execu��o!\");</script>");
			$resultado = mysql_fetch_assoc($query);
			
			if($resultado['email'] == $email){
				$validos = '0123456789';

				$max = strlen($validos)-1;

				$senha = null;

				for($i=0; $i < 6; $i++) {
					$senha .= $validos{mt_rand(0, $max)};
				}
				
				//criptografa a senha
				$novasenha = sha1(md5($senha));
				
				//altera a senha no banco para a nova senha gerada
				$sql = "UPDATE profissionais  SET senha = '$novasenha' WHERE cpf = '$usuario'";
				$result = mysql_query($sql) or die("<script language=JavaScript>alert(\"Falha na execu��o!\");</script>");
				
				$nome = $resultado['nome'];
				$mensagem = 'Sua senha para acesso ao Portal Feras da Constru��o foi alterada para: '.$senha;
				
				//envia email com nova senha 
				if (smtpmailer($email, 'orlandosj@gmail.com', $nome, 'Altera��o de senha', $mensagem)) {

					echo "<script>alert('Foi enviado um email contendo a nova senha para $email'); location = 'index.php';</script>"; exit;
				}	
				
			}
			else{			
				echo "<script>alert('Nome de usu�rio e/ou email incorretos (diferentes do cadastro)')</script>";
			}		
		}	
		
		if(isset($_POST["gerasenha"])){
			$usuario = $_POST["user"];
			$email = $_POST["email"];
			$emailLower = strtolower($email);
			geraSenha($usuario, $emailLower);		
		}

		conectar();
			
		/*** Imagens de anunciantes ***/
		
		$result=mysql_query("SELECT id, url, imagem, tipo FROM anunciantes WHERE status = 1") or die("<script language=JavaScript>alert(\"Falha na exibi��o das imagens dos anunciantes!\");</script>"); 
		
		/*** End of imagens de anunciantes ***/		
	?>

<body class="home blog" data-twttr-rendered="true">

<div class="main_container">
	<div id="centercolumn">
	
	<!-- BEGIN HEADER -->
		<div id="top">
			<div id="logo">
				<div id="pad_logo">
					<h2>FERAS DA CONSTRU��O</h2>
				</div>
			</div><!-- end of logo -->
			<div id="topmenu">
				<div id="nav">
				  <ul id="menu" class="lavaLamp">
					<li class="current_page_item"><a href="index.php">In�cio</a></li>
					<li class="page_item page-item-2357"><a href="portal.php">O Portal</a></li>
					<li class="page_item page-item-2355"><a href="formcadastro.php">Cadastre-se</a></li>
					<li class="page_item page-item-2355"><a href="formcontato.php">Contato</a></li>
					<li class="page_item page-item-7"><a href="#dialog" name="modal">Login</a></li>	

					<div id="boxes">
 
						<!-- #personalize sua janela modal aqui -->					 
						<div id="dialog" class="window">
							<!-- Bot�o para fechar a janela tem class="close" -->
							<a href="#" class="close">Fechar [X]</a><br />
							
							<div id="contactFormArea">
								<form action="validacao.php" method="post" id="cForm">
									<fieldset>
										<div class="fields-form clearfix">
											<div class="form-input">
												<label for="usuario">Usu�rio:</label>
												<input class="inputcadastro" type="text" size="25" name="usuario" id="usuario" value="" tabindex="1" required/>
												<span class="hint">Informe seu nome de usu�rio (n� do cpf)</span><br /><br />
												
												<label for="senha">Senha:</label>
												<input class="inputcadastro" type="password" name="senha" id="senha" value="" tabindex="2" required/>
												<span class="hint">Informe sua senha</span><br /><br />						
											</div>
											
											<label>
												<input class="button"  type="submit" name="submit" id="button" value="Login" tabindex="3" />												
											</label>
											<a href="esquecisenha.php">Esqueci minha senha</a></h3>
																					
										</div>										
									</fieldset>
								</form>
							</div>
						</div>
					 
						<!-- N�o remova o div#mask, pois ele � necess�rio para preencher toda a janela -->
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
			<p style="font-family:arial;color:white;font-size:30px;">Aqui voc� encontra todos os</p>
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
		<img src="images/img/paisagem2.jpg"></a>		
		<img src="images/img/telhado.jpg"></a>
		<img src="images/img/casa.jpg"></a>
		<img src="images/img/interior2.jpg"></a>
		<img src="images/img/paisagem3.jpg"></a>			
	
	</div><!-- end of slider -->
	
  </div> 
  
<!-- END OF SLIDES CONTAINER -->
		
	<!-- BEGIN CONTENT -->
	<div class="clearfix" id="content">
	<div id="padding_content">
		<div class="clearfix" id="topcontent">
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/arquiteto.jpg">
			<h3><a href="profissionais.php?profissao=Arquiteto">Arquitetos e Engenheiros</a></h3>
			<p>Escolha o profissional para projetar sua casa</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/pedreiro.jpg">
			<h3><a href="profissionais.php?profissao=Pedreiro">Pedreiros</a></h3>
			<p>Escolha o profissional para executar sua obra</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/carpinteiro.jpg">
			<h3><a href="profissionais.php?profissao=Carpinteiro">Carpinteiros</a></h3>
			<p>Escolha o profissional para fazer seu telhado</p>
			</div>
			<div class="linetop"></div>			
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/eletricista.jpg">
			<h3><a href="profissionais.php?profissao=Eletricista">Eletricistas</a></h3>
			<p>Escolha o profissional para realizar seu projeto el�trico</p>
			</div>		
			
			<div><img alt="" src="images/prof/separador2.png"> </div>
			
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/encanador.jpg">
			<h3><a href="profissionais.php?profissao=Encanador">Encanadores</a></h3>
			<p>Escolha o profissional para cuidar da parte hidr�ulica</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/serralheiro.jpg">
			<h3><a href="profissionais.php?profissao=Serralheiro">Serralheiros</a></h3>
			<p>Escolha o profissional para fazer port�es, janelas, etc</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/pintor.jpg">
			<h3><a href="profissionais.php?profissao=Pintor">Pintores</a></h3>
			<p>Escolha o profissional para pintar sua casa</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/paisagista.jpg">
			<h3><a href="profissionais.php?profissao=Paisagista">Paisagistas</a></h3>
			<p>Escolha o profissional para fazer seu jardim</p>
			</div>			
		</div><!-- end of topcontent -->
		
		<div id="maincontent">
			<div id="main">
				<div id="maintext">

					<!--<h1>O Bar da Vez</h1>
					<img style="float:right;margin:10px 0px 10px 0;width:120px" src="images/book.png">
					<p>  Mais do que uma ferramenta de busca, O Bar da Vez � o primeiro e �nico site que tr�z tudo sobre os bares de Pedro Leopoldo e regi�o. 
					Participe, vote nos seus bares favoritos, contribua deixando os seus coment�rios, indicando novos bares e espalhando a novidade. 
					O Bar da vez, sempre a melhor op��o! </p>
					<p> 

					</p>-->
					<h2>Recupera��o de senha</h2>
					
					<p></p>
					
					<div id="portal">
						Preencha o formul�rio abaixo e um email ser� enviado para voc� com a sua nova senha.
					</div>
					
					<p></p>
					
					<div id="respond">
						<div id="contactFormArea">
							<form action="" method="post" id="cForm">
								<fieldset>
									<label for="user">Usu�rio:</label>
									<input class="inputcadastro" type="text" size="25" name="user" id="user" value="" tabindex="1" required/>
									<span class="hint">Informe seu nome de usu�rio (n�mero do cpf)</span><br /><br />
									
									<label for="email">Email:</label>
									<input class="inputcadastro" type="text" size="25" name="email" id="email" value="" tabindex="2" required />
									<span class="hint">Informe o email que voc� cadastrou no site</span><br /><br />
									
									<label>
										<input class="button"  type="submit" name="gerasenha" id="gerasenha" value="Gerar senha" tabindex="3" />										
									</label>													
										
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
									<?php
										if($result):
											while ($campo = mysql_fetch_assoc($result)):
												$id   = $campo["id"]; 
												$foto = $campo["imagem"];
												$tipo = $campo["tipo"];
												$url = $campo["url"];
												//print $foto;
												if($url != null):
									?>			
												<li><a href="<?php echo $url;?>"><img class="imgleft" alt="" src="<?php echo "visualiza_imagem_foto.php?id=".$id;?>" width="145px" height="145px"></a></li>
												
									<?php		else:?>			
												<li><img class="imgleft" alt="" src="<?php echo "visualiza_imagem_foto.php?id=".$id;?>" width="145px" height="145px"></li>
												
									<?php		endif;
											endwhile;  
										endif; 
									?>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>
										<li><a href="formanunciante.php">Anuncie aqui</a></li>																				
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
						<p>O conte�do deste site � protegido por Feras da Constru��o, sendo proibido publicar nossas informa��es em outro meio sem autoriza��o pr�via.
</p>
						<p>Copyright &copy; 2013. Feras da Constru��o</p>
					</div><!-- end of footleft -->
					<div class="footleft">
						<h3>Advertise here
</h3>
						<p>O Portal Feras da Constru��o n�o se responsabiliza pelas informa��es fornecidas pelos profissionais cadastrados.
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