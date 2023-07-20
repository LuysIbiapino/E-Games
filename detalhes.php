<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Games</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="estilo/style.css">
        <link rel="stylesheet" href="estilo/estilo.css">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">E-Games</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">E-Games</h1>
                    <p class="lead fw-normal text-white-50 mb-0">As Melhores Ofertas de Games Aqui!!</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section>
            <?php
                require_once "includes/banco.php";
                require_once "includes/funcoes.php";
            ?>
            <div id="corpo">
                <?php 
                    if (isset($_GET['cod']) && !empty($_GET['cod'])) {
                        $c = $_GET['cod'];

                        // Utiliza uma declaração preparada para evitar ataques de injeção de SQL
                        $stmt = $banco->prepare("SELECT * FROM jogos WHERE cod = ?");
                        $stmt->bind_param("i", $c);
                        $stmt->execute();
                        $busca = $stmt->get_result();

                        echo "<div id=\"corpo\">";
                    }
                ?>
                <h1>Detalhes do jogo</h1>
                <table class='detalhes'>
                    <?php         
                        if (!$busca) {
                            echo "Busca falhou! " . $banco->error;
                        } else {
                            if ($busca->num_rows != 1) {
                                echo "<tr><td>Nenhum registro encontrado";
                            } else {
                                $reg = $busca->fetch_object();
                                $t= thumb($reg->capa);
                                echo "<tr><td rowspan='3'> <img src='$t' class='full'/>";
                                echo "<td><h2> $reg->nome<h2>";
                                echo "<tr><td><p>$reg->descricao<p>";
                                echo "<tr><td>Adm";
                            }
                        }
                    ?>
                </table>    
            </div>              
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>