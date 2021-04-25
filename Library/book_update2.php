<html>
    <head>
        <meta charset="UTF-8">
        <title>Библиотека</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        
        <?php
        include "config.php";
        include "menu_user.php";
        include "functions.php";

        $id = $nameError = "";
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }
        $query = "SELECT * from books where bookId = $id";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        $r = mysqli_fetch_array($result);
        
        $queryauthor = "SELECT AuthorId, FirstName, LastName from authors where authorId = $r[2]";
        $resultauthor = mysqli_query($dbConn, $queryauthor);
        $rowauthor = mysqli_fetch_array($resultauthor);
        
        $querygenre = "SELECT GenreId, Type from genre where genreId = $r[3]";
        $resultgenre = mysqli_query($dbConn, $querygenre);
        $rowgenre = mysqli_fetch_array($resultgenre);
        
        $querypublisher = "SELECT PublisherId, PublisherName from publishers where publisherId = $r[4]";
        $resultpublisher = mysqli_query($dbConn, $querypublisher);
        $rowpublisher = mysqli_fetch_array($resultpublisher);
        ?>
        
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>  
        <tr>
            <th align="right"><span class="error">*</span><b>Номер: </th>
            <td><input name="name" type="text" id="name" size="50" value="<?= $r[0] ?>" readonly></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Заглавие: </th>
            <td><input name="name" type="text" id="name" size="50" value="<?= $r[1] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Автор: </th>
            <td>
                <select name="author" >
                    <option selected> <?= $rowauthor[0] .' '.$rowauthor[1] .' '. $rowauthor[2] ?> </option>
             <?php
            $аuthors = mysqli_query($dbConn, "SELECT * FROM authors");
                while($row = mysqli_fetch_array($аuthors)){
            ?>
                    <option value="<?= $row[0].' '.$row[1].' '.$row[2] ?>"> <?= $row[1] ?> <?= $row[2] ?></option>
                
                <?php  }   ?>
                    </select>
            </td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Жанр: </th>
            <td>
                <select name="genre">
                    <option selected> <?= $rowgenre[0] .' '. $rowgenre[1]?> </option>
             <?php
            $genre = mysqli_query($dbConn, "SELECT * FROM genre");
                while($row = mysqli_fetch_array($genre)){
            ?>
                    <option value="<?= $row[0].' '.$row[1] ?>"> <?= $row[1] ?> </option>
                
                <?php }    ?>
                    </select>
            </td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Издателство: </th>
            <td>
                <select name="publisher">
                    <option selected> <?= $rowpublisher[0] .' '.$rowpublisher[1]  ?> </option>
             <?php
            $publisher = mysqli_query($dbConn, "SELECT * FROM publishers");
                while($row = mysqli_fetch_array($publisher)){
            ?>
                    <option value="<?= $row[0].' '.$row[1] ?>"> <?= $row[1] ?> </option>
                
                <?php }    ?>
                    </select>
            </td>
        </tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Промяна"/></center></td>
        </tr>

</form>

<?php
if (isset($_POST["submit"])) {

    $name = $_POST['name'];

    $datas1 = explode(' ',$_POST['author']);
    $authorid = $datas1[0];
    
    echo "<hr3>$authorid </h3>";
    
    $datas2 = explode(' ',$_POST['genre']);
    $genreid = $datas2[0];
    
    $datas3 = explode(' ',$_POST['publisher']);
    $publisherid = $datas3[0];

    if ((!(empty($name))) && $_POST['author'] != "--Избери--") {
        if (strlen($nameError) == 0) {
            $query = "SELECT * FROM `books`";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

            $query = "UPDATE `books` SET `Title`='" . $name . "',`AuthorId`='" . $authorid . "',`GenreId`='" . $genreid . "',`PublisherId`='" . $publisherid . "'WHERE BookId='" . $id . "'";
            
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            
        }
    }
    

    $query = "SELECT * from books";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Номер</th><th>Заглавие</th><th>Автор</th><th>Жанр</th><th>Издателство</th></tr>";
    echo "<tr>";
    while ($r = mysqli_fetch_array($result)) {
        echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td></tr>";
    }
    echo "</table>";
}
?>

</body>
</html>