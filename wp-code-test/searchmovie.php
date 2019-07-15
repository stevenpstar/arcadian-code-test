<?php

    $apikey = '###';

    $name = $_POST['name'];
    
    $response = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key='.$apikey.'&language=en-US&query='.$name.'&page=1&include_adult=false');


    print_r($response); 
?>
