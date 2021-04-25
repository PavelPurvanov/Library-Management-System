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

        $name = $nameError = "";
        $surname = $surnameError = "";
        $lastname = $lastnameError = "";
        $createdate = $createdateError = "";

        $egn = $egnError = "";
        $address = $addressError = "";
        $phone = $phoneError = "";
        $work = $workError = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["name"]) && ($_POST["surname"]) && ($_POST["lastname"]) && ($_POST["createdate"]) && ($_POST["egn"]) && ($_POST["address"]) && ($_POST["phone"]) && ($_POST["work"])) {

                $nameError = "Въведете име на читател.";
                $surnameError = "Въведете презиме на читател.";
                $lastnameError = "Въведете фамилия на читател.";
                $createdateError = "Въведете дата на създаване.";

                $egnError = "Въведете егн на читател.";
                $addressError = "Въведете адрес на читател.";
                $phoneError = "Въведете телефон на читател.";
                $workError = "Въведете работа на читател.";
            } else {
                $name = test_input($_POST["name"]);
                $surname = test_input($_POST["surname"]);
                $lastname = test_input($_POST["lastname"]);
                $createdate = test_input($_POST["createdate"]);

                $egn = test_input($_POST["egn"]);
                $address = test_input($_POST["address"]);
                $phone = test_input($_POST["phone"]);
                $work = test_input($_POST["work"]);

                if (!preg_match("~(*UTF8)[\p{Cyrillic}]~", $name, $surname) && !preg_match("~(*UTF8)[\p{Cyrillic}]~", $lastname, $address)) {
                    $nameError = "Имената и адреса могат да съдържат само букви на кирилица или тирета.";
                }
                if (!preg_match("/^[1-9][0-9]*$/", $egn, $phone)) {
                    $egnError = "Имената и адреса могат да съдържат само букви на кирилица или тирета.";
                }
            }
        }
        ?>
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>
        <tr>
            <th align="right"><span class="error">*</span><b>Име: </th>
            <td><input name="name" type="text" id="name" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Презиме: </th>
            <td><input name="surname" type="text" id="surname" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Фамилия: </th>
            <td><input name="lastname" type="text" id="lastname" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Дата на създаване: </th>
            <td><input name="createdate" type="date" id="createdate" size="30" ></td>

        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>ЕГН: </th>
            <td><input name="egn" type="text" id="egn" size="30" maxlength="10"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Адрес: </th>
            <td><input name="address" type="address" id="egn" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Телефон: </th>
            <td><input name="phone" type="text" id="phone" size="30" maxlength="10"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Работа: </th>
            <td><input name="work" type="text" id="work" size="30" ></td>
        </tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $surnameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $lastnameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $createdateError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $egnError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $addressError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $phoneError; ?></span></h3>
        <tr> 
        <tr>
        <h3 align = "left"><span class="error"><?php echo $workError; ?></span></h3>
        <tr>  
            <th></th>
            <td><center><input type="submit" name="submit" value="Въвеждане"/></center></td>
        </tr>
    </table>
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


    if (!((empty($name) && empty($_POST["surname"]) 
            && empty($_POST["lastname"]) && empty($_POST["createdate"]) 
            && empty($_POST["egn"]) && empty($_POST["address"]) 
            && empty($_POST["phone"]) && empty($_POST["work"])))) {

        if (strlen($nameError) == 0 && strlen($surnameError) == 0 && strlen($lastnameError) == 0 && strlen($createdateError) == 0 && strlen($egnError) == 0 && strlen($addressError) == 0 && strlen($phoneError) == 0 && strlen($workError) == 0) {

            $query = "SELECT c.FirstName, c.SurName, c.LastName, c.CreateDate, p.EGN, p.Address, p.Phone, p.Work FROM reader_data c, reader_moredata p WHERE c.ReaderCard=p.ReaderCard";

            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            $flag = 0;
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                $type = $row[0];
                if ($type == $name) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                $query = "INSERT INTO `reader_data` (`FirstName`, `SurName`, `LastName`, `CreateDate`) VALUES ('$name','$surname','$lastname', '$createdate')";
                $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
                $last_id = $dbConn->insert_id;

                $query2 = "INSERT INTO `reader_moredata`(`ReaderCard`,`EGN`, `Address`, `Phone`, `Work`) VALUES ('$last_id','$egn','$address','$phone', '$work')";
                $res = mysqli_query($dbConn, $query2) or die('Error: ' . mysqli_error($dbConn));
            } else {
                echo"<h3>Читателят съществува в базата данни.</h3>";
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
    else
    {echo "Моля попълнете всички полета !";}
}
?>
</body>
</html>
