<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link0=$http."rlt_despacho_padrao_pj.php";
 
$processo=$_POST['NumeroProcesso'];
$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE= $_POST['DataEmissaoNotaEmpenho'];
$entregaNE= $_POST['DataEntregaNotaEmpenho'];
$assinatura = $_POST['Id_Assinatura'];
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
                               <a href='$link0?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Contratação</a></div>
                </div>
               
                <br/>
                 
                <div class='form-group'>
                <div class='col-md-offset-2 col-md-6'>
                               <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Padrão</a></div>
                <div class='col-md-6'>
                               <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Artístico</a></div>
                </div>
               
                <div class='form-group'>
                <div class='col-md-offset-2 col-md-6'>  
                               <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Comunicado</a></div>
                <div class='col-md-6'>
                               <a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a></div>
                </div>
               
               
   
    </form>
    </div></div>
               
                 <br /></center>";
 
}
?>