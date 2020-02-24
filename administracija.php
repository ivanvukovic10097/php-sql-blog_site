<?php
    session_start();
    define('UPLPATH', 'img/');
    include 'connection.php';
    $uspjesnaPrijava = false;
    if (isset($_POST['prijava'])) {  
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik
    WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);
    if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;
        if ($levelKorisnika == 1) {
        $admin = true;
        }
        else {
        $admin = false;
        }
        $_SESSION['$username'] = $imeKorisnika;
        $_SESSION['$level'] = $levelKorisnika;
        } else {
                $uspjesnaPrijava = false;
            }       
    }
    if(isset($_POST['delete'])) {
        $id=$_POST['id'];
        $query = "DELETE FROM vijesti WHERE id=$id";
        $result = mysqli_query($dbc, $query);
    }
    if(isset($_POST['update'])) {
        include 'connection.php';
        $img = $_FILES["slika"]['name'];
        $title = $_POST["ntitle"];
        $summary = $_POST["nsummary"];
        $report = $_POST["nreport"];
        $category = $_POST["ncategory"];
        if(isset($_POST['archive'])) {
            $archive = 1;
        } else {
            $archive = 0;
        }

        $target = 'img/'.$img;
        move_uploaded_file($_FILES["slika"]['tmp_name'], $target);
        $id = $_POST["id"];
        $query = "UPDATE vijesti SET naslov='$title', sazetak='$summary', tekst='$report', slika='$img', kategorija='$category', arhiva='$archive' WHERE id=$id";
        $result = mysqli_query($dbc, $query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="icon" href="favicon.jpg" type="image/ico"/> 
    <title>Administration</title>
</head>
<body>
    <header>
        <div class="sad">
            <a href="index.php" title="Sopitas.com/Administration" class="logo"><img src="logo.png" width="120" alt=""/></a>
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
            if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) { 
                if (($uspjesnaPrijava == true && $admin == true) ||(isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
                    $query = "SELECT * FROM vijesti";
                    $result = mysqli_query($dbc, $query);
                    echo '<div class="logout"> <p>Welcome ' . $_SESSION['$username'] . '! You are currently logged on as local administrator.</p>
                    <a href="logout.php">Logout</a></div>';
                    while($row = mysqli_fetch_array($result)) {
                        echo '<form action="" method="post" enctype="multipart/form-data">
                        <div class="form-item">
                            <span id="porukaTitle'.$row["id"].'" class="bojaPoruke"></span>
                            <label for="ntitle" class="ntitle">Title of the news</label>
                        <div class="form-field">
                            <input type="text" name="ntitle" size="54" id="ntitle'.$row["id"].'" class="form-field-textual" value="'.$row['naslov'].'">
                        </div>
                        </div>
                        <div class="form-item">
                            <label for="nsummary">Short summary of the news:(50 letters)</label>
                        <div class="form-field">
                            <span id="porukaAbout'.$row["id"].'" class="bojaPoruke"></span>
                            <textarea name="nsummary" id="nsummary'.$row["id"].'" rows="4" cols="50" class="form-field-textual">'.$row['sazetak'].'</textarea>
                        </div>
                        </div>
                        <div class="form-item">
                            <label for="nreport">Detailed report of the news:</label>
                            <span id="porukaContent'.$row["id"].'" class="bojaPoruke"></span>
                            <div class="form-field">
                                <textarea name="nreport" id="nreport'.$row["id"].'" rows="10" cols="50" class="form-field-textual">'.$row['tekst'].'</textarea>
                            </div>
                        </div>
                        <div class="form-item">
                            <span id="porukaSlika'.$row["id"].'" class="bojaPoruke"></span>
                            <label for="slika" >Image of the news: </label>
                            <div class="form-field">
                                <input type="file" name="slika" id="slika'.$row["id"].'" class="input-text" accept="image/x-png,image/gif,image/jpeg" value="'.$row['slika'].'"><br><br><img width="380" src="'.UPLPATH . $row['slika'].'">
                            </div>
                        </div>
                        <div class="form-item">
                            <span id="porukaKategorija'.$row["id"].'" class="bojaPoruke"></span>
                            <label for="ncategory">Category:</label>
                            <div class="form-field">
                                <select name="ncategory" id="ncategory'.$row["id"].'" class="form-field-textual" value="'.$row['kategorija'].'">
                                    <option value="e" hidden>SELECT</option>
                                    <option value="Sport">SPORT</option>
                                    <option value="Music">MUSIC</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-item">
                            <label>Save to archive:
                                <div class="form-field">';
                                    if($row['arhiva'] == 0) {
                                        echo '<input type="checkbox" name="archive" id="archive'.$row["id"].'" /> Archive';
                                    } else {
                                        echo '<input type="checkbox" name="archive" id="archive'.$row["id"].'" checked/> Archive?';
                                    } 
                                    echo '
                                </div>
                            </label>
                        </div>
                        <div class="form-item">
                                <input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'">
                                <button type="reset" value="Cancel">Cancel</button>
                                <button type="submit" name="update"  id="slanje'.$row["id"].'" value="Prihvati">Update</button>
                                <button type="submit" name="delete" value="Izbriši">Delete</button>
                        </div>
                        </form>
                        <script type="text/javascript">
                            document.getElementById("slanje'.$row["id"].'").onclick = function(event) {
                            var slanjeForme = true;
                            var poljeTitle = document.getElementById("ntitle'.$row["id"].'");
                            var title = document.getElementById("ntitle'.$row["id"].'").value;
                            if (title.length < 5 || title.length > 30) {
                            slanjeForme = false;
                            poljeTitle.style.border="1px dashed red";
                            document.getElementById("porukaTitle'.$row["id"].'").innerHTML="News title has to be between 5 and 30 letters!<br>";
                            } else {
                            poljeTitle.style.border="1px solid #fff300";
                            document.getElementById("porukaTitle'.$row["id"].'").innerHTML="";
                            }
                            var poljeAbout = document.getElementById("nsummary'.$row["id"].'");
                            var about = document.getElementById("nsummary'.$row["id"].'").value;
                            if (about.length < 10 || about.length > 100) {
                            slanjeForme = false;
                            poljeAbout.style.border="1px dashed red";
                            document.getElementById("porukaAbout'.$row["id"].'").innerHTML="Short summary has to be between 10 and 100 letters!<br>";
                            } else {
                            poljeAbout.style.border="1px solid #fff300";
                            document.getElementById("porukaAbout'.$row["id"].'").innerHTML="";
                            }
                            var poljeContent = document.getElementById("nreport'.$row["id"].'");
                            var content = document.getElementById("nreport'.$row["id"].'").value;
                            if (content.length == 0) {
                            slanjeForme = false;
                            poljeContent.style.border="1px dashed red";
                            document.getElementById("porukaContent'.$row["id"].'").innerHTML="Detalied report has to be input!<br>";
                            } else {
                            poljeContent.style.border="1px solid #fff300";
                            document.getElementById("porukaContent'.$row["id"].'").innerHTML="";
                            }
                            var poljeSlika = document.getElementById("slika'.$row["id"].'");
                            var slika = document.getElementById("slika'.$row["id"].'").value;
                            if (slika.length == 0) {
                            slanjeForme = false;
                            poljeSlika.style.border="1px dashed red";
                            document.getElementById("porukaSlika'.$row["id"].'").innerHTML="Image of the news has to be chosen! <br>";
                            } else {
                            poljeSlika.style.border="1px solid #fff300";
                            document.getElementById("porukaSlika'.$row["id"].'").innerHTML="";
                            }
                            var poljeCategory = document.getElementById("ncategory'.$row["id"].'");
                            if(document.getElementById("ncategory'.$row["id"].'").selectedIndex == 1 || document.getElementById("ncategory'.$row["id"].'").selectedIndex == 2) {
                            poljeCategory.style.border="1px solid #fff300";
                            document.getElementById("porukaKategorija'.$row["id"].'").innerHTML="";
                            } else {
                            slanjeForme = false;
                            poljeCategory.style.border="1px dashed red";
                            document.getElementById("porukaKategorija'.$row["id"].'").innerHTML="Category has to be chosen!<br>";
                            }
                            if (slanjeForme != true) {
                            event.preventDefault();
                            }
                        }
                        </script>';        
                        }
                    }
            }
            else if ($uspjesnaPrijava == true && $admin == false) {
            echo '<div class="logout"><p>Welcome ' . $imeKorisnika . '! Login successful! No admin rights.</p>
            <a href="logout.php">Logout</a></div>';
            } 
            else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
            echo '<div class="logout"><p>Welcome ' . $_SESSION['$username'] . '! Login successful! No admin rights.</p>
            <a href="logout.php">logout</a></div>';
            } 
            else if ($uspjesnaPrijava == false) {
                echo '
                        <form action="administracija.php" method="POST" enctype="multipart/form-data" class="log">
                            <div class="wrapper">
                                <div class="item">
                                    <br>
                                    <span id="porukaUsername" class="bojaPoruke"></span>
                                    <label for="username">Username:</label>
                                    <div class="form-field">
                                        <input type="text" name="username" id="username" class="form-field-textual">
                                    </div>
                                    <br>
                                    <div class="item">
                                        <span id="porukaPass" class="bojaPoruke"></span>
                                        <label for="lozinka">Password:</label>
                                        <div class="form-field">
                                            <input type="password" name="lozinka" id="pass" class="form-field-textual">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="prijavaForma">
                                        <button type="submit" value="prijava" id="slanje" name="prijava">Login</button>
                                        <button class="link" type="submit" value="prijava" id="stil"><a href="registracija.php">Register</a></button>
                                    </div>
                                    
                                <br>
                            </div>
                        </form>
                        <script type="text/javascript">
                            document.getElementById("slanje").onclick = function(event) {
                                
                                var slanjeForme = true;
                                
                                var poljeUsername = document.getElementById("username");
                                var username = document.getElementById("username").value;
                                if (username.length == 0) {
                                    slanjeForme = false;
                                    poljeUsername.style.border="1px dashed red";
                                    porukaUsername.style.color="red";
                                    document.getElementById("porukaUsername").innerHTML="<br>Input Username!<br>";
                                }
                                else {
                                    poljeUsername.style.border="1px solid #fff300";
                                    document.getElementById("porukaUsername").innerHTML="";
                                }
                                
                                var poljePassword = document.getElementById("pass");
                                var username = document.getElementById("pass").value;
                                if (username.length == 0) {
                                    slanjeForme = false;
                                    poljePassword.style.border="1px dashed red";
                                    porukaPass.style.color="red";
                                    document.getElementById("porukaPass").innerHTML="<br>Input password!<br>";
                                }
                                else {
                                    poljePassword.style.border="1px solid #fff300";
                                    document.getElementById("porukaPassword").innerHTML="";
                                }
                                
                                if (slanjeForme != true) {
                                    event.preventDefault();
                                }
                            }
                        </script>';     
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