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
        
        $name = $nameError = "";
        $authorid = $authoridError = "";
        $genreid = $genreidError = "";
        $publisherid = $publisheridError = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])&&($_POST["authorid"])&&($_POST["genreid"])
                    &&($_POST["publisherid"])) {
                $nameError = "Въведете заглавие на книга.";
                $authoridError = "Изберете автор на книга.";
                $genreidError = "Изберете жанр на книга.";
                $publisherid = "Изберете издателство на книга.";
            } else {
                $name = test_input($_POST["name"]);
                if (!preg_match("~(*UTF8)[\p{Cyrillic}]~", $name)) {
                    $nameError = "Заглавието може да съдържасамо букви на кирилица или тирета.";
                }   
            }
        }    
        ?>
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>
        <tr>
            <th align="right"><span class="error">*</span><b>Заглавие: </th>
            <td><input name="name" type="text" id="name" size="50" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Автор: </th>
            <td>
                <select name="author">
                    <option selected> --Избери-- </option>
             <?php
            $аuthors = mysqli_query($dbConn, "SELECT * FROM authors");
                while($row = mysqli_fetch_array($аuthors)){
            ?>
                    <option value="<?= $row[0].'|'.$row[1].'|'.$row[2] ?>"> <?= $row[1] ?> <?= $row[2] ?></option>
                
                <?php  }   ?>
                    </select>
            </td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Жанр: </th>
            <td>
                <select name="genre">
                    <option selected> --Избери-- </option>
             <?php
            $genre = mysqli_query($dbConn, "SELECT * FROM genre");
                while($row = mysqli_fetch_array($genre)){
            ?>
                    <option value="<?= $row[0].'|'.$row[1] ?>"> <?= $row[1] ?> </option>
                
                <?php }    ?>
                    </select>
            </td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Издателство: </th>
            <td>
                <select name="publisher">
                    <option selected> --Избери-- </option>
             <?php
            $publisher = mysqli_query($dbConn, "SELECT * FROM publishers");
                while($row = mysqli_fetch_array($publisher)){
            ?>
                    <option value="<?= $row[0].'|'.$row[1] ?>"> <?= $row[1] ?> </option>
                
                <?php }    ?>
                    </select>
            </td>
        </tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $authoridError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $genreidError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $publisheridError; ?></span></h3>
        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Въвеждане"/></center></td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST["submit"])) {
    
    $name = $_POST['name'];

    $datas1 = explode('|',$_POST['author']);
    $authorid = $datas1[0];
    
    $datas2 = explode('|',$_POST['genre']);
    $genreid = $datas2[0];
    
    $datas3 = explode('|',$_POST['publisher']);
    $publisherid = $datas3[0];

    
    if ((!(empty($name))) && $_POST['author'] != "--Избери--") {
        
        if (strlen($nameError) == 0 && strlen($authoridError) == 0&& strlen($genreidError) == 0 && strlen($publisheridError) == 0) {
            
            $query = "SELECT * FROM books";
                    
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            $flag = 0;
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                $type = $row[0];
                if ($type == $name) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                
                $query = "INSERT INTO `books`(`Title`, `AuthorId`, `GenreId`, `PublisherId`)
                       VALUES ('$name',(SELECT AuthorId from authors WHERE AuthorId = $authorid),
                     (SELECT GenreId from genre WHERE GenreId = $genreid),
                      (SELECT PublisherId from publishers WHERE PublisherId = $publisherid))";
                
                $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            } else {
                echo"<h3>Книгата съществува в базата данни.</h3>";
            }
        }
    

    $query = "SELECT * from books";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Номер</th><th>Заглавие</th><th>Автор</th><th>Жанр</th><th>Издателство</th></tr>";
    echo "<tr>";
    while ($r = mysqli_fetch_array($result)) {
        echo "<td>$r[0]</td>"
                . "<td>$r[1]</td>"
                . "<td> $r[2] </td>"
                . "<td>$r[3]</td>"
                . "<td>$r[4]</td>"
                . "</tr>";
    }
    echo "</table>";
    }
    else
    {echo "<h3> Моля попълнете всички полета ! </h3>";}
}
?>


</body>
</html>

