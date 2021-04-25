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
        $query = "SELECT * from authors where authorId = $id";
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
            <th align="right"><span class="error">*</span><b>Фамилия: </th>
            <td><input name="lastname" type="text" id="lastname" size="30" value="<?= $r[2] ?>"></td>
        </tr>
        <tr>
            <th align="right"><span class="error">*</span><b>Националност: </th>
            <td><input name="nationality" type="text" id="nationality" size="30" value="<?= $r[3] ?>"></td>
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
    $lastname = $_POST['lastname'];
    $nationality = $_POST['nationality'];

    if (!(empty($name) && empty($lastname) && empty($nationality))) {
        if (strlen($nameError) == 0) {
            $query = "SELECT `FirstName`, `LastName`, `Nationality` FROM `authors`";
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));

            $query = "UPDATE `authors` SET `FirstName`='" . $name . "',`LastName`='" . $lastname . "',`Nationality`='" . $nationality . "'WHERE AuthorId='" . $id . "'";
            
            $res = mysqli_query($dbConn, $query) or die('Error: ' . mysqli_error($dbConn));
            
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
?>

</body>
</html>