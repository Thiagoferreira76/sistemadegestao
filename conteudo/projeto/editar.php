<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
  <title>Gestão de Estoque</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../css/estilo.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav>
        <section  class="heder">
            <h3 class="linkk">Gestão de Estoque</h3>       
            <a class="link" href="../../inicio/home.php">Home</a>
            <a class="link" href="produtos.php">Produtos</a>
            <a class="link2" href="cadastra.php">Cadastrar produtos</a>
        </section>
    </nav>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <?php
              include('../../config/conexao.php');
              if(!isset($_GET['id'])){
                header('Location: cadastra.php');
                exit;
      
              }
              $id =filter_input(INPUT_GET,'id',FILTER_DEFAULT);

              $select = "SELECT * FROM tb_cadastro WHERE tb_id=:id";
              try{
                $resulta = $conect->prepare($select);
                $resulta->bindParam(':id',$id,PDO::PARAM_INT);
                $resulta->execute();

                $contar = $resulta->rowCount();
                if($contar > 0){
                  while($mostrar = $resulta->FETCH(PDO::FETCH_OBJ)){
                    $idcont = $mostrar->tb_id;
                    $mercado = $mostrar->tb_mercado;
                    $produto = $mostrar->tb_produto;
                    $datar = $mostrar->tb_datar;
                    $quantidade = $mostrar->tb_quantidade;
                    $preco = $mostrar->tb_preco;
                  }
                }else{
                  echo'<div class="alert alert-danger">Não há dados com o id informado!</div>';
                  header("Refresh: 5, editar.php"); 
                }
              }catch(PDOException $e){
                echo "erro de PDO",$e->getMessage();
              }
              ?>
        <div class="row">
          <!-- left column -->
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Alterar dado do produto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome do supermercdo</label>
                    <input type="text" class="form-control" name="mercado" id="mercado" required value="<?php echo $mercado?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Produto</label>
                    <input type="tex" class="form-control"  name="produto" id="produto" required  value="<?php echo $produto?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Data</label>
                    <input type="text" class="form-control"  name="datar" id="datar" required  value="<?php echo $datar?>">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Quantidade</label>
                    <input type="text" class="form-control"  name="quantidade" id="quantidade" required  value="<?php echo $quantidade?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Preço por unidade</label>
                    <input type="text" class="form-control"  name="preco" id="preco" required  value="<?php echo $preco?>">
                  </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="botao" class="btn btn-primary">Alterar</button>
                </div>
              </form>
              <?php
                if(isset($_POST['botao'])){
                  $mercado = $_POST['mercado'];
                  $produto = $_POST['produto'];
                  $datar = $_POST['datar'];
                  $quantidade =$_POST['quantidade'];
                  $preco =$_POST['preco'];
                  $total = $quantidade * $preco;
                 
                  $update ="UPDATE tb_cadastro SET tb_mercado=:mercado, tb_produto=:produto, tb_datar=:datar, tb_quantidade=:quantidade,
                   tb_preco=:preco, tb_total=:total  WHERE tb_id=:id";
    
                    try{
                      $result= $conect->prepare($update);
                      $result->bindParam(':id',$id,PDO::PARAM_INT);
                      $result->bindParam(':mercado',$mercado,PDO::PARAM_STR);
                      $result->bindParam(':produto',$produto,PDO::PARAM_STR);
                      $result->bindParam(':datar',$datar,PDO::PARAM_STR);
                      $result->bindParam(':quantidade',$quantidade,PDO::PARAM_STR);
                      $result->bindParam(':preco',$preco,PDO::PARAM_STR);
                      $result->bindParam(':total',$total,PDO::PARAM_STR);
                      $result->execute();
                      $contar = $result->rowCount();
                      if($contar >0){
                        echo '<div class="container">
                                  <div class="alert alert-success alert-dismissible">
                                  <h5><i class="icon fas fa-check"></i> OK!</h5>
                                    Os dados foram alterados com sucesso.
                                  </div>
                              </div>';
                              header("Refresh: 5, editar.php"); 
                      }else{
                        echo'<div class="container">
                                <div class="alert alert-warning alert-dismissible">
                                <h5><i class="icon fas fa-exclamation-triangle"></i>Erro!</h5>
                                  Os dados não foram alterados.
                                </div>
                             </div>';
                             header("Refresh: 5, editar.php"); 
                      }
                    }catch(PDOException $e){
                      echo 'erro de PDO'.$e->getMessage();
                    }
                }
                 
              ?>
            </div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-3">
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->
  <footer class="rodape">
        <div class="antro">
            <p>Todos os direitos reservados à <b>Gestão de Estoque</b></p>
            <li>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-twitter-square"></i></a>
            </li>
            <a><i class="fas fa-thumbs-up"></i></a>
        </div>
  </footer>
</div>
<!-- ./wrapper -->
</body>
</html>
