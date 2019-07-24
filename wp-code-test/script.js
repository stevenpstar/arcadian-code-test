// Updating
var moviesWatched = JSON.parse(localStorage.getItem("watched_movies"));


window.onload = function() {
    
    var search_bar = document.getElementById("search-bar");
    var movie_trailer_overlay = document.getElementById("movie-trailer-overlay");
    var grid_section = document.getElementById("grid-section");
    const urlParams = new URLSearchParams(window.location.search);
    if (search_bar) {
        search_bar.oninput = function() {
            postToPHP();
        }
    } else if (movie_trailer_overlay) { //we're on a single movie page, get data from DB or API
        getMovie(urlParams.get('movieid'));
    } else if (grid_section) {
        getMovieList();
    }
    
}

function postToPHP() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", thm.templateUrl + "/searchmovie.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            addResults(JSON.parse(this.responseText));
        }
    }

    let name = document.getElementById("search-bar").value;
    if (name != "" && name != undefined && name != null) {
        xmlhttp.send("name=" + name);
    }

}



function getMovie(param) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", thm.templateUrl + "/getmovie.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let loading_overlay = document.getElementById("loading-overlay");
            loading_overlay.classList.add("hide-loading-screen");
            updateMoviePage(JSON.parse(this.responseText));
          
        }
    }
    if (param != null) {
        xmlhttp.send("movieid=" + param);
    } 
}

function getMovieList() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", thm.templateUrl + "/getmovielist.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            updateMovieList(this.responseText);
        }
    }

    xmlhttp.send("watched_movies=" + moviesWatched);
}

function updateMoviePage(response) {

    let movie_poster = document.getElementById("movie_poster");
    if (response.image == "" || response.image == 0) {
        movie_poster.src = 'http://klbtheme.com/movify/wp-content/uploads/2018/04/MV5BNDE4OTk4MTk0M15BMl5BanBnXkFtZTgwODQ4MTg0MzI@._V1_SX300-300x444.jpg';
    } else {
        movie_poster.src = response.image;
    }

    let movie_title = document.getElementById("movie_title");
    movie_title.textContent = response.title;

    let movie_runtime = document.getElementById("movie-length");
    movie_runtime.textContent = response.runtime + " mins";

    let movie_genres = document.getElementById("movie-genres");
    movie_genres.textContent = response.genres;

    let movie_release = document.getElementById("movie-release");
    let split_date = response.releasedate.split('-');
    movie_release.textContent = new Date(split_date[0], split_date[1], split_date[2]).toDateString();

    let movie_overview = document.getElementById("movie-overview");
    movie_overview.textContent = response.overview;

    let movie_trailer = document.getElementById("movie-trailer");
    if (response.video != null && response.video != undefined && response.video != "") {
        movie_trailer.src = 'https://www.youtube.com/embed/' + response.video;
    }

    let imdb_link = document.getElementById('imdb-link');
    if (response.imdb != "") {
        imdb_link.href = "https://www.imdb.com/title/" + response.imdb;
    }
    
}

function updateMovieList(response) {
    let movie_list = document.getElementById("grid-section");
    movie_list.innerHTML = response;
}

function addResults(results) {
    

    let searchResults = document.getElementById("search-results");
    searchResults.innerHTML = "";

    let results_length = 3;

    if (results.length < 3) {
        results_length = results.results.length;
    }

    for (let i=0;i<results_length;i++) {
        searchResults.appendChild(createSearchResult("", results.results[i].title, results.results[i].id));
    }
}

function createSearchResult(image, title, id) {

    let new_result = document.createElement("div");
    new_result.classList.add("search-result");

    let new_link = document.createElement("a");
    new_link.href = "/movie/?movieid=" + id;

    let new_title = document.createElement("h2");
    let new_title_text = document.createTextNode(title);
    new_title.appendChild(new_title_text);
    new_link.appendChild(new_title);
    new_result.appendChild(new_link);


    return new_result;


}

function showTrailer() {
    let overlay = document.getElementById("movie-trailer-overlay");
    overlay.classList.remove("hidden");
}

function hideTrailer() {
    let overlay = document.getElementById("movie-trailer-overlay");
    overlay.classList.add("hidden");
}

function setWatched(id) {
    if (moviesWatched == null) {
        moviesWatched = [];
    }

    moviesWatched.push(id);
    localStorage.setItem("watched_movies", JSON.stringify(moviesWatched));

    let button = document.getElementById(id);
    button.classList.remove("unwatched-movie");
    button.classList.add("watched-movie");
}
