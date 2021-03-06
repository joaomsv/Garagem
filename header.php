<html>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href= <?php echo $_SESSION['home'] ?>>Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php
        if (strpos($_SESSION['url'], "home") === false) {
          if (strpos($_SESSION['url'], "registrar.php") === false && $_SESSION['user_role_id'] == '1') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="registrar.php">Registrar Usuário</a>
                  </li>';
          }
          if (strpos($_SESSION['url'], "alterar.php") === false && $_SESSION['user_role_id'] == '1') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="alterar.php">Alterar Usuário</a>
                  </li>';
          }
          if (strpos($_SESSION['url'], "remover.php") === false && $_SESSION['user_role_id'] == '1') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="remover.php">Remover Usuário</a>
                  </li>';
          }
          if (strpos($_SESSION['url'], "relatorio.php") === false && ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '2'))
          {
            echo '<li class="nav-item">
                    <a class="nav-link" href="relatorio.php">Relatórios</a>
                  </li>';
          }
          if (strpos($_SESSION['url'], "alterar_saida.php") === false && ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '2'))
          {
            echo '<li class="nav-item">
                    <a class="nav-link" href="alterar_saida.php">Saída Manual</a>
                  </li>';
          }
          if (strpos($_SESSION['url'], "entrada.php") === false && ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '3'))
          {
            echo '<li class="nav-item">
                    <a class="nav-link" href="entrada.php">Entrada/Saida de Veiculos</a>
                  </li>';
          }
        }
         ?>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</span></a>
        </li>
      </ul>
    </div>
  </nav>
</html>
