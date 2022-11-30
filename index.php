<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Netfilms</title>
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
            <div id="peliculas-populares" class="populares">
            <?php
                $p = getPopularesEstaSemana();
                foreach($p ?? [] as $pelicula){
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

           
           
            <hr>
            <div id="peliculas-populares" class="populares">
            <h2>Peliculas mejor valoradas</h2>
            <br>
            <?php
                $p = getTopRated();
                foreach($p ?? [] as $pelicula){
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

           
        


        <!-- GENEROS -->
        <?php
            $generos = getGeneros();
            foreach ($generos ?? [] as $clave => $valor) {
                foreach ($valor ?? [] as $clave => $v) {       
        ?>

       
        <?php }  } ?>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>

</html>
