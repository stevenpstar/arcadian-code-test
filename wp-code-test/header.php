<?php

/* Wordpress Header Template */

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <?php wp_head(); ?>
    </head>

    <body>

    <header class="header">
            <div class="vertical-align">
                <p class="header-title">MM</p>
            </div>
            
            <nav class="main-navigation light-text">
                <?php wp_nav_menu( $arg = array (
                   'menu_class' => 'navigation-wrapper',
                   'theme_location' => 'primary'
               )); 
               ?>   
            </nav>

        </header>


