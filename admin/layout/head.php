<?php
session_start();
if (isset($_SESSION['isAdmin']) == false){
    header('location:index.php');
}
$filepath = realpath(dirname(__FILE__));


include_once $filepath.'/../config/config.php';
include_once $filepath.'/../libraries/Database.php';
include_once $filepath.'/../helpers/Helper.php';
include_once $filepath.'/../helpers/Notify.php';
include_once $filepath.'/../helpers/SlugHelper.php';

/*load modules class file*/
spl_autoload_register(function ($class){
    global $filepath;
   include_once $filepath.'/../classes/'.$class.'.php';
});


$category  = new Category();
$tag       = new Tag();
$post      = new Post();

$helper = new Helper();

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog|Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!--dropify css-->
    <link rel="stylesheet" href="assets/dropify/dist/css/dropify.css">
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>