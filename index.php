<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <title>Gestão de Estoque</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="css/modelar.css">
</head>
<body>
<div class="wrapper">
    <nav>
      <section  class="heder">
         <h3 class="linkk">Gestão de Estoque</h3>       
         <a class="link" href="inicio/home.php">Home</a>  
      </section>
    </nav>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <!-- left column -->
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <section>
                             <div>
                                <h1>Gestão Estoque</h1>
                                <p id="paragrafo">Geramos e administramos seu estoque.</p>
                                <a class="linkar" href="cadastrouser.php"> Cadastrar Usuário</a>
                             </div>                            
                        </section>
                        <hr>
                    </div>
                    <div class="col-md-3">
                                <!-- /.login-logo -->
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg">Para acessar insirar o login</p>

                                    <form action="" method="post">
                                        <div class="input-group mb-3">
                                        <input type="email" class="form-control" name="email" id="email" required placeholder="Digite o e-mail">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="senha" id="senha" required placeholder="Digite a senha">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <button type="submit" name="login" class="btn btn-primary btn-block">Acessar</button>
                                        </div>
                                        <!-- /.col -->
                                        </div>
                                    </form>
                                    <?php
                                        include_once('config/conexao.php');
                                        if(isset($_POST['login'])){
                                            $login = filter_input(INPUT_POST,'email',FILTER_DEFAULT);
                                            $senha = base64_encode(filter_input(INPUT_POST,'senha',FILTER_DEFAULT));
                                            $select = "SELECT * FROM tb_user WHERE tb_email=:emailLogin AND tb_senha=:senhaLogin";

                                            try{
                                                $resultlogin = $conect->prepare($select);
                                                $resultlogin -> bindParam(':emailLogin',$login, PDO::PARAM_STR);
                                                $resultlogin -> bindParam(':senhaLogin',$senha, PDO::PARAM_STR);
                                                $resultlogin->execute();

                                                $verificar =$resultlogin->rowCount();
                                                if($verificar>0){
                                                    $login = $_POST['email'];
                                                    $senha = $_POST['senha'];
                                                    //criar seção
                                                    $_SESSION['loginUser'] = $login;
                                                    $_SESSION['senhaUser'] = $senha;
                                                    echo'<div class="alert alert-success">
                                                    <strong>ok!</strong> você foi logado com sucesso:</div>';
                                                    header("Refresh: 3, inicio/home.php");
                                                }else{
                                                    echo'<div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                    <strong>ERRO!</strong> Login ou senha incorretos,
                                                    </div>';
                                                }
                                            }catch(PDOException $e){
                                                echo'Erro de LOGIN DO PDO :'.$e->getMessage();
                                            }
                                        }
                                    ?>
                                    <!-- /.login-card-body -->
                                </div>
                            </div>
                                <!-- /.login-box -->

                                <!-- jQuery -->
                                <script src="plugins/jquery/jquery.min.js"></script>
                                <!-- Bootstrap 4 -->
                                <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                                <!-- AdminLTE App -->
                                <script src="dist/js/adminlte.min.js"></script>
                    </div>
                    <div class="col-md-1"> </div>
                    <!--/.col (right) -->
            </div>
                    <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
                                



</div>
<!-- ./wrapper -->
</body>
</html>
