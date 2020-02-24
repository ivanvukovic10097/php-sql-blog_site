<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="icon" href="favicon.jpg" type="image/ico"/> 
    <title>Data Record</title>
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
        <form enctype="multipart/form-data" action="skripta.php" method="POST">
            <br/><span id="porukaTitle" class="bojaPoruke"></span><br/>
            Title of the news<br/>
            <input type=text name="ntitle" id="ntitle" size="54"/>
            <br/><span id="porukaAbout" class="bojaPoruke"></span><br/>Short summary of the news:<br/>
            <label><textarea name="nsummary" id="nsummary" rows="4" cols="50"></textarea></label>
            <br/><span id="porukaContent" class="bojaPoruke"></span><br/>Detailed report of the news:<br/>
            <label><textarea name="nreport" id="nreport" rows="10" cols="50"></textarea></label>
            <span id="porukaSlika" class="bojaPoruke"></span>
            <br/>Image of the news:<br/>
            <input type="file" name="slika" id="slika"/>
            <br/><span id="porukaKategorija" class="bojaPoruke"></span><br/>Category:<br/>
            <select name="ncategory" id="ncategory">
                <option value="e" hidden>SELECT</option>
                <option value="Sport">SPORT</option>
                <option value="Music">MUSIC</option>
            </select>
            <br/>Save to archive:<br/>
            <input type="checkbox" name="archive" id="archive"><br/>
            <button type="reset" value="Cancel">Cancel</button>
            <button type="submit" value="Submit" id="slanje" name="slanje">Submit</button>
        </form>
        <script type="text/javascript">
            document.getElementById("slanje").onclick = function(event) {

            var slanjeForme = true;
            var poljeTitle = document.getElementById("ntitle");
            var title = document.getElementById("ntitle").value;
            if (title.length < 5 || title.length > 30) {
            slanjeForme = false;
            poljeTitle.style.border="1px dashed red";
            poljeTitle.style.boxShadow="0 0 7px #fff300";
            porukaTitle.style.color="red";
            document.getElementById("porukaTitle").innerHTML="News title has to be between 5 and 30 letters!";
			} else {
            poljeTitle.style.border="1px solid #fff300";
            document.getElementById("porukaTitle").innerHTML="";
            }

            var poljeAbout = document.getElementById("nsummary");
            var about = document.getElementById("nsummary").value;
            if (about.length < 10 || about.length > 100) {
            slanjeForme = false;
            poljeAbout.style.border="1px dashed red";
            poljeAbout.style.boxShadow="0 0 7px #fff300";
            porukaAbout.style.color="red";
            document.getElementById("porukaAbout").innerHTML="Short summary has to be between 10 and 100 letters!";
			} else {
            poljeAbout.style.border="1px solid #fff300";
            document.getElementById("porukaAbout").innerHTML="";
            }

            var poljeContent = document.getElementById("nreport");
            var content = document.getElementById("nreport").value;
            if (content.length == 0) {
            slanjeForme = false;
            poljeContent.style.border="1px dashed red";
            poljeContent.style.boxShadow="0 0 7px #fff300";
            porukaContent.style.color="red"
            document.getElementById("porukaContent").innerHTML="Detalied report has to be input!";
			} else {
            poljeContent.style.border="1px solid #fff300";
            document.getElementById("porukaContent").innerHTML="";
            }

            var poljeSlika = document.getElementById("slika");
            var pphoto = document.getElementById("slika").value;
            if (pphoto.length == 0) {
            slanjeForme = false;
            poljeSlika.style.border="1px dashed red";
            poljeSlika.style.boxShadow="0 0 7px #fff300";
            porukaSlika.style.color="red";
            document.getElementById("porukaSlika").innerHTML="Image of the news has to be chosen!";
			} else {
            poljeSlika.style.border="1px solid #fff300";
            document.getElementById("porukaSlika").innerHTML="";
            }

            var poljeCategory = document.getElementById("ncategory");
            if(document.getElementById("ncategory").selectedIndex == 1 || document.getElementById("ncategory").selectedIndex == 2) {
                poljeCategory.style.border="1px solid #fff300";
                document.getElementById("porukaKategorija").innerHTML="";
			} else {
                slanjeForme = false;
                poljeCategory.style.border="1px dashed red";
                poljeCategory.style.boxShadow="0 0 7px #fff300";
                porukaKategorija.style.color="red";
                document.getElementById("porukaKategorija").innerHTML="Category has to be chosen!";
            }

            if (slanjeForme != true) {
            event.preventDefault();
            }
        };
    </script>
    <footer>
        <div>
            <p>Ivan Vuković ©2019 ivukovic@tvz.hr</p>
        </div>
    </footer>
</body>
</html>