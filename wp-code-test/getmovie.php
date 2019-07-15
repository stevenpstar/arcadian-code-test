<?php

require_once('../../../wp-config.php');

global $wpdb;

$movieid = $_POST['movieid'];

$mid = (int)$movieid;

$results = $wpdb->get_results("
SELECT * FROM wp_movies WHERE movieid = {$mid}
");

if (sizeof($results) > 0) {

    print_r(json_encode($results[0]));

} else {


    $apikey = '###';
    $response = file_get_contents('https://api.themoviedb.org/3/movie/'.$movieid.'?api_key='.$apikey.'&language=en-US');
    
    $res_dec = json_decode($response, true);

    //getting trailer

    $vid_response = file_get_contents('https://api.themoviedb.org/3/movie/'.$movieid.'/videos?api_key='.$apikey.'&language=en-US');

    $concat_genres = "";

    foreach ($res_dec['genres'] as $genre) {
        if ($concat_genres == "") {
            $concat_genres = $concat_genres . ' ' . $genre['name'];
        } else {
            $concat_genres = $concat_genres . ', ' . $genre['name'];
        }
        
    }

    $vr = json_decode($vid_response, true);

    $wpdb->query($wpdb->prepare(
        "
            INSERT INTO wp_movies 
            (movieid, image, title, runtime, genres, releasedate, video, imdb, overview)
            VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s)
        ",
        $movieid,
        'http://image.tmdb.org/t/p/w185' . $res_dec['poster_path'],
        $res_dec['original_title'],
        $res_dec['runtime'],
        $concat_genres,
        $res_dec['release_date'],
        $vr['results'][0]['key'],
        $res_dec['imdb_id'],
        $res_dec['overview']
    )); 


    $arr_res = array (
        "movieid" => $movieid,
        "image" => 'http://image.tmdb.org/t/p/w185' . $res_dec['poster_path'],
        "title" => $res_dec['original_title'],
        "runtime" => $res_dec['runtime'],
        "genres" => $concat_genres,
        "releasedate" => $res_dec['release_date'],
        "video" => $vr['results'][0]['key'],
        "imdb" => $res_dec['imdb_id'],
        "overview" => $res_dec['overview']
    ); 


    echo (json_encode($arr_res)); 

    //print_r($res_dec);
}


?>