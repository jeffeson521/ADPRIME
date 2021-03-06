<?php 
    session_start();
    if(!isset($_SESSION['id_usuario'])){
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" lang="pt-br" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" href="../css/enviados.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body>
  <!--menu lateral-->
  <div class="sidebar">
    <a class="active" href="usuario.php"><i class="fas fa-home"></i>&emsp;Home</a>
    <a class="menuleft" href="enviados.php"><i class="fas fa-upload"></i>&emsp;Arquivos Enviados</a>
    <a class="menuleft" href="recebidos.php"><i class="fas fa-download"></i>&emsp;Arquivos Recebidos</a>
    <a class="menuleft" id="enviar"><i class="fas fa-file-upload"></i>&emsp;Enviar Arquivos</a>
    <a class="menuleft" href="../tela_atualiza_dados/atualiza_dados_user.php" id="trocarsenha"><i class="fas fa-user-edit"></i>&emsp;Atualizar dados</a>
    <a class="menuleft" href="altera_senha.php" id="trocarsenha"><i class="fas fa-key"></i>&emsp;Alterar Senha</a>
    <a class="deslogar" href="./logout.php"><i class="fas fa-sign-out-alt"></i>&emsp;Deslogar</a>
  </div>
  <!--barra azul do inicio-->
  <div class="content">
    <div class="barup">&nbsp;</div>
    <!-- nome da página barra cinza-->
    <div class="nomepage">
      <h4>Arquivos Enviados</h4><br>
      <h5>Lista de todos os arquivos que você enviou.</h5>
    </div>
    <div id="divisaorodape">&nbsp;</div>

    <!-- conteúdo da página-->
    <section class="container grid grid-template-columns-3">
      <div class="item subgrid">
        <div>ID</div>
        <div>NOME</div>
        <div>AÇÃO</div>
      </div>
    </section>
    
    <?php
      include("./arquivos_upload/db.php");
      $id_usuario = $_SESSION['id_usuario'];

        $consulta = mysql_query("SELECT arquivo_nome, arquivo_local, id_arquivo, fk_id_usuario FROM arquivos WHERE fk_id_usuario = '$id_usuario' AND fk_id_adm = '0' ");
          if ($resultado = mysql_fetch_array($consulta)){
            do { 
    ?>
      <section class="container grid grid-template-columns-3">
        <div class="item subgrid">
          <div>
          <?php
            echo $resultado["id_arquivo"];
          ?>
          </div>
          <div>

          <?php 
            echo "<a href=\"./arquivos_upload/" . $resultado["arquivo_local"] . $resultado["arquivo_nome"] . "\" style='text-decoration:none; color: inherit'>" . $resultado["arquivo_nome"] . "</a><br />";
          ?>

        </div>

          <div>
          <?php 
            echo "<a class='popupbt' href=\"./arquivos_upload/" . $resultado["arquivo_local"] . $resultado["arquivo_nome"] . "\" style='text-decoration:none; color: inherit'><i class='far fa-eye' style='color:white;'></i></a>";
          ?>
           
          <?php echo "<a href='./arquivos_upload/download.php?file=".$resultado['arquivo_local'] .$resultado['arquivo_nome'] . " ' "; ?><a class="popupbt"><i class="fas fa-download"></i></a> 
          <?php echo "<a href='delete_arquivo_user.php?id=".$resultado['id_arquivo'] . " ' "; ?><a class="popupbt"><i class="fas fa-trash-alt">
          
          </i></a> </div>
        </div>
      </section>

        <?php
          }
          while($resultado = mysql_fetch_array($consulta));
          } 
        ?>

      <div class="final">&nbsp;</div>


    <!-- POP UP-->
    <!--pop up conteúdo enviar arquivos-->
    
    <div id="modal-promocao" class="modal-container">
      <div class="modal">
        <button class="fechar">X</button>
        <h3 class="subtitulo">Enviar Arquivo</h3>
        <div id="divisaorodape" style="opacity: .3;">&nbsp;</div>
        <form name="Form_Upload_Arquivo" action="./arquivos_upload/upload.php" method="post" enctype="multipart/form-data">
          <p><b>Arquivo(NOME DO ARQUIVO NÃO PODE CONTER ESPAÇOS):</b>
            <input type="file" name="Arquivo" /></br></br>
            Somente (jpg, png, pdf, docx, doc, jpeg)</p>
          <br>
          
          <input class="popupbt" value="Enviar" type="submit" style="background-color: red; padding: 2% 2% 2% 2%; border-radius: 5px;" >
        </form>
      </div>
    </div>
    <!--JAVA DO POP UP ENVIAR ARQUIVO-->
    <script>
      function iniciaModal(modalID) {
        const modal = document.getElementById(modalID);
        if (modal) {
          modal.classList.add('mostrar');
          modal.addEventListener('click', (e) => {
            if (e.target.id == modalID || e.target.className == 'fechar') {
              modal.classList.remove('mostrar');
            }
          });
        }
      }
      const logo = document.querySelector('#enviar');
      logo.addEventListener('click', () => iniciaModal('modal-promocao'));
    </script>

    <!-- rodapé-->
    <div id="divisaorodape">&nbsp;</div>

    <div class="voltar-ao-topo">
      <p><a href="#"><button class="button" id="voltar-ao-topo"><i class="fa fa-angle-up"
              aria-hidden="true"></i></button></a></p>
    </div>
    <div class="Copyright">
      <p style="font-size: 0.7em; margin-bottom: -2%;"> &#174 2020 Copyright Todos os direitos reservados AD Prime</p>
    </div>
  </div>
</body>
<!-- final-->

</html>
