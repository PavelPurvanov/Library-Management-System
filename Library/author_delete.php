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

        $query = "SELECT * from authors";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

        ?>
        <table align=center class='customTable' > 
            <tr><th>Номер</th><th>Име</th><th>Фамилия</th><th>Националност</th><th></th></tr>
            <tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <td><?= $row[0] ?></td>
                    <td><?= $row[1] ?></td>
                    <td><?= $row[2] ?></td>
                    <td><?= $row[3] ?></td>
                    <td>
                        <a href='author_delete2.php?id=<?= $row[0] ?>' onclick="return confirm('Сигурни ли сте, че искате да изтриете записа ?')">Изтриване</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>