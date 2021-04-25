<?php
        function test_input($data)
        {
                $data = trim($data);//Премахва знаци в началото и края на низ.
                $data = stripslashes($data);//Премахва екранирането на екраниран низ.
                $data = htmlspecialchars($data);//Преобразува специални знаци в HTML единици.
                return $data; //Връща, като резултат стойността на променливата $data
        }
        //Актуализира данните за жанр по зададен номер на жанр.
        function update_data($GenreId, $Type, $dbConn)
        {
          $query = "UPDATE genre SET Type='".$Type."' WHERE GenreId='".$GenreId."'"; 
          $result=mysqli_query($dbConn,$query)or die ('Error: '.mysqli_error($dbConn));
        }
        //Изтрива данните за жанр по зададен номер на жанр.
        function delete_data($GenreId, $dbConn)
        {
          $query = "DELETE FROM genre WHERE GenreId='".$GenreId."'"; 
          $result=mysqli_query($dbConn,$query)or die ('Error: '.mysqli_error($dbConn));
        }
?>


	