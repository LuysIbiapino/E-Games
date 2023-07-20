<?php 
    $banco = new mysqli("localhost", "root", "", "db_games" );

    if($banco-> connect_errno){
        echo"<p>Encontrei um erro $banco->errno --> $banco->connect_error<p>";
        die();
    }
    $busca =$banco->query("select *from generos");


?>
