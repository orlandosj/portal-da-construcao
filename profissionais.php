
<html xmlns="http://www.w3.org/1999/xhtml"><head>

	<title>Portal da Construção</title>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	
	<link media="screen" type="text/css" href="css/style.css" rel="stylesheet">

	
	<script id="twitter-wjs" src="http://platform.twitter.com/widgets.js"></script>
	<script src="scripts/jquery.js" type="text/javascript"></script>
	<script src="scripts/jquery.easing.min.js" type="text/javascript"></script>
	<script src="scripts/jquery.lavalamp.min.js" type="text/javascript"></script>
	<script src="scripts/js.js" type="text/javascript"></script>
	<script src="scripts/jquery.cycle.all.js" type="text/javascript"></script>
	
	<script src="scripts/combo.js"></script>	
	
	<script src="scripts/jquery-1.9.0.min.js" type="text/javascript"></script>
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
	
	<script src="scripts/jquery.flexslider-min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$a = jQuery.noConflict(); 
		$a(window).load(function() {
			$a('#slideshow').flexslider();
		});
	</script>
	
	<script type="text/javascript" src="scripts/jquery-latest.js"></script>
	<script type="text/javascript">
		$b = jQuery.noConflict();
		$b(document).ready(function(){
		$b("ul.thumb li").hover(function() {
		 $b(this).css({'z-index' : '10'});
		 $b(this).find('img').addClass("hover").stop()
		 .animate({
		 marginTop: '0px', 
		 marginLeft: '0px', 
		 top: '0', 
		 left: '0', 
		 width: '450px', 
		 height: '450px'
		 }, 200);

		 } , function() {
		 $b(this).css({'z-index' : '0'});
		 $b(this).find('img').removeClass("hover").stop()
		 .animate({
		 marginTop: '0', 
		 marginLeft: '0',
		 top: '0', 
		 left: '0', 
		 width: '200px', 
		 height: '200px'
		 }, 400);
		});});
	</script>
	
	<!-- Zoon na imagem
	$(document).ready(function(){
       $('#imgSmile').width(200);
       $('#imgSmile').mouseover(function()
       {
          $(this).css("cursor","pointer");
          $(this).animate({width: "800px"}, 'slow');
       });
    
    $('#imgSmile').mouseout(function()
      {   
          $(this).animate({width: "200px"}, 'slow');
       });
   });-->
	
	<script charset="utf-8" src="scripts/slider.js" type="text/javascript"></script>
	
