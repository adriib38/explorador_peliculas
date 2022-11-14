<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>REDFLIX</title>
    <link rel="icon"
        href="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/120/apple/325/film-frames_1f39e-fe0f.png"
        type="image/x-icon">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
</head>
<body>
    <?php
        include('inc/cabecera.inc.php');
        include('inc/conexion.inc.php');
        //print_r(getPopularesEstaSemana());
    ?>
    
    <div class="content">
        <!-- PELICULAS POPULARES -->
        
            <h2>Peliculas populares esta semana</h2>
            <hr>
            <div class="populares">
                <?php
                    $p = getPeliculasPopulares();
                    foreach($p as $pelicula){
                        $img = 'https://image.tmdb.org/t/p/w500'.$pelicula->caratula.'';
                ?>        
                    <div class="card">
                        <img class="caratula" src="<?=$img??'' ?>" alt="<?=$pelicula->titulo??'' ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?=$pelicula->titulo??'' ?></h5>
                            <p><?=$pelicula->genero??'' ?>
                            <p><?=$pelicula->fecha??'' ?></p>
                        </div>
                
                        <div class="card-body">
                            <a href="pelicula.php?id=<?=$pelicula->id??'' ?>" class="card-link">Ver más</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <h2>Peliculas mejor valoradas</h2>
            <hr>
            <div class="populares">
                <?php
                    $p = getTopRated();
                    foreach($p as $pelicula){
                        $img = 'https://image.tmdb.org/t/p/w500'.$pelicula->caratula.'';
                ?>        
                    <div class="card">
                        <img class="caratula" src="<?=$img??'' ?>" alt="<?=$pelicula->titulo??'' ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?=$pelicula->titulo??'' ?></h5>
                            <p><?=$pelicula->genero??'' ?>
                            <p><?=$pelicula->fecha??'' ?></p>
                        </div>
                
                        <div class="card-body">
                            <a href="pelicula.php?id=<?=$pelicula->id??'' ?>" class="card-link">Ver más</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>
