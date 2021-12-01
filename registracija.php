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
        <div class="forma">
            <form method="POST" action="navigacija.php?x=7">
                Ime:*<br>
                <input type="text" name="ime" required><br>
                Prezime:*<br>
                <input type="text" name="prezime" required><br>
                E-mail adresa:*<br>
                <input type="email" name="email" required><br>
                Država:*<br>
                <select name="drzava" id="drzava" required>
                <?php
                $sql = "SELECT ime2 FROM drzave";
                $r = $c->query($sql);
                if ($r->num_rows > 0) {
                    while($row = $r->fetch_assoc()){
                        echo '<option value="'.$row['ime2'].'">'.$row['ime2'].'</option>';
                    }
                }
                ?>
                </select><br>
                Grad:<br>
                <input type="text" name="grad"><br>
                Ulica:<br>
                <input type="text" name="ulica"><br>
                Datum rođenja:*<br>
                <input type="date" name="datum" required><br>
                Lozinka:*<br>
                <input type="password" name="lozinka" required><br>
                <input type="submit" name="submit" value="Registracija">
            </form>
        </div>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>