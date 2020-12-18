<?php

    include("config.php");
    include_once('includes/penguji.inc.php');
    include_once('includes/user.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID USER.');

    $Penguji = new Penguji($db);
    $Penguji->id_penguji = $id;

    $User = new User($db);
    $User->id_user = $id_user;

    if($Penguji->delete() && $User->delete()){
        echo "<script>location.href='penguji.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='penguji.php';</script>";
    }

?>
