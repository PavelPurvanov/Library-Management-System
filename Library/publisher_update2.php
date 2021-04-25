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
        $query = "SELECT * from publishers where publisherId = $id";
        $result = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
        $r = mysqli_fetch_array($result);
        ?>
        
        <p><center><span class = "error" >* Задължително поле</span></center></p>
<form name="registration" method="POST">
    <table align="center" class='customTable'>    
        <tr>
            <th align="right"><span class="error">*</span><b>Номер: </th>
            <td><input name="id" type="text" id="id" size="30" value="<?= $r[0] ?>" readonly></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Издателство:</th>
            <td><input name="name" type="text" id="name" size="30" value="<?= $r[1] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Адрес:</th>
            <td><input name="address" type="text" id="address" size="50" value="<?= $r[2] ?>"></td>
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
    $address = $_POST['address'];

    if (!(empty($name) && empty($address))) {
        if (strlen($nameError) == 0) {
            $query = "SELECT `PublisherName`, `Address` FROM `publishers`";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

            $query = "UPDATE `publishers` SET `PublisherName`='" . $name . "',`Address`='" . $address . "' WHERE PublisherId='" . $id . "'";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            
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
?>

</body>
</html>