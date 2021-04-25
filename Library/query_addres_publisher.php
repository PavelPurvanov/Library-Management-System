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
            if (empty($_POST["city"])) {
                $nameError = "Въведете град на издателство.";
            } else {
                $name = test_input($_POST["city"]);

                if (!preg_match("~(*UTF8)[\p{Cyrillic}]~", $name)) {
                    $nameError = "Градът може да съдържа само букви на кирилица или тире.";
                }
            }
        }
        
        ?>
        <p><center><span class = "error" >* Задължително поле</span></center></p>

<form name="registration" method="POST">
    <table align="center" class='customTable'>
        <tr>
            <th colspan="2">Въведете град на издателство.</th>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Град: </th>
            <td><input name="city" type="text" id="city" size="30" ></td>
        </tr>
        <th></th>
        <td><center><input type="submit" name="submit" value="Справка"/></center></td>
        <tr>
        <h3 align = "left"><span class="error"><?php echo $nameError; ?></span></h3>
        <tr>
    </table>
</form>

<?php
if (isset($_POST["submit"])) {
    
$city = $_POST['city'];


if (!empty($city)) {
        if (strlen($nameError) == 0) {
            $query = "SELECT * FROM publishers WHERE Address LIKE '%$city%'";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            $flag = 0;
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                $type = $row[2];
                if (strpos($type,$city) !== false) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                echo"<h3>Няма издателство от този град в базата данни.</h3>";
            } else {
                
                $query = "SELECT * FROM publishers WHERE Address LIKE '%$city%' ORDER BY PublisherName";
                
                $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            
                echo "<br>";
                echo "<table align=center class='customTable' >\n";
                echo "<tr><th>Номер</th><th>Име</th><th>Адрес</th></tr>";
                echo "<tr>";
                while ($r = mysqli_fetch_array($result)) {
                    echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td></tr>";
                }
                echo "</table>";
            }
        }
    
    
   
    }
    else
    {echo " <h3> Моля попълнете всички полета ! </h3>";}
}
?>

</body>
</html>