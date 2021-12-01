<?php
include 'kod.php';

$sql = "SELECT * FROM korisnik WHERE email='".$_POST['email']."'";
$r = $c->query($sql);
if($r->num_rows > 0){
    $korisnik = $r->fetch_assoc();
    
    if($korisnik['odobren'] == 0){
        header("Location: prijava.php?x=7&p=o");
    }
    else if(password_verify($_POST['lozinka'], $korisnik['lozinka'])){
        session_start();
        $_SESSION['korisnicko'] = $korisnik['korisnicko'];
        $_SESSION['uloga'] = $korisnik['uloga'];
        
        header("Location: navigacija.php?x=1");
    }
    else{
        header("Location: prijava.php?x=7&p=l");
    }
}
else{
    header("Location: prijava.php?x=7&p=e");
}

$c->close();
?>