<?php

    include "includes/checkSession.php";
    
    function listName() /* programmatically loop though universities and display each university as <li> element. */ 
    {
        include "includes/config.php";
        $stateDb = new StateGateway($connection);
        $uniDb = new UniversityGateway($connection);
        
        if (!empty($_GET['st']))
        {
            //convert from abbreviation
            $state = $stateDb->findWithFilter("StateAbbr =", $_GET['st'], null, null);
            foreach ($state as $row)
                $state = $row["StateName"];
        }
        $uni = $uniDb->findWithFilter("State =", $state, null, null);
        foreach ($uni as $row) //loop through the data
        {
            echo ("<a href='?id=");
            echo ($row["UniversityID"]);
            echo ("&st=" . $_GET['st']);
            echo ("'><li>");
            echo ($row["Name"]);
            echo ("</li></a>");
        }
    }
    function displayInfo() /* display requested univeristy information */ 
    {
        include "includes/config.php";
        $uniDb = new UniversityGateway($connection);
        $uni = $uniDb->findWithFilter("UniversityID =", $_GET['id'], null, null);
        if(empty($_GET['id']) || empty($uni))
            echo "Click on a university from the list";
        else
        {
            foreach ($uni as $row) //loop through the data
            {
                echo ("<h4>" . $row["Name"] . "</h4>");
                echo ($row["Address"] . "<br>");
                echo ($row["City"] . ", " . $row["State"] . ", " . ($row["Zip"]) . "<br>");
                echo ($row["Website"] . "<br>");
                //echo ($row["Latitude"] . ", " . $row["Longitude"]);
                ?> <!-- to html -->
                <div id="map">
                    <script> //to javascript
                    
                        // assisted by: https://developers.google.com/maps/documentation/javascript/ to do the google map
                        function initMap()
                        {
                            var latitude = parseFloat("<?php echo $row['Latitude']; ?>");
                            var longitude = parseFloat("<?php echo $row['Longitude']; ?>");
                            var uluru = {lat: latitude, lng: longitude };
                            var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 12,
                            center: uluru
                            });
                            var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                            });
                        }
                    </script> <!-- back to html -->
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgOg-dKVI4dgMyBcTKOWj3xxS1jKipA3E&callback=initMap">
                </script>
                <?php //back to php
            }
        }
    }
    function dropStates()
    {
        include "includes/config.php";
         $stateDb = new StateGateway($connection);
         $states = $stateDb->getAll();
         foreach ($states as $row) 
         {
             echo ('<option value="' . $row["StateAbbr"] . '"');
             //show selected value
             if ($_GET['st'] == $row["StateAbbr"])
                 echo ('selected="selected"');
             echo (">" . $row["StateName"] . "</option>");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Universities</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> </head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
        mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section class="page-content">
                <div class="mdl-grid">
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedPink">
                            <h2 class="mdl-card__title-text">Universities</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <form method="GET"> State:
                                <select name="st">
                                    <option value="all">ALL STATES</option>
                                    <?php dropStates(); ?> </select>
                                <input type="submit" value="Filter"> </form>
                            <ul class="demo-list-item mdl-list">
                                <?php listName(); ?> </ul>
                        </div>
                    </div>
                    <!-- / mdl-cell + mdl-card -->
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="lightPeriwinkle">
                            <h2 class="mdl-card__title-text">University Details</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <?php displayInfo(); ?> </div>
                    </div>
                    <!-- / mdl-cell + mdl-card -->
                </div>
                <!-- / mdl-grid -->
            </section>
        </main>
    </div>
    <!-- / mdl-layout -->
</body>

</html>