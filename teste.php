<section>
            <?php 
                require_once "includes/banco.php";
                require_once "includes/funcoes.php";
            ?>
            <div id="corpo"> 
                <?php 
                    $c = isset($_GET['cod']) ? mysqli_real_escape_string($banco, $_GET['cod']) : 0;
                    $busca = $banco->query("SELECT * FROM jogos WHERE cod='$c'"); 
                ?>
                <h1>Detalhes do jogo</h1>
                <table class='detalhes'>
                    <?php
                        if (!$busca){
                            echo"Busca falhou! $banco->error";
                        } else {
                            if($busca-> num_rows != 1 ){
                                $reg = $busca->fetch_object();  
                                echo"<tr><td rowspan='3'> Foto";
                                echo"<td>Nome do jogo";
                                echo"<tr><td>descrição";
                                echo"<tr><td>Adm";
                            }else{
                                echo"<tr><td>Nenhum registro encontrado";
                            }
                        }
                    ?>
                </table>    
            </div>                    
        </section>


              <?php 
            if (isset($_GET['cod']) && !empty($_GET['cod'])) {
                $c = $_GET['cod'];

                // Utiliza uma declaração preparada para evitar ataques de injeção de SQL
                $stmt = $banco->prepare("SELECT * FROM jogos WHERE cod = ?");
                $stmt->bind_param("i", $c);
                $stmt->execute();
                $busca = $stmt->get_result();

                echo "<div id=\"corpo\">";
                echo "<h1>Detalhes do jogo</h1>";
                echo "<table class='detalhes'>";
                if (!$busca) {
                    echo "Busca falhou! " . $banco->error;
                } else {
                    if ($busca->num_rows != 1) {
                        echo "<tr><td>Nenhum registro encontrado";
                    } else {
                        $reg = $busca->fetch_object();
                        echo "<tr><td rowspan='3'>Foto";
                        echo "<td>Nome do jogo";
                        echo "<tr><td>descrição";
                        echo "<tr><td>Adm";
                    }
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<div id=\"corpo\">";
                echo "<h1>Detalhes do jogo</h1>";
                echo "<table class='detalhes'>";
                echo "<tr><td>Nenhum código de jogo foi fornecido.";
                echo "</table>";
                echo "</div>";
            }
        ?>