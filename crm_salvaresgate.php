<?php 

function totalpontos($id, $interesse){

  include "conexao.php";

  $query = "SELECT SUM(crm_vlrresgate) AS desconto FROM crm_resgate WHERE crm_interesseresgate = $interesse AND crm_corretorid = $id";

  $exec = mysqli_query($db, $query) or die("Impossível localizar valores.");

  $x = mysqli_fetch_assoc($exec);

$debito = $x["desconto"];


$querysoma = "SELECT SUM(crm_pontostatus) AS pontos, path_foto FROM crm_atendimento INNER JOIN crm_status ON crm_tratastatus = crm_idstatus INNER JOIN cliente ON crm_idcorretor = idcliente INNER JOIN crm_cli ON crm_id = crm_idcli WHERE (imob_id = $id OR idcliente = $id) AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE 'Editado em%' AND crm_interesse = $interesse";

            $execsoma = mysqli_query($db, $querysoma);
            $w = mysqli_fetch_assoc($execsoma);
            $pts = $w["pontos"];
              if (is_null($pts)) {
              	$pts = "0";
              }

if (!is_null($debito)) {
  $pts -= $debito;
}

return $pts;

}


####################################################################################################################################################################################################################################################################
if (isset($_POST["clear"])) {
	include "conexao.php";

	$id = $_POST["clear"];

	$x  = 0;

	$queryclear = "UPDATE crm_resgate SET crm_statusresgate = '$x' WHERE crm_idresgate = '$id'";
	$execclear  = mysqli_query($db, $queryclear) or die("Não foi possível limpar histórico!!");

	


} elseif (isset($_POST["dataresgate"])) {
	
	$idd 	= $_POST["corr"];
	$x 		= $_POST["tipo"];
	$datar 	= date("d-m-Y", strtotime($_POST["dataresgate"])); 

	include "conexao.php";

	$queryapp = "UPDATE crm_resgate SET crm_statusresgate = '$x', crm_dataresgate = '$datar' WHERE crm_idresgate = $idd";

	if(@mysqli_query($db, $queryapp)){
 ?>
 <script>
		window.location= "crm_solicitaresgate.php?cad=1";
	</script>

	<?php
}else{
?>
	<script>
		window.location= "crm_solicitaresgate.php?cad=2";
	</script>
<?php 
}

} elseif ($x = $_GET["app"]) {
	$idd = $_GET["cod"];

	include "conexao.php";

	$queryapp = "UPDATE crm_resgate SET crm_statusresgate = '$x' WHERE crm_idresgate = $idd";
	
	if(@mysqli_query($db, $queryapp)){
 ?>
 <script>
		window.location= "crm_solicitaresgate.php?cad=1";
	</script>

	<?php
}else{
?>
	<script>
		window.location= "crm_solicitaresgate.php?cad=2";
	</script>
<?php 
}

} else {

include "conexao.php";
	
	$interesse = $_POST["hinteresse"];
	$valor_resgate = $_POST["hvlr"];
	$idresgate = $_POST["hpremio"];
	$idcorretor = $_POST["hcorretor"];
	$desc = utf8_decode($_POST["hdescricao"]);

	$valor_carteira = totalpontos($idcorretor, $interesse);
	$statusresgate = '1';
	$dataresgate = "";
	if ($valor_resgate > $valor_carteira) {
		echo "Saldo Insuficiente!!";
	} else {


$inserir = ("INSERT INTO crm_resgate (
	crm_interesseresgate,
	crm_corretorid,
	crm_vlrresgate,
	crm_descresgate,
	crm_codproduto,
	crm_statusresgate,
	crm_dataresgate
)
values (
'$interesse',
'$idcorretor',
'$valor_resgate',
'$desc',
'$idresgate',
'$statusresgate',
'$dataresgate'
)
");
}



if(@mysqli_query($db,$inserir)){
 ?>
 <script>
		window.location= "crm_cadpremio.php?res=1";
	</script>

	<?php
}else{
?>
	<script>
		window.location= "crm_cadpremio.php?res=2";
	</script>
<?php 
}
}

?>