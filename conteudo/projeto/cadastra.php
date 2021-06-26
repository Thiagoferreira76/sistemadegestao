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

  <link rel="stylesheet" href="../../css/modelo.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav>
        <section  class="heder">
            <h3 class="linkk">Gestão de Estoque</h3>       
            <a class="link" href="../../inicio/home.php">Home</a>
            <a class="link" href="produtos.php">Produtos</a>
            <a class="link2" href="#">Cadastrar produtos</a>
        </section>
    </nav>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-1"></div>
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title">Cadastre seu produto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body" style="height: 500px;">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome do supermercdo</label>
                    <input type="text" class="form-control" name="mercado" id="mercado" required placeholder="Digite o nome do supermercado">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Produto</label>
                    <input type="tex" class="form-control"  name="produto" id="produto" required placeholder="Digite o nome do produto">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Data de validade</label>
                    <input type="text" class="form-control"  name="datar" id="datar" required placeholder="00/00/0000">
                  </div> <div class="form-group">
                    <label for="exampleInputPassword1">Quantidade</label>
                    <input type="text" class="form-control"  name="quantidade" id="quantidade" required placeholder="Digite a quantidade do produto">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Preço por unidade</label>
                    <input type="text" class="form-control"  name="preco" id="preco" required placeholder="Digite o preço do produto">
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">Autorizar cadastro</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btn" class="btn btn-primary">Cadastrar</button>
                </div>
              </form>
              <?php
              include('../../config/conexao.php');
              if(isset($_POST['btn'])){
                $mercado = $_POST['mercado'];
                $produto = $_POST['produto'];
                $datar = $_POST['datar'];
                  $resultado = explode('/',$datar);
                  $diac = $resultado[0];
                  $mesc = $resultado[1];
                  $anoc = $resultado[2];
                $datar = $anoc.'/'.$mesc.'/'.$diac;  
                $quantidade =$_POST['quantidade'];
                $preco = $_POST['preco'];
                $total = $quantidade * $preco;

                $inserir ="INSERT INTO tb_cadastro (tb_mercado, tb_produto, tb_datar, tb_quantidade, tb_preco, tb_total )
                VALUES(:mercado, :produto, :datar, :quantidade, :preco, :total)";

                try{
                  $result= $conect->prepare($inserir);
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
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>          
                              <h5><i class="icon fas fa-check"></i> OK!</h5>
                                Os dados foram enviados com sucesso.
                              </div>
                          </div>';
                          header("Refresh: 5, cadastra.php"); 
                  }else{
                    echo'<div class="container">
                            <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>        
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Erro!</h5>
                              Os dados não foram cadastrados.
                            </div>
                         </div>';
                         header("Refresh: 5, cadastra.php"); 
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
          <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tabela de Dados</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 500px;">
                     <div class="input-group-append">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 563px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>supermercado</th>
                      <th>Produto</th>
                      <th>Data de validade</th>
                      <th style="width: 40px">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     $select = "SELECT * FROM tb_cadastro ORDER BY tb_id DESC LIMIT 7";
                     try{
                      $result = $conect->prepare($select);
                      $cont =1;
                      $result->execute();

                      $contar = $result->rowCount();
                      if($contar > 0){
                        while($mostrar = $result->FETCH(PDO::FETCH_OBJ)){

                    ?>
                    <tr>
                      <td><?php echo $cont++; ?></td>
                      <td><?php echo $mostrar->tb_mercado;?></td>
                      <td><?php echo $mostrar->tb_produto;?></td>
                      <td><?php echo $mostrar->tb_datar;?></td>
                      <td>
                        <div class="btn-group">
                          <a href="del.php?idDel=<?php echo $mostrar->tb_id;?>" onclick="return confirm('Deseja realmente deletar esses dados')" title="deletar dados" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          <a href="editar.php?id=<?php echo $mostrar->tb_id;?>" title="Editar dados" class="btn btn-success"><i class="far fa-edit"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php
                     }
                    }else{

                    }
                   }catch(PDOException $e){
                    echo "Erro de PDO".$e->getMessage();
                   }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
          </div>
          <!--/.col (right) -->
          <div class="col-md-1"></div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
