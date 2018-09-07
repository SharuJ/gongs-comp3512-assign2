<?php
    
    // dashboard does not require sign in
    //include "includes/checkSession.php"; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> </head>

<body>

    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
        mdl-layout--fixed-header" id="midnightBlue">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section id="cards" class="page-content">
                <div class="mdl-grid">
                    <!-- Square cards -->
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div id="uni" class="mdl-card__title mdl-card--expand"> </div>
                        <div class="mdl-card__supporting-text"> This page displays a list of university names sorted by title. </div>
                        <div class="mdl-card__actions mdl-card--border"> <a href="browse-universities.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                              Browse Universities
                            </a> </div>
                    </div>
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div id="boks" class="mdl-card__title mdl-card--expand"> </div>
                        <div class="mdl-card__supporting-text"> This page displays a list of multiple books sorted by the title. </div>
                        <div class="mdl-card__actions mdl-card--border"> <a href="browse-books.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                              Browse Books
                            </a> </div>
                    </div>
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div id="emps" class="mdl-card__title mdl-card--expand"> </div>
                        <div class="mdl-card__supporting-text"> This page displays a list of employees as a list of links. </div>
                        <div class="mdl-card__actions mdl-card--border"> <a href="browse-employees.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                              Browse Employees
                            </a> </div>
                    </div>
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div id="aboot" class="mdl-card__title mdl-card--expand"> </div>
                        <div class="mdl-card__supporting-text"> This page displays about the site, link to Github, group members' names and sources. </div>
                        <div class="mdl-card__actions mdl-card--border"> <a href="aboutus.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                              About
                            </a> </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <!-- / mdl-layout -->
</body>

</html>