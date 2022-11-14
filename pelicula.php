<?php
    include('inc/conexion.inc.php');

    if(!empty($_GET)){
        $peli = getPeliculaById($_GET["id"]);
        
        $id = $peli->id;
        $titulo = $peli->titulo;
        $fecha = $peli->fecha;
        $genero = $peli->genero;
        $caratula = 'https://image.tmdb.org/t/p/w500'.$peli->caratula.'';
        $banner = 'https://image.tmdb.org/t/p/w500'.$peli->banner.'';
        $adultos = $peli->adultos;
        $descripcion = $peli->descripcion;
        $nota = $peli->nota;

    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>RedFlix</title>

    <link rel="icon"
        href="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/120/apple/325/film-frames_1f39e-fe0f.png"
        type="image/x-icon">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
</head>
    <body>
        <?php include('inc/cabecera.inc.php'); ?>

        <?php 
            $fecha_ = explode('-', $fecha)[0];
            //$proveedor = getProveedorPelicula($id, "US");
            

        ?>
        <div class="content pelicula">
        <img class="caratula" src="<?=$caratula??'' ?>">
            <div class="info-peli">
                
                <h2><?=$titulo??'' ?></h2>
                <p><?=$genero??'' ?></p>
                <p><?=$fecha??'' ?></p>
                <p><i class="fa-solid fa-star"></i><?=$nota??'' ?></p>
                <p><?=$descripcion??'' ?></p>

                Más en: 
                <?php $url = str_replace(' ', '-', $titulo); ?>
                <a href="https://www.justwatch.com/es/pelicula/<?=$url??'' ?>" target="_blank">JustWatch</a>

                <?php $url = str_replace(' ', '+', $titulo); ?>
                <a href="https://www.sensacine.com/buscar/?q=<?=$url??'' ?>" target="_blank">SensaCine</a>
            </div>

           

            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=getTrailer($id)??'' ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


            <img src="<?=$banner??'' ?>"/>
        </div>
    </body>
</html>