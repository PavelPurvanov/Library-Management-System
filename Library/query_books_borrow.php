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
 
        ?>
        <p><center><span class = "error" >* Задължително поле</span></center></p>

<form name="registration" method="POST">
    <table align="center" class='customTable'>
        <tr>
            <th colspan="2">Въведете период на заемане.</th>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Дата на заемане: </th>
            <td><input name="borrowdate" type="date" id="borrowdate" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Дата на връшане: </th>
            <td><input name="returndate" type="date" id="returndate" size="30" ></td>
        </tr>
        <th></th>
        <td><center><input type="submit" name="submit" value="Справка"/></center></td>
    </table>
</form>

<?php
if (isset($_POST["submit"])) {
    
$borrowdate = date('Y-m-d', strtotime($_POST['borrowdate']));
$returndate = date('Y-m-d', strtotime($_POST['returndate']));

if (!(empty($borrowdate) && empty($returndate))) {
               
        $query = "SELECT books.Title, borrowbook.borrowdate, borrowbook.returndate FROM
        books INNER JOIN borrowbook ON books.BookId=borrowbook.BookId
        WHERE borrowbook.borrowdate >= '$borrowdate'   AND  borrowbook.returndate <= '$returndate'"
                . "ORDER BY borrowbook.borrowdate";
 
                $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            
                echo "<br>";
                echo "<table align=center class='customTable' >\n";
                echo "<tr><th>Заглавие</th><th>Дата на заемане</th><th>Дата на връщане</th></tr>";
                echo "<tr>";
                while ($r = mysqli_fetch_array($result)) {
                    echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td></tr>";
                }
                echo "</table>";
                
            }
             else
    {echo " <h3> Моля попълнете всички полета ! </h3>";}
}
?>

</body>
</html>

