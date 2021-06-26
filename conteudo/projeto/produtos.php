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
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav>
        <section  class="heder">
            <h3 class="linkk">Gestão de Estoque</h3>       
            <a class="link" href="../../inicio/home.php">Home</a>
            <a class="link" href="#">Produtos</a>
            <a class="link2" href="cadastra.php">Cadastrar produtos</a>
        </section>
    </nav>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tabela dos produtos</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 500px;">
                     <div class="input-group-append">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 470px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead action="" method="post">
                    <tr>
                      <th>#</th>
                      <th>supermercado</th>
                      <th>Produto</th>
                      <th>Data de validade</th>
                      <th>Quantidade</th>
                      <th>Preço unitario</th>
                      <th>Preço Total</th>
                      <th style="width: 40px">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include('../../config/conexao.php');
                     $select = "SELECT * FROM tb_cadastro ORDER BY tb_id";
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
                      <td><?php echo $mostrar->tb_quantidade;?></td>
                      <td><?php echo $mostrar->tb_preco;?></td>
                      <td><?php echo $mostrar->tb_total; ?>
                      </td>
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
         </div>
      </div>    
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
