<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tetobitna</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    <body>
        <?php include_once 'navigacija.php'; ?>
        <div class="sadrzaj">
            <h2>Naša lokacija</h2>
            <div class="mapouter"><div class="gmap_canvas"><iframe width="775" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=kri%C5%A1ka%2030&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>.mapouter{position:relative;text-align:right;height:500px;width:775px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:775px;}</style></div></div><br><br>
            <div>
                <form action="#" method="POST">
                    Ime:*<br>
                    <input type="text" name="ime" required><br>
                    Prezime:*<br>
                    <input type="text" name="prezime" required><br>
                    Email:*<br>
                    <input type="email" name="email" required><br>
                    Država:*<br>
                    <select name="drzava">
                        <option value="RH" selected>Hrvatska</option>
                        <option value="BiH">Bosna i Hercegovina</option>
                        <option value="RS">Srbija</option>
                    </select><br>
                    <input type="submit" value="Pošalji">
                </form>
            </div>
        </div>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
