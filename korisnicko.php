<?php include 'kod.php'; ?>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prva zadaća</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    <body>
        <?php
        include_once 'navigacija.php';
        if(isset($_POST['naslov'])){
            $tekst = addslashes($_POST['tekst']);
            $sql = "INSERT INTO vijesti (naslov, tekst, datum) VALUES ('".$_POST['naslov']."', '".$_POST['tekst']."', '".date("Y-m-d")."')";
            $c->query($sql);
            
            $sql = "SELECT id FROM vijesti WHERE id=(SELECT max(id) FROM vijesti)";
            $r = $c->query($sql);
            $i = $r->fetch_assoc();
            $id = $i['id'];
            
            if (count($_FILES) > 0){
                if (is_uploaded_file($_FILES['slika']['tmp_name'])) {
                    $slikaPodaci = addslashes(file_get_contents($_FILES['slika']['tmp_name']));
                    
                    $sql = "INSERT INTO slike(slika, vijest) VALUES('".$slikaPodaci."', ".$id.")";
                    $c->query($sql);
                }
            }
            echo '<h3>Vijest će se pojaviti na stranici kada/ako ju odobri aministrator.</h3>';
        }
        else{
        ?>
            <div class="forma">
                <form method="POST" action="korisnicko.php?x=10" enctype="multipart/form-data">
                    Naslov:<br>
                    <input type="text" name="naslov"><br>
                    Tekst:<br>
                    <textarea id="tekst" name="tekst" rows="10" cols="100">Tu piši...</textarea><br><br>
                    Učitaj sliku za članak <input name="slika" type="file" /><br>
                    <input type="submit" name="submit" value="Pošalji vijest na odobrenje">
                </form>
            </div>
        <?php } ?>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>