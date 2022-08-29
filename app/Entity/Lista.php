<?php

namespace App\Entity;

use \App\Entity\Pessoa;

class Lista {

    public function updateJson($obj) {

        file_put_contents(__DIR__.'../../../dados.json', json_encode($obj, JSON_PRETTY_PRINT));
    
        return true;
    }
    
    public function resetJson() {

        $dados = [
            'pessoas' => []
        ];
    
        $this->updateJson($dados);
    
        return true;
    }

    public function getJson () {
        $dados = json_decode(file_get_contents(__DIR__.'../../../dados.json'), true);
    
        $json = json_encode($dados, JSON_PRETTY_PRINT);
    
        return $json;
    }

    public function getArrayDados () {
        $pessoas = json_decode(file_get_contents(__DIR__.'../../../dados.json'), true);
        
        return $pessoas;
    }
}