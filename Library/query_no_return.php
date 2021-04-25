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

        $query = "SELECT 
        reader_data.FirstName, reader_data.SurName, reader_data.LastName, books.Title
        FROM borrowbook 
        INNER JOIN reader_data ON borrowbook.ReaderCard=reader_data.ReaderCard
        INNER JOIN books ON borrowbook.BookId=books.BookId 
        WHERE borrowbook.Return LIKE 'Не'
        ORDER BY
        reader_data.FirstName, reader_data.SurName, reader_data.LastName";

        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Име</th><th>Презиме</th><th>Фамилия</th><th>Заглавие на книга</th></tr>";
        echo "<tr>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td></tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>