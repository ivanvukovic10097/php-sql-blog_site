<?php 
    header('Content-Type: text/html; charset=utf-8');

    $servername = "localhost";
    $username = "root";
    $password= "";
    $basename= "vijesti";

    $dbc = mysqli_connect($servername, $username, $password, $basename) or die('Error connecting to MySQL server'.mysqli_error());
    mysqli_set_charset($dbc, "utf-8");

	
	if(isset($_POST['prijava'])){
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$username = $_POST['username'];
		$lozinka = $_POST['pass'];
		$hashed_password = password_hash($lozinka, PASSWORD_BCRYPT);
		$razina = 0;
		$registriranKorisnik = '';
		
		$sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
		$stmt = mysqli_stmt_init($dbc);
		
		if (mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, 's', $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
		}
		if(mysqli_stmt_num_rows($stmt) > 0){
			$msg='Korisnicko ime vec postoji!';
		}
		else{
			$sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, razina)VALUES (?, ?, ?, ?, ?)";
			$stmt = mysqli_stmt_init($dbc);
			if (mysqli_stmt_prepare($stmt, $sql)) {
				mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
				mysqli_stmt_execute($stmt);
				$registriranKorisnik = true;
			}
		}
		mysqli_close($dbc);
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
    <main>
        <div class="wrapper1">
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-item">
                    <span id="porukaIme" class="bojaPoruke"></span>
                    <label for="title">First name: </label>
                    <div class="form-field">
                        <input type="text" name="ime" id="ime" class="form-fieldtextual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaPrezime" class="bojaPoruke"></span>
                    <label for="about">Last name: </label>
                    <div class="form-field">
                        <input type="text" name="prezime" id="prezime" class="formfield-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaUsername" class="bojaPoruke"></span>
                    <label for="content">Username:</label>
                    <div class="form-field">
                        <input type="text" name="username" id="username" class="formfield-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaPass" class="bojaPoruke"></span>
                    <label for="pphoto">Password: </label>
                    <div class="form-field">
                        <input type="password" name="pass" id="pass" class="formfield-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaPassRep" class="bojaPoruke"></span>
                    <label for="pphoto">Confirm password: </label>
                    <div class="form-field">
                        <input type="password" name="passRep" id="passRep" class="form-field-textual">
                    </div>
                </div>
                <br/>
                <div class="form-item">
                    <button class="link" type="submit" value="prijava" id="stil"><a href="administracija.php">Login</a></button>
                    <button type="submit" value="Prijava" name="prijava" id="slanje">Register</button>
                </div>   
            </form>
        </div>
        <script type="text/javascript">
            document.getElementById("slanje").onclick = function(event) { 
                var slanjeForme = true;
                var poljeIme = document.getElementById("ime");
                var ime = document.getElementById("ime").value;
                if (ime.length == 0) {
                    slanjeForme = false;
                    poljeIme.style.border="1px dashed red";
                    poljeIme.style.boxShadow="0 0 7px #fff300";
                    porukaIme.style.color="red";
                    document.getElementById("porukaIme").innerHTML="<br>Input First Name!<br>";
                } else {
                    poljeIme.style.border="1px solid #fff300";
                    document.getElementById("porukaIme").innerHTML="";
                }
                var poljePrezime = document.getElementById("prezime");
                var prezime = document.getElementById("prezime").value;
                if (prezime.length == 0) {
                    slanjeForme = false;
                    poljePrezime.style.border="1px dashed red";
                    poljePrezime.style.boxShadow="0 0 7px #fff300";
                    porukaPrezime.style.color="red";
                    document.getElementById("porukaPrezime").innerHTML="<br>Input Last Name!<br>";
                } else {
                    poljePrezime.style.border="1px solid #fff300";
                    document.getElementById("porukaPrezime").innerHTML="";
                }
                var poljeUsername = document.getElementById("username");
                var username = document.getElementById("username").value;
                if (username.length == 0) {
                    slanjeForme = false;
                    poljeUsername.style.border="1px dashed red";
                    poljeUsername.style.boxShadow="0 0 7px #fff300";
                    porukaUsername.style.color="red";
                    document.getElementById("porukaUsername").innerHTML="<br>Input Username!<br>";
                   
                } else {
                    poljeUsername.style.border="1px solid #fff300";
                    document.getElementById("porukaUsername").innerHTML="";
                }
                var poljePass = document.getElementById("pass");
                var pass = document.getElementById("pass").value;
                var poljePassRep = document.getElementById("passRep");
                var passRep = document.getElementById("passRep").value;
                if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                    slanjeForme = false;
                    poljePass.style.border="1px dashed red";
                    poljePassRep.style.border="1px dashed red";
                    poljePass.style.boxShadow="0 0 7px #fff300";
                    poljePassRep.style.boxShadow="0 0 7px #fff300";
                    porukaPass.style.color="red";
                    porukaPassRep.style.color="red";
                    document.getElementById("porukaPass").innerHTML="<br>Passwords do not match!<br>";
                    document.getElementById("porukaPassRep").innerHTML="<br>Passwords do not match!<br>";
                    return false;
                } else {
                    poljePass.style.border="1px solid #fff300";
                    poljePassRep.style.border="1px solid #fff300";
                    document.getElementById("porukaPass").innerHTML="";
                    document.getElementById("porukaPassRep").innerHTML="";
                }
            }
            if (slanjeForme != true) {
                event.preventDefault();
            }
        </script>
    </main>
    <footer>
        <div>
            <p>Ivan Vuković ©2019 ivukovic@tvz.hr</p>
        </div>
    </footer>
</body>
</html>