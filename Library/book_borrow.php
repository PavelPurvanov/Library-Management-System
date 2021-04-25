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
        
        $readercard = $readercardError = "";
        $bookid = $bookidError = "";
        $borrowdate = $borrowdataError = "";
        $returndate = $returndateError = "";
        $return;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["reader"])&&($_POST["book"])&&($_POST["borrowdate"])
                    &&($_POST["returndate"])) {
                $readercardError = "Изберете читател на книга.";
                $bookidError = "Изберете книга.";
                $borrowdataError = "Въведете дата на взимане на кнгиата.";
                $returndateError = "Въведете дата на връщане на книгата.";
            }
        }    
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
                while($row = mysqli_fetch_array($reader)){
            ?>
                    <option value="<?= $row[0].'|'.$row[1].'|'.$row[2] ?>"> <?= $row[0] ?> <?= $row[1] ?> <?= $row[2] ?></option>
                
                <?php  }   ?>
                    </select>
            </td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Книга: </th>
            <td>
                <select name="book">
                    <option selected> --Избери-- </option>
             <?php
            $books = mysqli_query($dbConn, "SELECT * FROM books");
                while($row = mysqli_fetch_array($books)){
            ?>
                    <option value="<?= $row[0].'|'.$row[1] ?>"> <?= $row[0] ?> <?= $row[1] ?></option>
                
                <?php  }   ?>
                    </select>
            </td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Дата на заемане: </th>
            <td><input name="borrowdate" type="date" id="borrowdate" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Дата на връшане: </th>
            <td><input name="returndate" type="date" id="returndate" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Върната: </th>
            <td>
                <select name="return">
                    <option selected> --Избери-- </option>
                    <option value="'Да'">Да</option>
                    <option value="'Не'">Не</option>
                </select>
        </tr>
        
        <tr>
        <h3 align = "left"><span class="error"><?php echo $readercardError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $bookidError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $borrowdataError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $returndateError; ?></span></h3>
        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Въвеждане"/></center></td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST["submit"])) {
    
    $datas = explode('|',$_POST['reader']);
    $readercard = $datas[0];

    $datas1 = explode('|',$_POST['book']);
    $bookid = $datas1[0];
    
    $borrowdate = date('Y-m-d', strtotime($_POST['borrowdate']));
    $returndate = date('Y-m-d', strtotime($_POST['returndate']));
    
    $return = $_POST['return'];
     
    if ($_POST['reader'] != "--Избери--" && $_POST['book'] != "--Избери--" && $_POST['return'] != "--Избери--") {
        
        if (strlen($readercardError) == 0 && strlen($bookidError) == 0&& strlen($borrowdataError) == 0 && strlen($returndateError) == 0) {
        
                $query = "INSERT INTO `borrowbook`(`ReaderCard`, `BookId`, `BorrowDate`, `ReturnDate`, `Return`)
                       VALUES ((SELECT ReaderCard from reader_data WHERE ReaderCard = $readercard),
                     (SELECT BookId from books WHERE BookId = $bookid),
                      '$borrowdate', '$returndate', $return)";
                
                $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        }
    

    $query = "SELECT * from borrowbook";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Читател</th><th>Книга</th><th>Дата на заемане</th><th>Дата на връщане</th><th>Върната</th></tr>";
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

