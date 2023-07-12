<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo PROJECT_TITLE; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg">

    <!-- CSS 
    ========================= -->

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>plugins.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.min.css
" rel="stylesheet">
    <style>
        .disableClass {
            opacity: 0.5;
            pointer-events: none;
        }

        .waitingClass {
            color: orange;
        }

        .successClass {
            color: green;
        }

        .failClass {
            color: red;
        }
    </style>
</head>