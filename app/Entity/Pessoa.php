<?php

namespace App\Entity;

use \App\Entity\Lista;

class Pessoa {

    
    public function addPessoa($nome) {
        $lista = new Lista;
        $obj = $lista->getArrayDados();
    
        //laço responsavel por verificar se o nome ja existe no banco.
        foreach( $obj['pessoas'] as $id => $pessoa) {
            
            if ($pessoa['nome'] == $nome) {
                return false;
            } 
        }
    
        $obj['pessoas'][] = ['nome' => $nome , 'filhos' => []]; 
        $lista->updateJson($obj);
    
        return true;
    
    }
    
    public function addFilho($id, $nome) {

        $lista = new Lista;
        $obj = $lista->getArrayDados();
    
        //verifica se o nome esta vazio 
        if ($nome == '') {
    
            return false;
        }
        //laço responsavel por verificar se o nome ja existe no banco.
        foreach ($obj['pessoas'][$id]['filhos'] as $idfilho => $filho ) {
            if ($nome == $filho ) {
    
                return false;
            }
        }
        
        $obj['pessoas'][$id]['filhos'][] = $nome; 
        $lista->updateJson($obj);
    
        return true;
    }

    public function deletepessoa ($id) {
        $lista = new Lista;

        $obj = $lista->getArrayDados();
    
        unset($obj['pessoas'][$id]);
        

        $lista->updateJson($obj);
    
        return true;
    }

    public function deleteFilho ($idpai, $idfilho ) {
        $lista = new Lista;
        $obj = $lista->getArrayDados();
    
        unset($obj['pessoas'][$idpai]['filhos'][$idfilho]);
    
        $lista->updateJson($obj);
        
        return true;
        
    }

}
