<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["id"])){
    //Fetch all state data
    $query = $conn->query("SELECT * FROM users WHERE id = ".$_POST['id']." ");

    //Count total number of rows
    $rowCount = $query->num_rows;

	$row = $query->fetch_assoc();

  $role = $conn->query("SELECT role FROM roles WHERE id = ".$row['role_id']." ");
	$role = $role->fetch_assoc();
    //State option list
    if($rowCount > 0){
			echo	"<label class='label-input100' for='marca'>Nome</label>				 ";
			echo	"<div class='wrap-input100 validate-input' >  ";
			echo	"<input class='input100' type='text' name='name' id='name' value='".$row['name']."'>";
			echo	"</div>                                                                          ";
      echo    "                                                                                ";
			echo	"<label class='label-input100' for='modelo'>Matricula</label>            ";
			echo	"<div class='wrap-input100'>                                                     ";
			echo	"<input class='input100' type='text' name='matricula' id='matricula' value='".$row['matricula']."'>";
			echo	"</div>                                                                          ";
      echo    "                                                                                ";
			echo	"<label class='label-input100' for='sala'>Usuario</label>                ";
			echo	"<div class='wrap-input100 validate-input'>                                      ";
			echo	"<input class='input100' type='text' name='username' id='username' value='".$row['username']."'>";
			echo	"</div>                                                                          ";
      echo    "                                                                                ";
			echo	"<label class='label-input100' for='sala'>Senha</label>                ";
			echo	"<div class='wrap-input100 validate-input'>                                      ";
			echo	"<input class='input100' type='text' name='password' id='password' value='".$row['password']."'>";
			echo	"</div>                                                                          ";
      echo    "                                                                                ";
			echo	"<label class='label-input100' for='sala'>CPF</label>                ";
			echo	"<div class='wrap-input100 validate-input'>                                      ";
			echo	"<input class='input100' type='text' name='cpf' id='cpf' value='".$row['cpf']."'>";
			echo	"</div>                                                                          ";
      echo    "                                                                                ";
			echo	"<label class='label-input100' for='sala'>Role</label>                ";
			echo	"<div class='wrap-input100 validate-input'>                                      ";
			echo	"<select class='input100' type='text' name='role' id='role'>";
      echo  "<option value='".$row['role_id']."'>".$role['role']."</option>";
      if ($row['role_id'] != '1') {
        echo  "<option value='1'> Admin </option>";
      }
      if ($row['role_id'] != '2') {
        echo  "<option value='2'> Mod </option>";
      }
      if ($row['role_id'] != '3') {
        echo  "<option value='3'> Garagista </option>";
      }
      echo "</select>";
			echo	"</div>                                                                          ";
}}
?>
