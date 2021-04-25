<html>
    <head>
        <meta charset="UTF-8">
        <title>Библиотека</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
	include "config.php";
	include "menu.php";
    ?>

    <form name="log" method="POST">
    <br>

    <table align="center" class='customTable'>
    <tr>
    <th align="center"><font color="white"><b>Потребителско име: </b></th>
    <td><input type="text" name="username"></td> 
    </tr>
    <tr>
    <th align="center" bgcolor="#3d293d" ><font color="white"><b> Парола: </b></font></th>
    <td><input type="password" name="password"></td> 
    </tr>
    <tr>
    <th></th>
    <td><center><input type="submit" name="submit" value="Вход"></center></td> 
    </tr>
    </table>
    </form>
    <?php
        if (isset($_POST['submit']))
        {   
            $username=$_POST['username']; 
            $password=$_POST['password'];
            if (!empty($username) and !empty($password))
             {    
                    $sql="SELECT * FROM user WHERE username='$username' and password='$password'";
                    $result = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
                    
                    if (mysqli_num_rows($result)==1)
                    {	
                        header('Location: menu_user.php');
                    }
                    else
                    {
                        echo "<h3> Некоректно потребителско име или парола.</h3>";
                    }
            }
            else
            {
                echo "<h3>Празно потребителско име или парола.</h3>";
            }
        }
    ?>
    </body>
</html>

