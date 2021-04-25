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
        ?>
        <table align=center class='customTable' > 
            <tr><th>Номер</th><th>Заглавие</th><th>Автор</th><th>Жанр</th><th>Издателство</th><th></th></tr>
            <tr>
                <?php
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

                    <td>
                        <a href='book_delete2.php?id=<?= $row[0] ?>' onclick="return confirm('Сигурни ли сте, че искате да изтриете записа ?')">Изтриване</a>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>