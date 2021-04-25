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

        $id = $nameError = "";
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }
        $query = "SELECT e.*,d.* FROM reader_data e JOIN reader_moredata d USING (ReaderCard) WHERE ReaderCard = $id";
        
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        $r = mysqli_fetch_array($result);
        ?>
        
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>  
        <tr>
            <th align="right"><span class="error">*</span><b>Номер: </th>
            <td><input name="name" type="text" id="name" size="30" value="<?= $r[0] ?>" readonly></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Име: </th>
            <td><input name="name" type="text" id="name" size="30" value="<?= $r[1] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Презиме: </th>
            <td><input name="surname" type="text" id="surname" size="30" value="<?= $r[2] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Фамилия: </th>
            <td><input name="lastname" type="text" id="lastname" size="30" value="<?= $r[3] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Дата на създаване: </th>
            <td><input name="createdate" type="date" id="createdate" size="30" value="<?= $r[4] ?>"></td>

        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>ЕГН: </th>
            <td><input name="egn" type="text" id="egn" size="30" maxlength="10" value="<?= $r[6] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Адрес: </th>
            <td><input name="address" type="address" id="egn" size="30" value="<?= $r[7] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Телефон: </th>
            <td><input name="phone" type="text" id="phone" size="30" maxlength="10" value="<?= $r[8] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Работа: </th>
            <td><input name="work" type="text" id="work" size="30" value="<?= $r[9] ?>"></td>
        </tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Промяна"/></center></td>
        </tr>

</form>

<?php
if (isset($_POST["submit"])) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $lastname = $_POST['lastname'];
    $createdate = date('Y-m-d', strtotime($_POST['createdate']));

    $egn = $_POST['egn'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $work = $_POST['work'];

    if (!(empty($name) && ($_POST["surname"]) && ($_POST["lastname"]) && ($_POST["createdate"]) && ($_POST["egn"]) && ($_POST["address"]) && ($_POST["phone"]) && ($_POST["work"]))) {
        if (strlen($nameError) == 0) {
            $query = "SELECT e.*,d.* FROM reader_data e JOIN reader_moredata d USING (ReaderCard) WHERE ReaderCard = $id";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

            $query = "UPDATE reader_data t1 
                        JOIN reader_moredata t2 ON (t1.ReaderCard = t2.ReaderCard) 
                        SET t1.FirstName = '$name', 
                            t1.SurName = '$surname', 
                            t1.LastName = '$lastname', 
                            t1.CreateDate = '$createdate',
                            t2.EGN = '$egn',
                            t2.Address = '$address',
                            t2.Phone = '$phone',
                            t2.Work = '$work'
                        WHERE t1.ReaderCard = $id";
            
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            
        }
    }
    

    $query = "SELECT e.*,d.* FROM reader_data e JOIN reader_moredata d USING (ReaderCard)";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Номер</th><th>Име</th><th>Презиме</th><th>Фамилия</th><th>Дата на създаване</th><th>ЕГН</th><th>Адрес</th><th>Телефон</th><th>Работа</th></tr>";
    echo "<tr>";
    while ($r = mysqli_fetch_array($result)) {
       echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[6]</td><td>$r[7]</td><td>$r[8]</td><td>$r[9]</td></tr>";
    }
    echo "</table>";
}
?>

</body>
</html>
