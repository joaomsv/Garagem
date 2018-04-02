<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["salarelatorio"]) && $_POST['salarelatorio'] !=1){
    //Fetch all state data
$query = $conn->query("SELECT DISTINCT MONTH(data_hora_entrada) FROM entrada WHERE sala_id = '".$_POST["salarelatorio"]."' and status = 0 ORDER BY MONTH(data_hora_entrada) ASC ");
}
else
{
  $query = $conn->query("SELECT DISTINCT MONTH(data_hora_entrada) FROM entrada WHERE YEAR(data_hora_entrada) = '".$_POST["ano"]."' and status = 0 ORDER BY MONTH(data_hora_entrada) ASC ");
}
    //Count total number of rows
    $rowCount = $query->num_rows;

	echo "<script type='text/javascript'>
				$('#mes_alterar option[value=1]').text('Janeiro');
				$('#mes_alterar option[value=2]').text('Fevereiro');
				$('#mes_alterar option[value=3]').text('Março');
				$('#mes_alterar option[value=4]').text('Abril');
				$('#mes_alterar option[value=5]').text('Maio');
				$('#mes_alterar option[value=6]').text('Junho');
				$('#mes_alterar option[value=7]').text('Julho');
				$('#mes_alterar option[value=8]').text('Agosto');
				$('#mes_alterar option[value=9]').text('Setembro');
				$('#mes_alterar option[value=10]').text('Outubro');
				$('#mes_alterar option[value=11]').text('Novembro');
				$('#mes_alterar option[value=12]').text('Dezembro');

				</script>";

    //State option list
    if($rowCount > 0){
        echo '<option value="">Selecione um Mês</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['MONTH(data_hora_entrada)'].'">'.$row['MONTH(data_hora_entrada)'].'</option>';
        }
    }else{
        echo '<option value="Dados inexistentes">Dados inexistentes</option>';
    }

?>
