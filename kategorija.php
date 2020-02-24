<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="icon" href="favicon.jpg" type="image/ico"/> 
    <title>Category</title>
</head>
<body>
    <header>
        <div class="sad">
            <a href="index.php" title="Sopitas.com/Category" class="logo"><img src="logo.png" width="120" alt=""/></a>
            <nav>
                <ul>
                    <li><a href="index.php" class="navi">HOME</a></li>
                    <li><a href="kategorija.php?kategorija=Music" class="navi">MUSIC</a></li>
                    <li><a href="kategorija.php?kategorija=Sport" class="navi">SPORT</a></li>
                    <li><a href="unos.php" class="navi">RECORD</a></li>
                    <li><a href="administracija.php" class="navi">ADMINISTRATION</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="prva">
        <article class="prvi">
            <div class="wrapper">
            <?php
            include 'connection.php';
            $kategorija = $_GET['kategorija'];
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija'";
            $result = mysqli_query($dbc, $query); 
            $i=0;
            while($row = mysqli_fetch_array($result)) {
                echo '<figure class="fig">';
                echo '<img src="' . 'img/'. $row['slika'] . '" width="300" alt="" class="post">';
                echo '<figcaption>';
                echo '<a href="clanak.php?id='.$row['id'].'" class="opis">';
                echo $row['naslov']; 
                echo '</a><section class="datum">';
                echo $row['datum'];
                echo'</section>';
                echo '</figcaption>';
                echo '</figure>'; 
            }
            ?>  
            </div>
        </article>
    </section>
    <footer>
        <div>
            <p>Ivan Vuković ©2019 ivukovic@tvz.hr</p>
        </div>
    </footer>
</body>
</html>