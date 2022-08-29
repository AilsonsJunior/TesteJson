<?php

namespace App\BD;

use mysqli;
use PDO;
use PDOException;
use App\Entity\Pessoa;
use App\Entity\Lista;


class bd {

    //informações para que a classe consiga acessar o banco 

    const host ="localhost";
    const port=3306;
    const socket="";
    const user="root";
    const password="";
    const database="teste_turim";

    
    public function conectar () {
        try {
        $pdo = new PDO ('mysql:dbname='.self::database.';host='.self::host , self::user, self::password);
        return $pdo;
        } catch (PDOException $e) {
            echo 'Erro no banco de dados: ' .$e->getMessage();
        }
    }

    public function gravar ($json) {
        $objgravar = json_decode($json , true);
        $connection = $this->conectar();
        $connection->query("TRUNCATE TABLE pessoa");
        $connection->query("TRUNCATE TABLE filho");

        foreach ($objgravar['pessoas'] as $id => $pessoa ) {
            $connection->query("INSERT INTO pessoa(nome) values('".$pessoa['nome']."')");
            foreach($pessoa['filhos'] as $idfilho => $nomefilho) {
                $connection->query("INSERT INTO filho(pessoa_id, nome) values('".($id+1)."','".$nomefilho."')");
            }
        }
        return true;
    }

    public function ler() {
        $connection = $this->conectar();
        
        $objpessoa = $connection->query("SELECT * FROM pessoa ORDER BY id")->fetchAll(PDO::FETCH_CLASS, self::class);

        $pessoac = new Pessoa;

        foreach ($objpessoa as $pessoa) {
            $pessoac->addPessoa($pessoa->nome);
            $objfilho = $connection->query("SELECT * FROM filho Where pessoa_id = $pessoa->id")->fetchAll(PDO::FETCH_CLASS, self::class);;

            foreach ($objfilho as $filho) {
                $pessoac->addFilho((($filho->pessoa_id)-1) ,$filho->nome);
            }
        }        
    }
}



