
<?php

require __DIR__.'/vendor/autoload.php';

require '/app/Entity/helpers.php';

use \App\Entity\Pessoa;
use \App\Entity\Lista;
use \App\BD\bd;

$R = $_SERVER['REQUEST_METHOD'];

if( $R == 'POST') {
    $pessoa = New Pessoa;
    $lista = new Lista;
    $bd = new bd;


    //adicionando pessoas e resetando o json
    if(isset($_POST['addPessoa'])) {
        $nome = $_POST['addPessoa'];
        $pessoa->addPessoa($nome);
    } 

    //removepessoa
    if (isset($_POST['deletePessoa'])) {
        $id = $_POST['deletePessoa'];
        $pessoa->deletepessoa($id);
    }

    //adiciona filho
    if(isset($_POST['nomeFilho'])) {
        $nomefilho = $_POST['nomeFilho'];
        $idpai = $_POST['idPai'];
        $pessoa->addfilho($idpai, $nomefilho);
    } 

    //remove filho

    if(isset($_POST['deleteFilho'])){
        $idpai = $_POST['idPai'];
        $idfilho = $_POST['deleteFilho'];
        $pessoa->deleteFilho($idpai, $idfilho);
    }

    if(isset($_POST['gravar'])){
        $bd->gravar($lista->getJson());
    }

    if(isset($_POST['ler'])){
        $bd->ler();
    }

} else {
    $lista = new Lista;
    $lista->resetJson();
}
    //

include '\includes\topo.php';
include '\includes\body.php';

?>


