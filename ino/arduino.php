<?php
require_once "../control/EquipamentoController.class.php";
// se o post for iniciado...
if (isset($_POST)) {
	// Recebe dados post e salva nas variaveis $mac, $consumo, $dtHora
	$mac = $_POST['mac'];
	$consumo = $_POST['consumo'];
	$dtHora = $_POST['dt_hora'];
	//Instancia um objeto do tipo EquipamentoController
	$controle = new EquipamentoController();
	// A função BuscaEquipamento recebe por parâmetro um endereço mac e retorna 
	// a id do equipamento a qual o endereço mac está atrelado ou retorna 0 caso não
	//exista nenhum equipamento atrelado a este endereço mac
	$idEquipamento = $controle->buscaEquipamento($mac);
	// Se o Id for diferente de 0, insere os dados de consumo no banco
	// a função insertConsumo retorna true, caso insira e false, caso dê erro
	if($idEquipamento!=0){
		$retorno = $controle->insertConsumo($consumo,$dtHora, $idEquipamento);
			// Se tudo ocorrer bem ($retorno=true), retorna a mensagem de sucesso
		if($retorno)
			echo "dados inseridos com sucesso";
		else
			echo "erro ao inserir";
	}else
	echo "nenhum equipamento conectado a este mac";
}

?>