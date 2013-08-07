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
	
	<script>
		function validarSenha(){
			senha1 = document.updatesenha.senhanova.value
			senha2 = document.updatesenha.confirmasenha.value
		 
			if (senha1 != senha2){
				alert("Os campos senha e confirma��o de senha devem ser iguais")
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
	
	<script charset="utf-8" src="scripts/slider.js" type="text/javascript"></script>

<?php

	// A sess�o precisa ser iniciada em cada p�gina diferente
	if (!isset($_SESSION)) 
		session_start();

	// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
	if (!isset($_SESSION['ProfissionalID'])) {
		// Destr�i a sess�o por seguran�a
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: index.php"); exit;
	}
	
	require_once "conexao.php";

	conectar();
	
	$id = $_SESSION['ProfissionalID'];
 
	/* monta a instrucao SQL*/
	$strSql = "SELECT * FROM profissionais WHERE id = $id";
 
	/* executa a query*/
	$query = mysql_query($strSql) or die("<script language=JavaScript>alert(\"N�o foi poss�vel carregar os dados!\");</script>");
	 
	$result = mysql_fetch_assoc($query);
	
	
	function updateProfissional($id, $email, $telefone, $telefone2, $estado, $cidade, $servicos, $info){
		conectar();
		
		if($telefone2 == "")
			$telefone2 = NULL;
	
		$consulta = "UPDATE profissionais  SET email = '$email', telefone = '$telefone', telefone_alternativo = '$telefone2', 
												estado = '$estado', cidade = '$cidade', servicos = '$servicos', 
												informacoes = '$info' WHERE id = '$id'";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execu��o!\");</script>");	
		
		echo "<script>alert('Dados alterados com sucesso!')</script>";
	}		

	if(isset($_POST["atualizar"])){
		$id = $_SESSION['ProfissionalID'];
		$nome = $_POST["author"];
		$cpf = $_POST["cpf"];
		$email = $_POST["email"];
		$telefone = $_POST["telefone"];
		$telefone2 = $_POST["telefone2"];
		$profissao = $_POST["profissao"];
		$estado = $_POST["estado"];
		$cidade = $_POST["cidade"];
		$servicos = $_POST["servicos"];
		$info = $_POST["info"];
		$data =  date('Y-m-d H:i:s');
		updateProfissional($id, $email, $telefone, $telefone2, $estado, $cidade, $servicos, $info);		
	}	

	function updateSenha($id, $senha){
		conectar();
		
		$senha = sha1(md5($senha));
		
		$consulta = "UPDATE profissionais  SET senha = '$senha' WHERE id = '$id'";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execu��o!\");</script>");	
		
		echo "<script>alert('Senha alterada com sucesso!')</script>";
	}
	
	if(isset($_POST["alterarsenha"])){
		$id = $_SESSION['ProfissionalID'];
		$senha = $_POST["senhanova"];
		updateSenha($id, $senha);		
	}
	
	function enviarDica($id, $dica, $status, $data){
		conectar();
		
		$consulta = "INSERT INTO dicas (id_profissional, dica, status, data)  VALUES ('$id', '$dica', '$status', '$data')";
		$resultado = mysql_query($consulta) or die("<script language=JavaScript>alert(\"Falha na execu��o!\");</script>");	
		
		echo "<script>alert('Dica enviada com sucesso!')</script>";
	}
	
	if(isset($_POST["enviardica"])){
		$id = $_SESSION['ProfissionalID'];
		$dica = $_POST["dica"];
		$status = 1;
		$data =  date('Y-m-d H:i:s');
		enviarDica($id, $dica, $status, $data);		
	}
?>	
	
<body class="home blog" data-twttr-rendered="true">

