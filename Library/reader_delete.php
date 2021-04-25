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

        ?>
        <table align=center class='customTable' > 
            <tr><th>Номер</th><th>Име</th><th>Презиме</th><th>Фамилия</th><th>Дата на създаване</th><th>ЕГН</th><th>Адрес</th><th>Телефон</th><th>Работа</th><th></th></tr>
            <tr>
                <?php
                while ($r = mysqli_fetch_array($result)) {
                    ?>
                   <td><?= $r[0] ?></td><td><?= $r[1] ?></td><td><?= $r[2] ?></td><td><?= $r[3] ?></td><td><?= $r[4] ?></td><td><?= $r[6] ?></td><td><?= $r[7] ?></td><td><?= $r[8] ?></td><td><?= $r[9] ?></td>
                    <td>
                        <a href='reader_delete2.php?id=<?= $r[0] ?>' onclick="return confirm('Сигурни ли сте, че искате да изтриете записа ?')">Изтриване</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>