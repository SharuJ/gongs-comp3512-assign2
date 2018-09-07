<?php

include "includes/checkSession.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> </head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section class="page-content">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--3-col  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="lightGrayish">
                            <h2 class="mdl-card__title-text">About this Site</h2> </div>
                        <div class="mdl-card__supporting-text"> This is a hypothetical site created as an assignmennt for COMP 3512 at Mount Royal University taught by Randy Connolly. </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedBlue">
                            <h2 class="mdl-card__title-text">Link to GitHub</h2> </div>
                        <div class="mdl-card__supporting-text">Click <a href="https://github.com/SharuJ/gongs-comp3512-assign2"> here </a> to view our GitHub page</div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedPink">
                            <h2 class="mdl-card__title-text">Group Members</h2> </div>
                        <div class="mdl-card__supporting-text"> <b>Sharunitha Jaisankar</b><br>(worked on everything)</div>
                        <div class="mdl-card__supporting-text"> <b>Stephen Johnson</b><br>(worked on everything)</div>
                        <div class="mdl-card__supporting-text"> <b>Yasaswani Sai Polasu</b><br>(worked on everything)</div> 
                    </div>
                    <div class="mdl-cell mdl-cell--3-col  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="lightPeriwinkle">
                            <h2 class="mdl-card__title-text">Sources</h2> </div>
                        <div class="mdl-card__supporting-text"> <b>Icons sourced from:<br> <a href="https://material.io/icons">https://material.io/icons</a><br>
                        <br>Book covers sourced from:<br> <a href="https://images-na.ssl-images-amazon.com/images/I/619-JrSIOeL._UX250_.jpg">Randy Connolly</a><br>
                        <br>Profile image sourced from:<br> <a href="https://www.youtube.com/user/mlgHwnT/">Sugar Pine 7</a></b>
                            <br>
                            <br><b>Color scheme and login background mural sourced from:<br></b> <a href="http://www.imdb.com/name/nm0027572/">Wes Anderson's</a> <a href="http://www.imdb.com/title/tt2278388/"><i>The Grand Budapest Hotel</i></a> </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>