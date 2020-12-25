<?php

    include("config.php");
    include_once('includes/jadwal-ujian.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $JadwalUjian = new JadwalUjian($db);
    $JadwalUjian->id_JadwalUjian = $id;

    if($JadwalUjian->delete()){
        echo "<script>location.href='jadwal-ujian.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='jadwal-ujian.php';</script>";
    }

?>
