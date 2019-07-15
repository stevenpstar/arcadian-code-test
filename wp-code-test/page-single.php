<?php 

/* Template Name: Single Page Template */

get_header();

?>

<div class="landing-page">

    <div class="movie-details-wrapper">
        
        
    </div>

<div class="single-panel">
    <img src="http://klbtheme.com/movify/wp-content/uploads/2018/04/MV5BNDE4OTk4MTk0M15BMl5BanBnXkFtZTgwODQ4MTg0MzI@._V1_SX300-300x444.jpg" id="movie_poster">
    <div class="movie-details">
            <div class="movie-title-genre">
                <div class="movie-title">
                    <h1 id="movie_title">Movie Title</h1>
                </div>
                
                <div class="movie-genre-list">
                    <ul>
                        <li id="movie-length"> 54 min<li>
                        <li id="movie-genres"> Action, Crime, Drama<li>
                        <li id="movie-release"> 10 April 2015 (USA)<li>
                    </ul>
                </div>
                
            </div>

            <div class="movie-btns-rating">
                <div class="movie-btns">
                    <button class="movie-btn" onclick='showTrailer()'>TRAILER</button>
                    <a target="_blank" id="imdb-link" href=""><button class="movie-btn">READ MORE</button></a>
                </div>
            </div>

            <div class="movie-overview" id="movie-overview">
                    
                </div>
            
        </div>

    
</div>

</div>


<div class="movie-trailer hidden" id="movie-trailer-overlay">
    <div class="movie-trailer-wrapper">
    
    <iframe id="movie-trailer" width="560" height="315" src="https://www.youtube.com/embed/vZ734NWnAHA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="movie-trailer-x" onclick='hideTrailer()'>X</div>
    
    </div>
</div>

<div class="loading-overlay" id="loading-overlay">
    <div class="loading-overlay-wrapper">
        <p class="Loading">LOADING</p>
    </div>
</div>
