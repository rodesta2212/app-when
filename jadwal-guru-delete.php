<?php

    include("config.php");
    include_once('includes/jadwal-guru.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $JadwalGuru = new JadwalGuru($db);
    $JadwalGuru->id_jadwal_guru = $id;

    if($JadwalGuru->delete()){
        echo "<script>location.href='jadwal-guru-admin.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='jadwal-guru-admin.php';</script>";
    }

?>
