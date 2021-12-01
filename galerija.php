<?php include 'kod.php'; ?>
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
            <h1>Galerija slika</h1>
            <div>
                <?php
                $sql = "SELECT * from slike";
                $sli = $c->query($sql);
                while ($slika = mysqli_fetch_array($sli)){
                    echo '<div class="galerija"><img src="data:image/jpeg;base64,'.base64_encode( $slika['slika'] ).'"/></div>';
                }
                ?>
            </div>
        </div>
        <br>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>