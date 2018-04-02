<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["ano"]) && !empty($_POST["dia"]) && !empty($_POST["sala"]) && !empty($_POST["mes"])){
    //Fetch all state data
    $query = $conn->query("SELECT id,placa FROM entrada WHERE YEAR(data_hora_entrada) = ".$_POST['ano']." and MONTH(data_hora_entrada) = ".$_POST['mes']." and DAY(data_hora_entrada) = ".$_POST['dia']." and sala_id = ".$_POST['sala']." ORDER BY TIME(data_hora_entrada) and status = 0 ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    if($rowCount > 0){
        echo '<option value="">Selecione uma placa</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['id'].'">'.$row['placa'].'</option>';
        }
    }else{
        echo '<option value="">Nenhum veículo encontrado</option>';
    }
}
?>
