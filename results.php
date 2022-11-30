<?php
    require_once('inc/conexion.inc.php');
    require_once('inc/cabecera.inc.php');
    require_once('inc/Pelicula.inc.php');

    if(!empty($_GET)){
        if(!empty($_GET['titulo'])){
            $peliABuscar = $_GET['titulo'];

            $resultados = peticion('https://api.themoviedb.org/3/search/movie?api_key=c256f4b9b1e5fd9e15fdb3c7cf116601&language=es&query='.$_GET['titulo'].'&page=1&require_once_adult=true');
            $p = json_decode($resultados, false);

            $peliculas = $p->results;

            $respuesta = array();
            foreach($peliculas ?? [] as $pelicula){
                $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);
            
                $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $pelicula->release_date, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
                array_push($respuesta, $peli);
            }
        }

        if(isset($_GET['genero'])){
            $genero = getGeneroByIdGenero($_GET['genero']);
            $respuesta = getPeliculasByGenero($_GET['genero']);
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>

    <link rel="icon"
        href="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/120/apple/325/film-frames_1f39e-fe0f.png"
        type="image/x-icon">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <div class="content">  
            <h2><?=$genero??'' ?></h2>
            <hr>
            <div class="results">
                <?php foreach($respuesta ?? [] as $peli){
                    $img = 'https://image.tmdb.org/t/p/w500'.$peli->caratula.'';
                ?>
                    <div class="card">
                        <img class="caratula" src="<?=$img??'' ?>" alt="<?=$peli->titulo??'' ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?=$peli->titulo??'' ?></h5>
                            <p><?=$peli->fecha??'' ?></p>
                            <p><?=$peli->genero??'' ?></p>
                            
                        </div>
                        <div class="card-body">
                            <a href="pelicula.php?id=<?=$peli->id??'' ?>" class="card-link">Ver más</a>
                        </div>
                    </div>  
                <?php }?>
            </div>
        </div>
    </body>
</html>
