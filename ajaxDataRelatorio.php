<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["ano"])){
    //Fetch all state data
    $query = $conn->query("SELECT DISTINCT MONTH(data_hora_saida) FROM entrada WHERE YEAR(data_hora_saida) = ".$_POST['ano']." ORDER BY MONTH(data_hora_saida) ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
	
	echo "<script type='text/javascript'>
				$('#mes option[value=1]').text('Janeiro');
				$('#mes option[value=2]').text('Fevereiro');
				$('#mes option[value=3]').text('Março');
				$('#mes option[value=4]').text('Abril');
				$('#mes option[value=5]').text('Maio');
				$('#mes option[value=6]').text('Junho');
				$('#mes option[value=7]').text('Julho');
				$('#mes option[value=8]').text('Agosto');
				$('#mes option[value=9]').text('Setembro');
				$('#mes option[value=10]').text('Outubro');
				$('#mes option[value=11]').text('Novembro');
				$('#mes option[value=12]').text('Dezembro');
				
				</script>";
	
    //State option list
    if($rowCount > 0){
        echo '<option value="">Selecione o mês</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['MONTH(data_hora_saida)'].'">'.$row['MONTH(data_hora_saida)'].'</option>';
        }
    }else{
        echo '<option value="">Modelo inexistente</option>';
    }
}
?>