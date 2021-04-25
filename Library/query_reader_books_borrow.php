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
        ?>

        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>

        <tr>
            <th align="right"><span class="error">*</span><b>Читател: </th>
            <td>
                <select name="reader">
                    <option selected> --Избери-- </option>
                    <?php
                    $reader = mysqli_query($dbConn, "SELECT * FROM reader_data");
                    while ($row = mysqli_fetch_array($reader)) {
                        ?>
                        <option value="<?= $row[0] . '|' . $row[1] . '|' . $row[2] . '|' . $row[2] ?>"> <?= $row[1] ?> <?= $row[2] ?> <?= $row[3] ?></option>

                    <?php } ?>
                </select>
            </td>
        </tr>
        <th></th>
        <td><center><input type="submit" name="submit" value="Справка"/></center></td>
    </table>
</form>
        <?php
        if (isset($_POST["submit"])) {
            
        $datas1 = explode('|',$_POST['reader']);
        $readerid = $datas1[0];
        
        
        $query = "SELECT 
        reader_data.FirstName, reader_data.SurName, reader_data.LastName, books.Title, authors.FirstName, authors.LastName 
        FROM borrowbook 
        INNER JOIN reader_data ON borrowbook.ReaderCard=reader_data.ReaderCard
        INNER JOIN books ON borrowbook.BookId=books.BookId
        INNER JOIN authors ON books.AuthorId = authors.AuthorId
        WHERE borrowbook.ReaderCard = $readerid
        ORDER BY
        reader_data.FirstName, reader_data.SurName, reader_data.LastName";
        
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

        echo "<br>";
        echo "<table align=center class='customTable' >\n";
        echo "<tr><th>Име</th><th>Презиме</th><th>Фамилия</th><th>Заглавие на книга</th><th>Автор Име</th><th>Автор Фамилия</th></tr>";
        echo "<tr>";
        while ($r = mysqli_fetch_array($result)) {
            echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td></tr>";
        }
        echo "</table>";
        }
?>

</body>
</html>
