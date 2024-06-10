<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: /main/mylibrary");
    exit();
}

$condir = "/conn/connect.php";
include($_SERVER['DOCUMENT_ROOT'] . $condir);

$userNow = $_SESSION['id'];

$id = $_GET['id'];

$SQLcheckOwner = "SELECT author_id,cover FROM karya WHERE id=$id";
$checkOwnRAW = $connect->query($SQLcheckOwner);
$owner = $checkOwnRAW->fetch_assoc();
$ownerid = $owner['author_id'];

if ($ownerid != $userNow) {
    header("Location: /main/mylibrary");
    exit();
}

$coverDefault = $_SERVER['DOCUMENT_ROOT'] . "/image/cover/no_cover.png";
$cover = $_SERVER['DOCUMENT_ROOT'] . "/image/cover/" . $owner['cover'];

$delete = mysqli_query($connect, "DELETE FROM karya WHERE id=$id");

if ($delete)
    if ($cover != $coverDefault) {
        unlink($cover);
    }
    header("Location: /main/mylibrary");
    exit();
?>