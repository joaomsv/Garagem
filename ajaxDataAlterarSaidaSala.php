<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["ano"])){
    //Fetch all state data
    $query = $conn->query("SELECT DISTINCT sala_id FROM entrada WHERE YEAR(data_hora_entrada) = ".$_POST['ano']." and status = 0 ORDER BY MONTH(data_hora_saida) ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    if($rowCount > 0){
        echo '<option value="1">Selecione a Sala</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['sala_id'].'">'.$row['sala_id'].'</option>';
        }
    }else{
        echo '<option value="">Nenhuma sala encontrada</option>';
    }
}
?>
