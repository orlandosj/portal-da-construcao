<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<title>Cadastro</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!--<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">-->
		
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
		$("#telefone2").mask("(99) 9999-9999");		
		$("#cpf").mask("999.999.999-99");
		$("#cnpj").mask("99.999.999/9999-99");
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
	function Apenas_Numeros(caracter)
	{
	  var nTecla = 0;
	  if (document.all) {
		  nTecla = caracter.keyCode;
	  } else {
		  nTecla = caracter.which;
	  }
	  if ((nTecla> 47 && nTecla <58)
	  || nTecla == 8 || nTecla == 127
	  || nTecla == 0 || nTecla == 9  // 0 == Tab
	  || nTecla == 13) { // 13 == Enter
		  return true;
	  } else {
		  return false;
	  }
	}
	function validaCPF(cpf) 
	 {
	   erro = new String;
	 
		if (cpf.value.length == 14)
		{	
			cpf.value = cpf.value.replace('.', '');
			cpf.value = cpf.value.replace('.', '');
			cpf.value = cpf.value.replace('-', '');
	 
			if (cpf.value == "00000000000" || 
					cpf.value == "11111111111" || 
					cpf.value == "22222222222" || 
					cpf.value == "33333333333" || 
					cpf.value == "44444444444" || 
					cpf.value == "55555555555" || 
					cpf.value == "66666666666" || 
					cpf.value == "77777777777" || 
					cpf.value == "88888888888" || 
					cpf.value == "99999999999") {
					
					erro = "Número de CPF inválido!"
			}

			var a = [];
			var b = new Number;
			var c = 11;

			for (i=0; i<11; i++){
					a[i] = cpf.value.charAt(i);
					if (i < 9) b += (a[i] * --c);
			}

			if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
			b = 0;
			c = 11;

			for (y=0; y<10; y++) b += (a[y] * c--); 

			if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

			if ((cpf.value.charAt(9) != a[9]) || (cpf.value.charAt(10) != a[10])) {
				erro = "Número de CPF inválido.";
				
			}
				
		}
		else
		{
			if(cpf.value.length == 0)
				return false
			else
				erro = "Número de CPF inválido.";
		}
		if (erro.length > 0) {
				alert(erro);
				cpf.focus();
				return false;
		}		
		return true;	
	 }	 
	 
	 function validaCNPJ(cpf){
	 
	 }
	</script>
	
	<script charset="utf-8" src="scripts/slider.js" type="text/javascript"></script>
<?php
/*Selects de comentários, dicas e imagens de anunciantes*/
require_once "conexao.php";
	
	conectar();
		
	/*** Imagens de anunciantes ***/
	
	$result=mysql_query("SELECT id, url, imagem, tipo FROM anunciantes WHERE status = 1") or die("<script language=JavaScript>alert(\"Falha na exibição das imagens dos anunciantes!\");</script>"); 
	
	/*** End of imagens de anunciantes ***/
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
					<li class="page_item page-item-7"><a href="#dialog" name="modal">Login</a></li>	

					<div id="boxes">
 
						<!-- #personalize sua janela modal aqui -->					 
						<div id="dialog" class="window">
							<!-- Botão para fechar a janela tem class="close" -->
							<a href="#" class="close">Fechar [X]</a><br />
							
							<div id="contactFormArea">
								<form action="#" method="post" id="cForm">
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
											<a href="esquecisenha.php">Esqueci minha senha</a></h3>
																					
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
			<p>Escolha o profissional para realizar seu projeto elétrico</p>
			</div>		
			
			<div><img alt="" src="images/prof/separador2.png"> </div>
			
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/encanador.jpg">
			<h3><a href="profissionais.php?profissao=Encanador">Encanadores</a></h3>
			<p>Escolha o profissional para cuidar da parte hidráulica</p>
			</div>
			<div class="linetop"></div>
			<div class="boxtop"><img class="imgleft" alt="" src="images/prof/serralheiro.jpg">
			<h3><a href="profissionais.php?profissao=Serralheiro">Serralheiros</a></h3>
			<p>Escolha o profissional para fazer portões, janelas, etc</p>
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

					<h2>Cadastro de anunciante</h2>
					
					<p></p>
					
					<div id="portal">
						Para divulgar seu estabelecimento no Portal Feras da Construção preencha o formulário abaixo.
						Você pode optar pelas seguintes formas de pagamento:<p></p>
							<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
							- Mensal: você paga R$120,00 todo mês<p></p>
							<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
							- Semestral: você paga R$600,00 e anuncia durante seis meses<p></p>
							<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
							- Anual: você paga R$1000,00 e anuncia durante 1 ano<p></p>
						<p></p>
						As informações para pagamento serão enviadas para o email cadastrado.
					</div>
					
					<br></br>
					
					<div id="respond">
						<div id="contactFormArea">
							<form action="anunciante.php" method="post" id="cadastroanunciante" name="cadastroanunciante" enctype="multipart/form-data">
								<fieldset>
									
									<label for="nome">Nome:</label>
									<input class="inputcadastro" type="text" size="25" name="nome" id="nome" value="" tabindex="1" required/>
									<span class="hint">Informe seu nome completo ou o nome do estabelecimento</span><br /><br />
									
									<label for="cnpj">CNPJ:</label>
									<input class="inputcadastro" type="text" name="cnpj" id="cnpj" value="" tabindex="2" onBlur="validaCNPJ(this);" required/>
									<span class="hint">Informe seu CNPJ</span><br /><br />
									
									<label for="email">Email:</label>
									<input class="inputcadastro" type="text" size="25" name="email" id="email" value="" tabindex="3" required/>
									<span class="hint">Informe um email válido para que possamos entrar em contato. Este email não será compartilhado com ninguém.</span><br /><br />
									
									<label for="telefone">Telefone:</label>
									<input class="inputcadastro" type="text" size="25" name="telefone" id="telefone" value="" tabindex="4" required/>
									<span class="hint">Informe um telefone para contato</span><br /><br />
									
									<label for="url">Endereço na internet:</label>
									<input class="inputcadastro" type="text" size="25" name="url" id="url" value="" tabindex="5" />
									<span class="hint">Informe o endereço do estabelecimento na internet (não obrigatório)</span><br /><br />
									
									<label for="imagem">Imagem:</label>
									<input class="inputcadastro" type="file" size="25" name="imagem" id="imagem" value="" tabindex="6" required/>
									<span class="hint">Escolha uma imagem para aparecer no anúncio (tamanho até 900 KB)</span><br /><br />
									
									<label for="planoanuncio">Plano de pagamento:</label>
									<select required aria-required="true" class="dropdownlist" name="planoanuncio" id="planoanuncio" tabindex="7"> 
											<option selected value="">Selecione o plano</option>
											<option value="mensal">Mensal - R$120,00</option>
											<option value="semestral">Semestral - R$600,00</option>
											<option value="anual">Anual - R$1000,00</option>											
									</select><br /><br />
									
									<label>
										<input class="button"  type="submit" name="cadastraranunciante" id="cadastraranunciante" value="Enviar" tabindex="8" />										
									</label><br></br>																
																			
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