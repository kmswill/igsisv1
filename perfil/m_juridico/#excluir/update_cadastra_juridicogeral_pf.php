<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link0=$http."rlt_despacho_padrao_pf.php";
 
 
$processo=$_POST['NumeroProcesso'];
$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE= $_POST['DataEmissaoNotaEmpenho'];
$entregaNE= $_POST['DataEntregaNotaEmpenho'];
$idUsuario = $_SESSION['idUsuario'];
$id_ped=$_GET['id_ped'];
 
$update = "UPDATE igsis_pedido_contratacao
                                               SET
                                               NumeroProcesso = '$processo',
                                               NumeroNotaEmpenho = '$numeroNE',
                                               DataEmissaoNotaEmpenho = '$emissaoNE',
                                               DataEntregaNotaEmpenho = '$entregaNE',
                                               idAssinatura = '$assinatura'
                                               WHERE IdPedidoContratacao = '$id_ped' ";
 
$stmt = mysqli_prepare($conexao,$update);
 
if(mysqli_stmt_execute($stmt))
{
               echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
                $last_id = mysqli_insert_id($conexao);
                echo "<br><br><h6>Qual modelo de documento deseja imprimir?</h6><br>
                               <div class='row'>
                <div class='col-md-offset-1 col-md-10'>
               
                <form class='form-horizontal' role='form'>
                                              
                <div class='form-group'>
     <div class='col-md-offset-2 col-md-8'>
                               <a href='$link0?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Relatório Despacho Padrão</a></div>
                </div>
               
                <br/>
                 
               
                 <br /></center>";
 
}
?>