jQuery(document).ready
(
	function() 
	{
		/*
		 * Chamamos aqui a fun��o que vai controlar os campos.
		 * Desta forma, caso voc� precise repetir o combo din�mico
		 * basta trocar os ID's dos SELECT's
		 */
		comboDinamico("estado", "cidade", "bairro");
		// suposi��o de segundo bloco de selects
		// comboDinamico("pais_cliente", "estado_cliente", "cidade_cliente", "bairro_cliente");
	}
);
/*
 * fun��o para carregar uma lista din�mica
 */
comboDinamico = function(estado, cidade, bairro) {
	/*
	 * Vari�veis que precisamos pegar
	 * Usamos getElementById() pois � assim que conseguiremos
	 * passar o elemento por vari�vel para jQuery
	 */
	var estado = document.getElementById(estado);
	var cidade = document.getElementById(cidade);
	var bairro = document.getElementById(bairro);
	/*
	 * Carregamos a lista automaticamente quando a p�gina carrega
	 */
	$(estado).load('localizacoes.php?tipo=estado');
	
	/*
	 * Populamos o combo das cidades quando trocamos um valor no estado
	 */	
	$(estado).change(
		function() {
			if($(this).val() == 0) {
				alert('Voc� precisa informar o ESTADO!');
				$(this).focus();
			} else {		
				$(cidade).load('localizacoes.php?tipo=cidade&estado=' + $(this).val());
			}
		}
	);
	/*
	 * Populamos o combo dos bairros quando trocamos um valor na cidade
	 */	
	$(cidade).change(
		function() {
			if($(this).val() == 0) {
				alert('Voc� precisa informar a CIDADE!');
				$(this).focus();
			} else {		
				$(bairro).load('localizacoes.php?tipo=bairro&cidade=' + escape($(this).val()));
			}
		}
	);	
		
}