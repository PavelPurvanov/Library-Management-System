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
        $lastname = $lastnameError = "";
        $nationality = $nationalityError = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])&&($_POST["lastname"])&&($_POST["nationality"])) {
                $nameError = "Въведете име на автор.";
                $lastnameError = "Въведете фамилия на автор.";
                $nationalityError = "Въведете националност на автор.";
            } else {
                $name = test_input($_POST["name"]);
                $lastname = test_input($_POST["lastname"]);
                $nationality = test_input($_POST["nationality"]);
                if (!preg_match("~(*UTF8)[\p{Cyrillic}]~", $name, $lastname) && !preg_match("~(*UTF8)[\p{Cyrillic}]~", $nationality)) {
                    $nameError = "Имената и националността могат да съдържат само букви на кирилица или тирета.";
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
            <th align="right"><span class="error">*</span><b>Фамилия: </th>
            <td><input name="lastname" type="text" id="lastname" size="30" ></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Националност: </th>
            <td><input name="nationality" type="text" id="nationality" size="30" ></td>
        </tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $lastnameError; ?></span></h3>
        <tr>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $nationalityError; ?></span></h3>
        <tr>
            <th></th>
            <td><center><input type="submit" name="submit" value="Въвеждане"/></center></td>
        </tr>
    </table>
</form>
<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $nationality = $_POST['nationality'];
    
    if (!((empty($name)&& empty($_POST["lastname"])&& empty($_POST["nationality"])))) {
        
        if (strlen($nameError) == 0 && strlen($lastnameError) == 0&& strlen($nationalityError) == 0) {
            
            $query = "SELECT `FirstName`, `LastName`, `Nationality` FROM `authors`";
                    
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            $flag = 0;
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                $type = $row[0];
                if ($type == $name) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                $query = "INSERT INTO `authors`(`FirstName`, `LastName`, `Nationality`) VALUES ('$name','$lastname','$nationality')";
                $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            } else {
                echo"<h3>Издателството съществува в базата данни.</h3>";
            }
        }
    
    
    $query = "SELECT * from authors";
    $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
    echo "<br>";
    echo "<table align=center class='customTable' >\n";
    echo "<tr><th>Номер</th><th>Име</th><th>Фамилия</th><th>Националност</th></tr>";
    echo "<tr>";
    while ($r = mysqli_fetch_array($result)) {
        echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td></tr>";
    }
    echo "</table>";
    }
    else
    {echo " <h3> Моля попълнете всички полета ! </h3>";}
}
?>
</body>
</html>
