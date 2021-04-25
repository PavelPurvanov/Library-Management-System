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

        $query = "SELECT * from books";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Номер</th><th>Заглавие</th><th>Автор</th><th>Жанр</th><th>Издателство</th><th></th></tr>";
        echo "<tr>";
        while ($row = mysqli_fetch_array($result)) {
            ?>
        <td> <?= $row[0] ?></td>
        <td> <?= $row[1] ?></td>

        <?php
        $authorquery = mysqli_query($dbConn, "SELECT AuthorId, FirstName, LastName FROM authors WHERE AuthorId = $row[2]");
        $authorrow = mysqli_fetch_array($authorquery);
        ?>
        <td><?= $authorrow[1] . " " . $authorrow[2] ?></td>

        <?php
        $genrequery = mysqli_query($dbConn, "SELECT GenreId, Type FROM genre WHERE GenreId = $row[3]");
        $genrerow = mysqli_fetch_array($genrequery);
        ?>
        <td><?= $genrerow[1] ?></td>

        <?php
        $publisherquery = mysqli_query($dbConn, "SELECT PublisherId, PublisherName FROM publishers WHERE PublisherId = $row[4]");
        $publisherrow = mysqli_fetch_array($publisherquery);
        ?>
        <td><?= $publisherrow[1] ?></td>

        <td><div class='btn-group'>
                <a class='btn-secondary' href='book_update2.php?id= <?= $row[0] ?>'>Редактиране</a>
            </div> 
        </td>
    </tr>


<?php } ?>
</table>
</body>
</html>
