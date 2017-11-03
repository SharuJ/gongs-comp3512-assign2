<?php
require_once("config.php");
function listSubs() /* programmatically loop though subcategories and display each subcategory as <li> element. */ 
{
    echo ('<a href="?sub=&imp=' . $_GET['imp'] . '"><li>ALL SUBCATEGORIES</li></a>');
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select SubcategoryName from Subcategories order by SubcategoryName";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) //loop through the data
            {
            echo ("<a href='?sub=");
            echo ($row["SubcategoryName"]);
            echo ("&imp=" . $_GET['imp']);
            echo ("'><li>");
            echo ($row["SubcategoryName"]);
            echo ("</li></a>");
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
}
function listImprints() /* programmatically loop though imprints and display each imprint as <li> element. */ 
{
    echo ('<a href="?sub=' . $_GET['sub'] . '&imp="><li>ALL IMPRINTS</li></a>');
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select Imprint from Imprints order by Imprint";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) //loop through the data
            {
            echo ("<a href='?sub=");
            echo ($_GET['sub']);
            echo ("&imp=" . $row["Imprint"]);
            echo ("'><li>");
            echo ($row["Imprint"]);
            echo ("</li></a>");
        }
        
        $pdo = null;
    }
    catch (PDOException $e) {
        die($e->getMessage());
        
    }
}
function listBooks() /* programmatically loop though books and display each book as <li> element. */ 
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select ISBN10, Title, CopyrightYear, SubcategoryName, Imprint from Books
                    LEFT JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID 
                    LEFT JOIN Imprints ON Books.ImprintID = Imprints.ImprintID";
        $sub = $_GET['sub'];
        $imp = $_GET['imp'];
        //sub filter
        if (!empty($_GET['sub']) && empty($_GET['imp'])) {
            $sql .= " WHERE SubcategoryName =:s";
        }
        //imp filter
        elseif (!empty($_GET['imp']) && empty($_GET['sub'])) {
            $sql .= " WHERE Imprint =:i";
        }
        //both filter
            elseif (!empty($_GET['sub']) && !empty($_GET['imp'])) {
            $sql .= " WHERE SubcategoryName =:s";
            $sql .= " AND Imprint =:i";
        }
        //no filter
        else {
            //add nothing
        }
        $sql .= " order by Title LIMIT 20";
        $s      = $_GET['sub'];
        $i      = $_GET['imp'];
        $result = $pdo->prepare($sql);
        //sub filter
        if (!empty($_GET['sub']) && empty($_GET['imp'])) {
            $result->bindParam(':s', $s);
        }
        //imp filter
        elseif (!empty($_GET['imp']) && empty($_GET['sub'])) {
            $result->bindParam(':i', $i);
        }
        //both filter
        else {
            $result->bindParam(':s', $s);
            $result->bindParam(':i', $i);
        }
        $result->execute();
       
        
        if ($result->rowCount() > 0)
        {
            
               
        
        while ($row = $result->fetch()) //loop through the data
            {
            echo ("<a href='single-book.php?isbn=");
            echo ($row["ISBN10"]);
            echo ("'>");
            echo ('<center><img id="ThumbCover" src="/book-images/thumb/' . $row["ISBN10"] . '.jpg" alt="book cover"></center><br>');
            echo ("<b>" . $row["Title"] . "</b><br>");
            echo ("</a>");
            echo ("<b>Year:</b> " . $row["CopyrightYear"] . "<br>");
            echo ("<b>Subcategory:</b> " . $row["SubcategoryName"] . "<br>");
            echo ("<b>Imprint:</b> " . $row["Imprint"]);
            echo ("<hr>");
        }
        
        }
        
        else
        {
            echo ("No book found that matches filters");
        }
        
        $pdo = null;
    }
    catch (PDOException $e) {
        die($e->getMessage());
        echo ("No book found that fits those filters");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Book</title>
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
                    <div class="mdl-cell mdl-cell--5-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="lightGrayish">
                                <h2 class="mdl-card__title-text">Filter by Imprint: <?php echo($_GET['imp']) ?></h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php listImprints() ?> </ul>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="fadedBlue">
                                <h2 class="mdl-card__title-text">Filter by Subcategory: <?php echo($_GET['sub']) ?> </h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php listSubs() ?> </ul>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                    </div>
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--7-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="fadedPink">
                                <h2 class="mdl-card__title-text">Books</h2> </div>
                            <div class="mdl-card__supporting-text">
                                <?php listBooks() ?> </div>
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