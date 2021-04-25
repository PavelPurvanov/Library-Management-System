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
        $address = $addressError = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])&&($_POST["address"])) {
                $nameError = "Въведете издателство.";
                $addressError = "Въведете адрес";
            } else {
                $name = test_input($_POST["name"]);
                $address = test_input($_POST["address"]);
                
                /*if (!preg_match("~(*UTF8)[\p{Cyrillic}]~", $name, $address)) {
                    $nameError = "Жанрът и Адресът могат да съдържат само букви на кирилица или тирета.";
                }*/
            }
        }
        ?>
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>
        <tr>
            <th align="right"><span class="error">*</span><b>Издателство: </th>
            <td><input name="name" type="text" id="name" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Адрес: </th>
            <td><input name="address" type="text" id="address" size="50" ></td>
        </tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $addressError; ?></span></h3>
        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Въвеждане"/></center></td>
        </tr>
    </table>
</form>
<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    
    if (!((empty($name) && empty($_POST["address"])))) {
        
        if (strlen($nameError) == 0 && strlen($addressError) == 0) {
            $query = "SELECT `PublisherName`, `Address` FROM `publishers`";
                    
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            $flag = 0;
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                $type = $row[0];
                if ($type == $name) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                $query = "INSERT INTO `publishers`(`PublisherName`, `Address`) VALUES ('$name','$address')";
                $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            } else {
                echo"<h3>Издателството съществува в базата данни.</h3>";
            }
        }
    
    
    $query = "SELECT * from publishers";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Номер</th><th>Издателство</th><th>Адрес</th></tr>";
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
