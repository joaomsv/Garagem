<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["mes"]) && $_POST["salarelatorio"]!=1){
    //Fetch all state data
    $query = $conn->query("SELECT DISTINCT DAY(data_hora_entrada) FROM entrada WHERE MONTH(data_hora_entrada) = ".$_POST['mes']." and sala_id = ".$_POST['salarelatorio']." and status = 0 ORDER BY DAY(data_hora_entrada) ASC");
}
else {
  $query = $conn->query("SELECT DISTINCT DAY(data_hora_entrada) FROM entrada WHERE MONTH(data_hora_entrada) = ".$_POST['mes']." and sala_id = sala_id and status = 0 ORDER BY DAY(data_hora_entrada) ASC");
}
    //Count total number of rows
    $rowCount = $query->num_rows;

    //State option list
    if($rowCount > 0){
        echo '<option value="">Selecione um dia</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['DAY(data_hora_entrada)'].'">'.$row['DAY(data_hora_entrada)'].'</option>';
        }
    }else{
        echo '<option value="Dados inexistentes">Dados inexistentes</option>';
    }

?>
