<?php

    include("config.php");
    include_once('includes/ujian.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Ujian = new Ujian($db);
    $Ujian->id_ujian = $id;

    if($Ujian->delete()){
        echo "<script>location.href='ujian.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='ujian.php';</script>";
    }

?>
