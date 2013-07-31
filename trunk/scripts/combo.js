jQuery(document).ready
(
	function() 
	{
		/*
		 * Chamamos aqui a função que vai controlar os campos.
		 * Desta forma, caso você precise repetir o combo dinâmico
		 * basta trocar os ID's dos SELECT's
		 */
		comboDinamico("estado", "cidade");
		// suposição de segundo bloco de selects
		// comboDinamico("pais_cliente", "estado_cliente", "cidade_cliente", "bairro_cliente");
	}
);
/*
 * função para carregar uma lista dinâmica
 */
comboDinamico = function(estado, cidade) {
	/*
	 * Variáveis que precisamos pegar
	 * Usamos getElementById() pois é assim que conseguiremos
	 * passar o elemento por variável para jQuery
	 */
	var estado = document.getElementById(estado);
	var cidade = document.getElementById(cidade);
	/*
	 * Carregamos a lista automaticamente quando a página carrega
	 */
	$(estado).load('localizacoes.php?tipo=estado');
	
	/*
	 * Populamos o combo das cidades quando trocamos um valor no estado
	 */	
	$(estado).change(
		function() {
			if($(this).val() == 0) {
				alert('Você precisa informar o ESTADO!');
				$(this).focus();
			} else {		
				$(cidade).load('localizacoes.php?tipo=cidade&estado=' + $(this).val());
			}
		}
	);		
}