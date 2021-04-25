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

        $query = "SELECT e.*,d.* FROM reader_data e JOIN reader_moredata d USING (ReaderCard)";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Номер</th><th>Име</th><th>Презиме</th><th>Фамилия</th><th>Дата на създаване</th><th>ЕГН</th><th>Адрес</th><th>Телефон</th><th>Работа</th><th></th></tr>";
        echo "<tr>";
        while ($r= mysqli_fetch_array($result)) {
        echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[6]</td><td>$r[7]</td><td>$r[8]</td><td>$r[9]</td>"
            . "<td>"
            . "<div class='btn-group'>"
            . "<a class='btn-secondary' href='reader_update2.php?id=" . $r[0] . "'>Редактиране</a>"
            . "</div>"
            . "</td>"
            . "</tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>
