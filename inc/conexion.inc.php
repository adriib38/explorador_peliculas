<?php


    require_once('inc/Pelicula.inc.php');

    function peticion($url){
        //TMDB API KEY 
        $apiKey = 'TU-TMDB-API-KEY ';
        $url = str_replace('API_KEY', $apiKey, $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }
   

    function getPeliculasPopulares(){
        $peliculas = peticion('https://api.themoviedb.org/3/movie/popular?api_key=API_KEY&language=es&page=1');
        $p = json_decode($peliculas, false);
       
        $pelicul = $p->results;
   
        $respuesta = array();
        foreach($pelicul ?? [] as $pelicula){
            $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);

            $fecha = date("d-m-Y", strtotime($pelicula->release_date));

            $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
            array_push($respuesta, $peli);
        }
        
        return $respuesta;
        
    }
      
    function getPeliculaByName($name){
        $peliculas = peticion('https://api.themoviedb.org/3/search/movie?api_key=API_KEY&language=es&query='.$name.'&page=1&include_adult=true');
        $p = json_decode($peliculas, false);
       
        $pelicula = $p->results;
        
        $respuesta = array();
        
        $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);
        $fecha = date("d-m-Y", strtotime($pelicula->release_date));

        $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
        return $peli;
    }

    function getPeliculaById($id){    
        $r = peticion('https://api.themoviedb.org/3/movie/'.$id.'?api_key=API_KEY&language=es');
        $pelicula = json_decode($r, false);
       
        $respuesta = array();
        
        $generoAux = $pelicula->genres[0]->name;
        $fecha = date("d-m-Y", strtotime($pelicula->release_date));  
        
        $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
        return $peli;
    }

   
    function getPeliculasByGenero($genero){
        $generos = getGeneros();

        $url = 'https://api.themoviedb.org/3/discover/movie?api_key=API_KEY&with_genres='.$genero.'&language=es';
        $peliculas = peticion($url);
        $p = json_decode($peliculas, false);

        $pelicul = $p->results;
        
        $respuesta = array();
        foreach($pelicul ?? [] as $pelicula){
            $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);
            $fecha = date("d-m-Y", strtotime($pelicula->release_date));  

            $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
            array_push($respuesta, $peli);
        }

        return $respuesta;
    }

 // GET GENEROS
    function getGeneros(){
         $json = file_get_contents('generos.json');
        $json_data = json_decode($json, true);
     
        return $json_data;
    }
    
    
    
    function getPopularesEstaSemana(){
        $generos = getGeneros();

        $url = 'https://api.themoviedb.org/3/trending/movie/week?api_key=API_KEY&lenguage=es';
        $peliculas = peticion($url);
        $p = json_decode($peliculas, false);

        $pelicul = $p->results;
        
        $respuesta = array();
        foreach($pelicul ?? [] as $pelicula){
            $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);
            $fecha = date("d-m-Y", strtotime($pelicula->release_date));  

            $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
            array_push($respuesta, $peli);
        }

        return $respuesta;
    }

    //VA MAL
    function getProveedorPelicula($id, $pais){
        $respuesta = peticion('https://api.themoviedb.org/3/movie/'.$id.'/watch/providers?api_key=API_KEY');
        $pf = json_decode($respuesta, false);

        try{
            $proveedor1 = $pf->results->$pais->flatrate[0];

            return $proveedor1;
        }catch(Exception $e){
            echo 'GOLA';
        }
        return null;
    }

    function getTopRated(){
        $respuesta = peticion("https://api.themoviedb.org/3/movie/top_rated?api_key=API_KEY&language=es&page=1");

        $pf = json_decode($respuesta, false);

        $pelicul = $pf->results;
        
        $respuesta = array();
        foreach($pelicul ?? [] as $pelicula){
            $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);
            $fecha = date("d-m-Y", strtotime($pelicula->release_date));  

            $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
            array_push($respuesta, $peli);
        }

        return $respuesta;
    }

    function getProximamentePeliculas(){
        $respuesta = peticion('https://api.themoviedb.org/3/movie/upcoming?api_key=API_KEY&language=es&page=1$region=es');

        $pf = json_decode($respuesta, false);

        $pelicul = $pf->results;
        
        $respuesta = array();
        foreach($pelicul ?? [] as $pelicula){
            $generoAux = getGeneroByIdGenero($pelicula->genre_ids[0]);
            $fecha = date("d-m-Y", strtotime($pelicula->release_date));  

            $peli = new Pelicula($pelicula->id, $pelicula->title, $generoAux, $pelicula->poster_path, $pelicula->backdrop_path, $fecha, $pelicula->adult, $pelicula->overview, $pelicula->vote_average);
            array_push($respuesta, $peli);
        }

        return $respuesta;
    }

    function getGeneroByIdGenero($id){
        $json = file_get_contents('generos.json');
        $json_data = json_decode($json, true);

        for ($i=0; $i < count($json_data['genres']); $i++) { 
            $r = $json_data['genres'][$i];
            if($r['id'] == $id){
                return $r['name'];
            }
        }
        return 'none';
        
    }

    function getTrailer($id){
        $resultado = peticion('https://api.themoviedb.org/3/movie/'.$id.'/videos?api_key=API_KEY&language=es');

        $r = json_decode($resultado, true);

        $a = $r["results"][0]["key"];
        return $a;
    }

   

?>