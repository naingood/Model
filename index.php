<?php

//definisi
require('User.php');
require('Role.php');
require('Notif.php');
require('Komisi.php');
require('Keranjang.php');
require('Affiliasi.php');

// definisi role 
$distributor= new Role('distributor',0.25);
$agen= new Role('agen',0.15);
$normal= new Role('normal',0);
$yosia= new User('yosia', $agen);

//app

// Registrasi user
$user= new User('wildan', $distributor );
$user->set_sponsor($yosia);

// Mulai belanja
$user->belanja(new Keranjang(1, 3600000));
$user->belanja(new Keranjang(1, 1500000));

?>

