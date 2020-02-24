<?php
    include 'connection.php';
    define('UPLPATH', 'img/');
    $id = $_GET['id'];
    $query = "SELECT datum, naslov, sazetak, tekst, slika, kategorija FROM vijesti WHERE id=$id";
	$result = mysqli_query($dbc,$query);
	while ($row = mysqli_fetch_array($result))
	{
        $date=$row["datum"];
        $title=$row["naslov"];
        $summary=$row["sazetak"];
        $report=$row["tekst"];
        $img=$row["slika"];
        $category=$row["kategorija"];
    }
    mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="icon" href="favicon.jpg" type="image/ico"/> 
    <title><?php echo"$title";?></title>
</head>
<body>
    <header>
             <div class="sad">
                <a href="index.php" title="Sopitas.com/Data Record/Entry" class="logo"><img src="logo.png" width="120" alt=""/></a>
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
        <div id="omota1">
            <article class="clanak1">
                <h1><?php echo $category;?></h1>
                <section> <?php echo "<img src='img/$img'"; ?> </section> 
                <h3><?php echo $title;?></h3>
                <section class="datum"> <?php echo $date; ?> </section> 
                <section> <h5> <?php echo $summary; ?> </h5> </section> 
                <section> <p> <?php echo $report; ?> </p> </section>
            </article>
        </div>
    <footer>
            <div>
                <p>Ivan Vuković ©2019 ivukovic@tvz.hr</p>
            </div>
    </footer>
</body>
</html>
