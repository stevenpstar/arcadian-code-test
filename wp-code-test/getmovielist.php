<?php

require_once('../../../wp-config.php');

global $wpdb;

$watched_movies = $_POST['watched_movies'];

//$wm = json_decode($watched_movies);

$results = $wpdb->get_results("
SELECT * FROM wp_movies LIMIT 6
");

if (sizeof($results) > 0) {

    foreach ($results as $res) {
        $id = $res->movieid;
        $image = $res->image;
        $title = $res->title;
        $genres = $res->genres;
        $overview = $res->overview;

        

        if (is_array(json_decode('['.$watched_movies.']', true))) {
            if (in_array($id, json_decode('['.$watched_movies.']', true))) {
                $watched = "watched-movie";
                
            } else {
                $watched = "unwatched-movie";
            }
        } else {
            print_r(json_decode('['.$watched_movies.']', true));
            $watched = "unwatched-movie";
        }

        

        echo "<div class='grid-container'>
        <div class='grid-image'>
            <img id='grid-image' src='{$image}'>
        </div>
        <div class='grid-panel'>
            <div class='grid-panel-wrapper'>
                <h2 id='grid-movie-title'>{$title}</h2>
                <div class='rating-genre-section'>
                    <div class='rating'><span>6.7/10</span></div>
                    <div class='genres'>{$genres}</div>
                </div>
                <div class='description'>
                    <p>
                        {$overview}
                    </p>
                </div>
                <a class='details-btn' href='/wp/movie/?movieid={$id}'<button class='details-btn'>DETAILS</button></a>
                <button class='{$watched}' id='{$id}' onclick='setWatched({$id})'>WATCHED</button>
            </div>
        </div>
    </div>"; 

    }
    //print_r(json_encode($results));

} 


?>