<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["mes"])){
    //Fetch all state data
    $query = $conn->query("SELECT DISTINCT DAY(data_hora_saida) FROM entrada WHERE MONTH(data_hora_saida) = ".$_POST['mes']." and sala_id = ".$_POST['salarelatorio']." ORDER BY DAY(data_hora_saida) ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //State option list
    if($rowCount > 0){
        echo '<option value="">Todos</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['DAY(data_hora_saida)'].'">'.$row['DAY(data_hora_saida)'].'</option>';
        }
    }else{
        echo '<option value="Dados inexistentes">Dados inexistentes</option>';
    }
}
?>
