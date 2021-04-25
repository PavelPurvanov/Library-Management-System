<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Библиотека</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
        //Включване на файл.
        include "menu.php";
        include "config.php";
        include "functions.php";
        $e_mail=$e_mailError="";
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            if (empty($_POST['e_mail']))
            {   
                $e_mailError = "Въведете e-mail.";
            }
            else
            {
                $e_mail = test_input($_POST['e_mail']);
                if (!preg_match("/^[a-zA-Z]{1}[a-zA-Z0-9_\-\.]*@[a-zA-Z]*\.[a-zA-Z]{2,4}$/",$e_mail))
                {   
                    $e_mailError = "Въведете коректен e-mail."; 
                }
            }
        }
    ?>
   
    <form name="registration" method="POST"  accept-charset='UTF-8'> 
    <br>
    <table align="center" class='customTable'>
    <tr>
    <th align="center" ><span class="error">*</span>Потребителско име:</th>
    <td><input name="username" type="text"  size="30" ></td> 
    </tr>
    <tr>
    <th align="center"><span class="error">*</span>Парола:</th>
    <td><input name="password" type="password"  size="30" ></td>
    </tr>
    <tr>
    <th align="center"><span class="error">*</span>Повтори парола:</th>
    <td><input name="cpass" type="password" size="30"></td>
    </tr>
    <tr>
    <th align="center"><span span class="error">*</span>E-mail:</th>
    <td><input name="e_mail" type="text" class="e_mail" size="30" ></td>
    </tr>
    <tr>
    <th align="center" ><span class="error">*</span>Име: </th>
    <td><input name="name" type="text" size="30"></td>
    </tr>
    <tr>
    <th align="center" ><span class="error">*</span>Фамилия:</th>
    <td><input name="last_name" type="text" size="30"></td>
    </tr>
    <tr>
    <th></th>
    <td><center><input type="submit" name="submit" value="Регистрация"/> <center></td>
    </tr>
    </table>
    </form>
    <?php
    if (isset($_POST['submit'])){
            $user = $_POST['username'];
            $name = $_POST['name'];
            $last_name = $_POST['last_name'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];
            $e_mail = $_POST['e_mail'];

            if (!empty($user) && !empty($name)&& !empty($last_name) && !empty($pass) && !empty($cpass)&& !empty($e_mail))
            {   
                $sql="SELECT * FROM user WHERE username='$user'";
                $result = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
               
                if (mysqli_num_rows($result)==1)
                {
                    echo "<h3>Потребителското име е заето!</h3>";
                }
                else
                {              
                    if (strlen($e_mailError)==0)
                    {  
                        if (strlen($pass)>4)
                        {   
                            if($pass===$cpass)
                            {   
                                $query = "INSERT INTO user (UserName,Password,Email,FirstName,LastName) VALUES('$user','$pass','$e_mail','$name','$last_name')";
                                $result=mysqli_query($dbConn,$query) or die ('Error: ' .mysqli_error($dbConn));	 
                               
                                header("Location: index.php");
                            }
                            else
                            {
                                echo "<h3>Въведете една и съща парола!!!</h3>";
                            }
                        }
                        else
                        {
                            echo "<h3>Паролата трябва да е повече от четири символа.</h3>";

                        }
                    }
                }
            }
            else
            {
                echo "<h3>Попълнете всички полета!!!</h3>";
            }
    }
    ?>
    </body>
</html>
