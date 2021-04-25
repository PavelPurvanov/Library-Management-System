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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameError = "Въведете жанр.";
            } else {
                $name = test_input($_POST["name"]);

                if (!preg_match("~(*UTF8)[\p{Cyrillic}]~", $name)) {
                    $nameError = "Жанрът може да съдържа само букви на кирилица или тире.";
                }
            }
        }
        ?>
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>
        <tr>
            <th align="right"><span class="error">*</span><b>Жанр: </th>
            <td><input name="name" type="text" id="name" size="30" ></td>
        </tr>
        <tr>

        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>

        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Въвеждане"/></center></td>
        </tr>
    </table>
</form>
<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    if (!empty($name)) {
        if (strlen($nameError) == 0) {
            $query = "SELECT Type FROM genre";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            $flag = 0;
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                $type = $row[0];
                if ($type == $name) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                $query = "INSERT INTO genre (Type) VALUES('$name')";
                $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            } else {
                echo"<h3>Жанрът съществува в базата данни.</h3>";
            }
        }
    
    
    $query = "SELECT * from genre";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Номер</th><th>Вид</th></tr>";
    echo "<tr>";
    while ($r = mysqli_fetch_array($result)) {
        echo "<td>$r[0]</td><td>$r[1]</td></tr>";
    }
    echo "</table>";
    }
    else
    {echo " <h3> Моля попълнете всички полета ! </h3>";}
}
?>
</body>
</html>
