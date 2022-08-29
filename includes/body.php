    <div class="painel">
        <form action="index.php" method="POST">
        <button id="gravar" onclick="gravarSucesso()" name="gravar">Gravar</button>
        <button name="ler">Ler</button>
        <br>
        <br>
        </form>

        <form action="index.php" method="POST">
            Nome: <input name="addPessoa" type="text" required>
            <button type="submit">Incluir</button>
        </form>
    </div>
    <main class="container">
        <div class="pessoas">
            <div class="header">
                <h3>Pessoas</h3>
            </div>

            <?php

                use App\Entity\Lista;

                $lista = new Lista;
                $pessoas = $lista->getArrayDados();
                foreach ($pessoas['pessoas'] as $id => $pessoa) :
            ?>

            <div class="cadpessoa">
                <div class="nomepessoa"><?php echo $pessoa['nome'] ?></div> 
                <div class="rpessoa">
                    <form action="index.php" method="POST">
                        <button class="btn" name="deletePessoa" value="<?php echo $id ?>" >Remover</button>
                    </form>
                </div>    
            </div>
            <?php foreach($pessoa['filhos'] as $keyf => $filho){ ?>
            <div class="cadfilho">
                <div class="nomefilho">- <?php echo $filho ?></div>
                <div class="rfilho">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="idPai" value="<?php echo $id ?>">
                        <input type="hidden" name="deleteFilho" value="<?php echo $keyf ?>">
                        <button class="btn" type="submit">Remover Filho</button>
                    </form>
                </div>
            </div>

            <?php } ?>

            <div class="footer">
                <form action="index.php"  method="post" >
                    <input type="hidden" name="idPai" value="<?php echo $id ?>">
                    <input id="<?php echo $id ?>" name="nomeFilho" type="hidden" value="">
                    <button onclick="addFilho(<?php echo $id ?>)" type="submit">Adicionar Filho</button>
                </form>
            </div>

            <?php endforeach; ?>

        </div>
        <div class="display">
        <textarea class="json-area" method="POST" id="json-area" cols="100" rows="40"><?php print_r($lista->getJson()) ?></textarea>
        </div>
    </main>
    <script src="scripts/main.js"></script>
</body>
</html>