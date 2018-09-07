<?php

    include "includes/checkSession.php";
    function listSubs() /* programmatically loop though subcategories and display each subcategory as <li> element. */ 
    {
        echo ('<a href="?sub=&imp=' . $_GET['imp'] . '"><li>ALL SUBCATEGORIES</li></a>');
        include "includes/config.php";
        $subDb         = new SubcategoryGateway($connection);
        $subcategories = $subDb->getAll("SubcategoryName");
        foreach ($subcategories as $row)
        {
            echo ("<a href='?sub=");
            echo ($row["SubcategoryName"]);
            echo ("&imp=" . $_GET['imp']);
            echo ("'><li>");
            echo ($row["SubcategoryName"]);
            echo ("</li></a>");
        }
    }
    function listImprints() /* programmatically loop though imprints and display each imprint as <li> element. */ 
    {
        echo ('<a href="?sub=' . $_GET['sub'] . '&imp="><li>ALL IMPRINTS</li></a>');
        include "includes/config.php";
        $impDb    = new ImprintGateway($connection);
        $imprints = $impDb->getAll("Imprint");
        foreach ($imprints as $row)
        {
            echo ("<a href='?sub=");
            echo ($_GET['sub']);
            echo ("&imp=" . $row["Imprint"]);
            echo ("'><li>");
            echo ($row["Imprint"]);
            echo ("</li></a>");
        }
    }
    function listBooks() /* programmatically loop though books and display each book as <li> element. */ 
    {
        include "includes/config.php";
        $bookDb = new BookGateway($connection);
        $books  = $bookDb->findWithFilter("SubcategoryName = ", $_GET['sub'], "Imprint = ", $_GET['imp']);
        if (empty($books))
        {
            echo ("No books found with specified imprint and subcategory");
        }
        else
        {
            foreach ($books as $row)
            {
                echo ("<a href='single-book.php?isbn=");
                echo ($row["ISBN10"]);
                echo ("'>");
                echo ('<center><img src="/book-images/thumb/' . $row["ISBN10"] . '.jpg" alt="book cover"></center><br>');
                echo ("<b>" . $row["Title"] . "</b><br>");
                echo ("</a>");
                echo ("<b>Year:</b> " . $row["CopyrightYear"] . "<br>");
                echo ("<b>Subcategory:</b> " . $row["SubcategoryName"] . "<br>");
                echo ("<b>Imprint:</b> " . $row["Imprint"]);
                echo ("<hr>");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Books</title>
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
                    <div class="mdl-cell mdl-cell--7-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="fadedPink">
                                <h2 class="mdl-card__title-text">Books</h2> </div>
                            <div class="mdl-card__supporting-text">
                                <?php listBooks(); ?> </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                    </div>
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--5-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="lightGrayish">
                                <h2 class="mdl-card__title-text">Filter by Imprint: <?php echo($_GET['imp']) ?></h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php listImprints(); ?> </ul>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="fadedBlue">
                                <h2 class="mdl-card__title-text">Filter by Subcategory: <?php echo($_GET['sub']) ?> </h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php listSubs(); ?> </ul>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                    </div>
                </div>
                <!-- / mdl-grid -->
            </section>
        </main>
    </div>
    <!-- / mdl-layout -->
</body>

</html>