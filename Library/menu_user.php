<html>
    <head>
        <meta charset="UTF-8">
        <title>Библиотека</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <ul>
      <li><a href="home.php">НАЧАЛО</a></li>
      <li class="dropdown"><a href="#" class="dropbtn">КНИГИ</a>
          <div class="dropdown-content">
            <a href="book_registration.php">РЕГИСТРАЦИЯ</a>
            <a href="book_delete.php">ИЗТРИВАНЕ</a>
            <a href="book_update.php">РЕДАКТИРАНЕ</a>
            <a href="book_borrow.php">ЗАЕМАНЕ</a>
          </div>
      </li>
      <li class="dropdown"><a href="#" class="dropbtn">АВТОРИ</a>
          <div class="dropdown-content">
              <a href="author_registration.php">РЕГИСТРАЦИЯ</a>
            <a href="author_delete.php">ИЗТРИВАНЕ</a>
            <a href="author_update.php">РЕДАКТИРАНЕ</a>
          </div>
      </li>
      <li class="dropdown"><a  class="dropbtn">ЖАНР</a>
          <div class="dropdown-content">
            <a href="genre_registration.php">РЕГИСТРАЦИЯ</a>
            <a href="genre_delete.php">ИЗТРИВАНЕ</a>
            <a href="genre_update.php">РЕДАКТИРАНЕ</a>
           </div>
      </li>
      <li class="dropdown"><a  class="dropbtn">ИЗДАТЕЛСТВО</a>
          <div class="dropdown-content">
              <a href="publisher_registration.php">РЕГИСТРАЦИЯ</a>
            <a href="publisher_delete.php">ИЗТРИВАНЕ</a>
            <a href="publisher_update.php">РЕДАКТИРАНЕ</a>
           </div>
      </li>
      <li class="dropdown"><a href="#" class="dropbtn">ЧИТАТЕЛИ</a>
          <div class="dropdown-content">
            <a href="reader_registration.php">РЕГИСТРАЦИЯ</a>
            <a href="reader_delete.php">ИЗТРИВАНЕ</a>
            <a href="reader_update.php">РЕДАКТИРАНЕ</a>
          </div>
      </li>
      <li class="dropdown"><a href="#" class="dropbtn">СПРАВКИ</a>
          <div class="dropdown-content">
            <a href="query_no_return.php">СПРАВКА - Невърнати книги</a>
            <a href="query_books_borrow.php">СПРАВКА - Книги заети в период</a>
            <a href="query_addres_publisher.php">СПРАВКА - Издателства/Адрес</a>
            <a href="query_count_books_publishers.php">СПРАВКА - Брой книги от издателство</a>
            <a href="query_author_copies.php">СПРАВКА - Автор/Брой книги</a>
            <a href="query_reader_books_borrow.php">СПРАВКА -Читател/Заемани книги</a>
          </div>
      </li>
      <li><a href="logout.php">ИЗХОД</a></li> 
     </ul>
    </body>
</html>
