<?php

    include("config.php");
    include_once('includes/jadwal-guru.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $JadwalGuru = new JadwalGuru($db);
    $JadwalGuru->id_JadwalGuru = $id;

    if($JadwalGuru->delete()){
        echo "<script>location.href='jadwal-guru.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='jadwal-guru.php';</script>";
    }

?>
