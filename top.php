<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Zoe Silverman">
        <meta name="description" content="Presidential Pets">

        <title>Presidental Pets</title>

        <link rel="stylesheet" 
            href="css/custom.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="stylesheet" media="(max-width:800px)"
            href="css/tablet.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="stylesheet" media="(max-width:600px)"
            href="css/phone.css?version=<?php print time(); ?>"
            type="text/css">

    <?php
    print '<!-- ***** include libraries ***** -->';
    include 'lib/constants.php';
    
    print '<!-- make Database connections -->';
    require_once(LIB_PATH . '/Database.php');
    $thisDatabaseReader = new Database('zsilverm_reader', 'r', 'ZSILVERM_cs148_final');
    $thisDatabaseWriter = new Database('zsilverm_writer', 'w', 'ZSILVERM_cs148_final');
    ?>

    </head>

    <?php
    print'<body id="' . PATH_PARTS['filename'] . '">';
    
    print '<!-- ***** START OF BODY ***** -->';

    print PHP_EOL;

    include 'header.php';
    print PHP_EOL;

    include 'nav.php';
    print PHP_EOL;

    ?>

    
