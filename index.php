<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="icon" href="favicon.jpg" type="image/ico"/> 
    <title>Sopitas.com</title>
</head>
<body>
    <header>
        <div class="sad">
            <a href="index.php" title="Sopitas.com" class="logo"><img src="logo.png" width="120" alt=""/></a>
            <nav>
                <ul>
                    <li><a href="index.php" class="navi">HOME</a></li>
                    <li><a href="kategorija.php?kategorija=Music" class="navi">MUSIC</a></li>
                    <li><a href="kategorija.php?kategorija=Sport" i" class="navi">SPORT</a></li>
                    <li><a href="unos.php" class="navi">RECORD</a></li>
                    <li><a href="administracija.php" class="navi">ADMINISTRATION</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="prva">
        <article class="prvi">
            <div class="st"><h2>MUSIC</h2></div>
            <div class="wrapper">
            <?php
            include 'connection.php';
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Music' LIMIT 3"; 
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
    <section class="druga">
        <article class="drugi">
            <div class="st"><h2>SPORT</h2></div>
            <div class="wrapper">
            <?php
            include 'connection.php';
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Sport' LIMIT 3"; 
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