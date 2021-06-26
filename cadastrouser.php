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
         <a class="link" href="inicio/home.php">Voltar ao home</a>  
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
                                <h1>Gestão estoque</h1>
                                <p id="paragrafo">Geramos e administramos seu estoque.</p>
                                <a class="linkar" href="index.php"> Voltar para login</a>
                             </div>                            
                        </section>
                        <hr>
                    </div>
                    <div class="col-md-3">
                                <!-- /.login-logo -->
                              <div class="card">
                                    <div class="card-body login-card-body">
                                    <p class="login-box-msg">Insira os dados para o cadastro</p>

                                    <form action="" method="post">
                                        <div class="input-group mb-3">
                                        <input type="text" name="supermercado" class="form-control" required placeholder="Digite o nome do supermercado">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control" required placeholder="Digite o e-mail do supermercado">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="password" name="senha" id="senha" class="form-control" required placeholder="Digite a senha">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-check" style="margin-bottom:20px;">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                        <label class="form-check-label" for="exampleCheck1">Autorizar cadastro</label>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <button type="submit" name="btn"class="btn btn-primary btn-block">Cadastrar</button>
                                        </div>
                                        <!-- /.col -->
                                        </div>
                                    </form>
                                    <?php
                                            include('config/conexao.php');
                                            if(isset($_POST['btn'])){
                                                $supermercado = $_POST['supermercado'];
                                                $email = $_POST['email'];
                                                $senha = base64_encode( $_POST['senha']);

                                                $inserir ="INSERT INTO tb_user (tb_supermercado, tb_email, tb_senha ) VALUES(:supermercado, :email, :senha)";

                                                try{
                                                $result= $conect->prepare($inserir);
                                                $result->bindParam(':supermercado',$supermercado,PDO::PARAM_STR);
                                                $result->bindParam(':email',$email,PDO::PARAM_STR);
                                                $result->bindParam(':senha',$senha,PDO::PARAM_STR);
                                                $result->execute();
                                                $contar = $result->rowCount();
                                                if($contar >0){
                                                    echo '<div class="container">
                                                            <div class="alert alert-success alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h5><i class="icon fas fa-check"></i> OK!</h5>
                                                                Os dados foram cadastrados com sucesso,
                                                                Agora volte e efetue o login.
                                                            </div>
                                                        </div>';
                                                }else{
                                                    echo'<div class="container">
                                                            <div class="alert alert-warning alert-dismissible">
                                                            <h5><i class="icon fas fa-exclamation-triangle"></i>Erro!</h5>
                                                            Os dados não foram cadastrados.
                                                            </div>
                                                        </div>';
                                                }
                                                }catch(PDOException $e){
                                                echo 'erro de PDO'.$e->getMessage();
                                                }
                                            }
                                            ?>
                                    </div>
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