<div class="main_container">
	<div id="centercolumn">
	
	<!-- BEGIN HEADER -->
		<div id="top">
			<div id="logo">
				<div id="pad_logo">
					<h2>PORTAL DA CONSTRU��O</h2>
				</div>
			</div><!-- end of logo -->
			<div id="topmenu">
				<div id="nav">
				  <ul id="menu" class="lavaLamp">
					<li class="current_page_item"><a href="index.php">In�cio</a></li>
					<li class="page_item page-item-2357"><a href="portal.html">O Portal</a></li>
					<li class="page_item page-item-2355"><a href="cadastro.html">Cadastre-se</a></li>
					<li class="page_item page-item-2355"><a href="contato.html">Contato</a></li>
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
				Ol�, Administrador <?php echo $_SESSION['ProfissionalNome']; ?>! <br></br>				
			</div>
			<br></br>
			
			<div id="maincontent">
				<div id="main">
					<div id="maintext">

						<h2>Cadastro</h2>

						<p></p>
						
						<div id="respond">
							<div id="contactFormArea">
								<form action="" method="post" id="update" name="update" >
									<fieldset>
										
										<label for="author">Nome:</label>
										<input class="inputcadastro" type="text" size="25" name="author" id="author" value="<?php echo $result['nome']; ?>" tabindex="1" readonly="readonly" required/>
										<br></br>
										
										<label for="cpf">CPF:</label>
										<input class="inputcadastro" type="text" name="cpf" id="cpf" value="<?php echo $result['cpf']; ?>" tabindex="2" readonly="readonly" required/>
										<br /><br />
										
										<label for="email">Email:</label>
										<input class="inputcadastro" type="text" size="25" name="email" id="email" value="<?php echo $result['email']; ?>" tabindex="3" required/>
										<span class="hint">Informe um email v�lido para que possamos entrar em contato. Este email n�o ser� compartilhado com ningu�m.</span><br /><br />
										
										<label for="telefone">Telefone:</label>
										<input class="inputcadastro" type="text" size="25" name="telefone" id="telefone" value="<?php echo $result['telefone']; ?>" tabindex="4" required/>
										<span class="hint">Informe um telefone para contato</span><br /><br />
										
										<label for="telefone2">Telefone Alternativo:</label>
										<input class="inputcadastro input-help" type="text" size="25" name="telefone2" id="telefone2" value="<?php echo $result['telefone_alternativo']; ?>" tabindex="5" />
										<span class="hint">Informe outro n�mero de telefone para contato (n�o obrigat�rio)</span><br /><br />
										
										<label for="profissao">Profiss�o:</label>
										<select required aria-required="true" class="dropdownlist" name="profissao" id="profissao" tabindex="6"> 
												<option selected value="<?php echo $result['profissao']; ?>"><?php echo $result['profissao']; ?></option>
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
										<!--<span class="hint">Selecione a sua profiss�o</span>--><br /><br />
										
										<label for="estado">Estado:</label>
										<select required aria-required="true" class="dropdownlist" name="estado" id="estado" tabindex="7" required> 																																			
												
										</select>
										<span class="hint">Selecione o estado no qual trabalha</span><br /><br />
										
										<label for="cidade">Cidade:</label>
										<select required aria-required="true" class="dropdownlist" name="cidade" id="cidade" tabindex="8"> 
											<option value="">---Selecione primeiro o estado---</option>	
										</select>
										<span class="hint">Selecione a cidade na qual trabalha</span><br /><br/>

										<label for="servico">Servi�os prestados:</label>
										<textarea class="inputtextarea" cols="60" rows="5" name="servicos" id="servicos" tabindex="9" required><?php echo $result['servicos'];?></textarea>
										<span class="hint">Digite aqui os principais servi�os que realiza, separados por v�rgula</span><br /><br />
										
										<label for="info">Informa��es adicionais:</label>
										<textarea class="inputtextarea" cols="60" rows="5" name="info" id="info" tabindex="10" ><?php echo $result['informacoes'];?></textarea>
										<span class="hint">Digite aqui outras informa��es relevantes a seus clientes (preenchimento n�o obrigat�rio)</span><br /><br />
										<label>
											<input class="button"  type="submit" name="atualizar" id="atualizar" value="Atualizar" tabindex="11" />										
										</label><br></br>
														
										
																				
									</fieldset>
								</form>
							</div>
						</div>
						
						<br></br>
						
						
					</div><!-- end of maintext -->
				</div><!-- end of main -->
				
				<div id="senha" class="updateinfo">
					<h2>Alterar senha</h2>				
					<p></p>
					
					<div id="senha" class="boxsenha">
					<form action="" method="post" id="updatesenha" name="updatesenha" >
							<fieldset>
								
								<label for="senhaantiga">Senha atual:</label>
								<input class="inputcadastro input-help" type="password" size="25" name="senhaantiga" id="senhaantiga" value="" tabindex="12" onBlur="validarSenhaAntiga()" required/>
								<span class="hint">Informe a sua senha atual</span><br /><br />
								
								<label for="senhanova">Nova senha:</label>
								<input class="inputcadastro input-help" type="password" size="25" name="senhanova" id="senhanova" value="" tabindex="13" onBlur="validarTamanhoSenha()" required/>
								<span class="hint">Informe a sua nova senha</span><br /><br />
								
								<label for="confirmasenha">Confirma��o de Senha:</label>
								<input class="inputcadastro input-help" type="password" size="25" name="confirmasenha" id="confirmasenha" value="" tabindex="14" onBlur="validarSenha()" required/>
								<span class="hint">Repita a nova senha escolhida para acesso ao portal</span><br /><br />								
								
								<label>
									<input class="button"  type="submit" name="alterarsenha" id="alterarsenha" value="Alterar senha" tabindex="15" />										
								</label><br></br>							
																		
							</fieldset>
						</form>						
					</div>
					
					<br></br>						
				</div><!-- end of updateinfo -->
				
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
						<p>O conte�do deste site � protegido por Portal da Constru��o, sendo proibido publicar nossas informa��es em outro meio sem autoriza��o pr�via.
</p>
						<p>Copyright &copy; 2013. Portal da Constru��o</p>
					</div><!-- end of footleft -->
					<div class="footleft">
						<h3>Advertise here
</h3>
						<p>O Portal da Constru��o n�o se responsabiliza pelas informa��es fornecidas pelos profissionais cadastrados.
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