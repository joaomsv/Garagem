<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["marca_id"])){
    //Fetch all state data
    $query = $conn->query("SELECT * FROM modelos WHERE marca_id = ".$_POST['marca_id']." ORDER BY name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Selecione o modelo</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }else{
        echo '<option value="">Modelo inexistente</option>';
    }
}
?>