<?php
/*Página para CRUD de comentários*/
require_once "conexao.php";
	
	conectar();
		
	$limite = 5; // Define o limite de registros a serem exibidos com o valor cinco
	
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
	
	if(isset($_GET["profissao"]))
		$profissao = $_GET["profissao"];
	else
		$profissao = "";
	
	if($profissao == "Arquiteto")	
		$consulta = "SELECT * FROM profissionais WHERE status = 1 AND (profissao = 'Arquiteto' OR profissao = 'Engenheiro') ORDER BY nome LIMIT $inicio,$limite";
	else
		$consulta = "SELECT * FROM profissionais WHERE status = 1 AND profissao = '$profissao' ORDER BY nome LIMIT $inicio,$limite";
	
	
	$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução da consulta!\");location = 'index.php';</script>");
	$resultado2 = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução da consulta!\");location = 'index.php';</script>");
	
	$consulta_total = mysql_query($consulta); // Seleciona o campo id da nossa tabela produtos
	// Captura o número do total de registros no nosso banco a partir da nossa consulta
	$total_registros = mysql_num_rows($consulta_total);
	
	/* Define o total de páginas a serem mostradas baseada
	na divisão do total de registros pelo limite de registros a serem mostrados */
	if($total_registros > 0)
		$total_paginas = Ceil($total_registros / $limite);
	else
		$total_paginas = 0;
		
	if(isset($_POST["filtrar"])){
		$cidade = $_POST["cidade"];
		
		if($cidade != "Todas"){
			if($profissao == "Arquiteto")	
				$consulta = "SELECT * FROM profissionais WHERE cidade = '$cidade' AND status = 1 AND (profissao = 'Arquiteto' OR profissao = 'Engenheiro') ORDER BY nome LIMIT $inicio,$limite";
			else
				$consulta = "SELECT * FROM profissionais WHERE cidade = '$cidade' AND status = 1 AND profissao = '$profissao' ORDER BY nome LIMIT $inicio,$limite";
		
		
			$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução da consulta!\");location = 'index.php';</script>");
			//$resultado2 = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execução da consulta!\");location = 'index.php';</script>");
			
			$consulta_total = mysql_query($consulta); // Seleciona o campo id da nossa tabela produtos
			// Captura o número do total de registros no nosso banco a partir da nossa consulta
			$total_registros = mysql_num_rows($consulta_total);
			
			/* Define o total de páginas a serem mostradas baseada
			na divisão do total de registros pelo limite de registros a serem mostrados */
			if($total_registros > 0)
				$total_paginas = Ceil($total_registros / $limite);
			else
				$total_paginas = 0;			
		}
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
					<li class="page_item page-item-7"><a href="#dialog" name="modal">Login</a></li>	

					<div id="boxes">
 
						<!-- #personalize sua janela modal aqui -->					 
						<div id="dialog" class="window">
							<!-- Botão para fechar a janela tem class="close" -->
							<a href="#" class="close">Fechar [X]</a><br />
							
							<div id="contactFormArea">
								<form action="validacao.php" method="post" id="cForm">
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
				<div class="boxprof">
				<div id="respond">
						<div id="contactFormArea" >
							<form action="" method="post" id="pesquisa" name="pesquisa" >
								<fieldset>
									
									<select required aria-required="true" class="oculto" name="estado" id="estado" tabindex="9"> 																																			
									</select>
									
									<div align="center">
									Cidade:
									<select required aria-required="true"  class="dropdownlist" name="cidade" id="cidade" tabindex="10"> 
										<option>Todas</option>
										<?php while($linha2 = mysql_fetch_assoc($resultado2)):?>
											<option value="<?php echo $linha2["cidade"];?>"><?php echo $linha2["cidade"];?></option>
										<?php endwhile;?>
									</select>
									<span class="hint">Para filtrar a pesquisa selecione a cidade para a qual procura o profissional</span>
									
									<input class="button"  type="submit" name="filtrar" id="button" value="Filtrar" tabindex="13" />										
									</div>
									<br></br>															
									<br></br>										
								</fieldset>
							</form>
						</div>
					</div>
					
				<?php
						if($total_registros > 0):
							while($linha = mysql_fetch_assoc($resultado)):
								$nome = $linha['nome'];
								$profissao = $linha['profissao'];
								//if($profissao == "Engenheiro" || $profissao == "Arquiteto")
									//$profissao.="(a)";
								$city = $linha['cidade'];
								$telefone = $linha['telefone'];	
								$telefone2 = $linha['telefone_alternativo'];
								$email = $linha['email'];
								$servicos = $linha['servicos'];
								$informacoes = $linha['informacoes'];
					?>
						<div class="info-profissionais">
							<b>Nome:</b> <?php echo $nome;  
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							?>
							<b>Profissao:</b> <?php echo $profissao;
							if($profissao == "Arquiteto" || $profissao == "Engenheiro"){
								echo "(a)";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							?>
							<b>Cidade:</b> <?php echo $city;?>
							<p></p>
							<b>Telefone(s):</b> 
							<?php echo $telefone;
								if($telefone2 != null)
									echo " - $telefone2 ";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							?> 
							<b>Email:</b> <?php echo $email ?><p></p>
							<b>Serviços realizados:</b> <?php echo $servicos ?><p></p>
							<?php if($informacoes != null):?>
							<b>Informações adicionais:</b> <?php echo $informacoes; endif;?>
						</div>
							
						<div> <?php echo "&nbsp;"; ?></div>
						
					<?php 
						endwhile;
						endif;
						$ant = $pagina - 1;						
						$prox = $pagina + 1;												
						$ultima_pag = $total_paginas;
						$penultima = $ultima_pag - 1;  
						$adjacentes = 2;
					?>
					
					
						<?php
							if($total_paginas > 1):
						?>
					<!-- PAGINAÇÃO -->
					<nav class="site-pagination">
						<?php
								if($total_paginas <= 5){
									if($total_paginas > 1 && $pagina > 1){
										echo '<a href="profissinais.php?pag=1" > Primeira </a>';
									}
									
									if($pagina > 1){
										echo '<a href="profissinais.php?pag='.$ant.'" class="prev" > <img src="images/pag-ant.png"> </a>';
									}
									for($i=1; $i <= $total_paginas; $i++){
										if($i == $pagina)
											echo '<a href="profissinais.php?pag='.$i.'" class= "active" > '.$i.'</a>';
										else
											echo '<a href="profissinais.php?pag='.$i.'"> '.$i.'</a>';								
									} 
									if($pagina < $ultima_pag && $ultima_pag > 2){
										echo '<a href="profissinais.php?pag='.$prox.'" class="next" > <img src="images/pag-prox.png"> </a>';
									}
									
									if($total_paginas > 1 && $pagina < $ultima_pag){
										echo '<a href="profissinais.php?pag='.$ultima_pag.'" > Última </a>';
									}
								}
								else{
									if ($pagina < 1 + (2 * $adjacentes)){
										if($pagina > 1){
											echo '<a href="profissinais.php?pag=1" > Primeira </a>';
											echo '<a href="profissinais.php?pag='.$ant.'" class="prev" > <img src="images/pag-ant.png"> </a>';
										}
										
										for($i=1; $i < 2 + (2 * $adjacentes); $i++){
											if($i == $pagina)
												echo '<a href="profissinais.php?pag='.$i.'" class= "active" > '.$i.'</a>';
											else
												echo '<a href="profissinais.php?pag='.$i.'"> '.$i.'</a>';									
										}
										echo '...';
										if($pagina < $ultima_pag){
											echo '<a href="profissinais.php?pag='.$prox.'" class="next" > <img src="images/pag-prox.png"> </a>';
											echo '<a href="profissinais.php?pag='.$ultima_pag.'" > Última </a>';
										}
									}								
									else if($pagina > (2 * $adjacentes) && $total_paginas < 8){
										echo '<a href="profissinais.php?pag=1" > Primeira </a>';
										echo '<a href="profissinais.php?pag='.$ant.'" class="prev" > <img src="images/pag-ant.png"> </a>';
										echo '...';
										for($i = $pagina-$adjacentes; $i<= $total_paginas; $i++){
											if($i == $pagina)
												echo '<a href="profissinais.php?pag='.$i.'" class= "active" > '.$i.'</a>';
											else
												echo '<a href="profissinais.php?pag='.$i.'"> '.$i.'</a>';									
										}
										if($pagina < $ultima_pag){
											echo '<a href="profissinais.php?pag='.$prox.'" class="next" > <img src="images/pag-prox.png"> </a>';
											echo '<a href="profissinais.php?pag='.$ultima_pag.'" > Última </a>';
										}
									}
									else if($pagina > (2 * $adjacentes) && $pagina < $ultima_pag - 3){
										echo '<a href="profissinais.php?pag=1" > Primeira </a>';
										echo '<a href="profissinais.php?pag='.$ant.'" class="prev" > <img src="images/pag-ant.png"> </a>';
										echo '...';
										for($i = $pagina-$adjacentes; $i<= $pagina + $adjacentes; $i++){
											if($i == $pagina)
												echo '<a href="profissinais.php?pag='.$i.'" class= "active" > '.$i.'</a>';
											else
												echo '<a href="profissinais.php?pag='.$i.'"> '.$i.'</a>';									
										}
										echo '...';
										echo '<a href="profissinais.php?pag='.$prox.'" class="next" > <img src="images/pag-prox.png"> </a>';
										echo '<a href="profissinais.php?pag='.$ultima_pag.'" > Última </a>';
									}
									else{
										echo '<a href="profissinais.php?pag=1" > Primeira </a>';
										echo '<a href="profissinais.php?pag='.$ant.'" class="prev" > <img src="images/pag-ant.png"> </a>';
										echo '...';
										for ($i = $pagina - $adjacentes; $i <= $ultima_pag; $i++){
											if($i == $pagina)
												echo '<a href="profissinais.php?pag='.$i.'" class= "active" > '.$i.'</a>';
											else
												echo '<a href="profissinais.php?pag='.$i.'"> '.$i.'</a>';
										}
										if($pagina < $ultima_pag){
											echo '<a href="profissinais.php?pag='.$prox.'" class="next" > <img src="images/pag-prox.png"> </a>';
											echo '<a href="profissinais.php?pag='.$ultima_pag.'" > Última </a>';
										}
									}							
								}
							?>
					</nav> <br></br>
					<!-- END OF PAGINAÇÃO -->
					
					<?php
							endif;
							if($total_registros == 0):
								?>
								<div id="portal">
									<?php if($profissao == "Engenheiro" || $profissao == "Arquiteto"):?>
										Nenhum arquiteto ou engenheiro cadastrado;
									<?php else:?>
										Nenhum <?php echo strtolower($profissao)?> cadastrado.
									<?php endif;?>
								</div>
								
							<?php endif; ?>						
					
					<br></br>
					<h4><a href="index.php">Voltar à página principal</a></h4>
				</div>	
				<div id="side">
					<div class="sidebox">
						<div class="c_bottomsidebox">
							<!--<div class="contentbox">
							<iframe width="300" scrolling="no" height="500" frameborder="0" id="twitter-widget-0" class="twitter-timeline twitter-timeline-rendered" allowtransparency="true" style="border: medium none; max-width: 100%; min-width: 180px;" title="Twitter Timeline Widget"></iframe>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

							</div>-->
							<!--<div id="anuncios" class="sidetext">
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
							</div><!-- end of anuncios -->
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