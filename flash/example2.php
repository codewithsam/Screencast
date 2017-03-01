<?php
/**
 * example2.php
 * Displays flash message created by example.php
 *
 * @author Bennett Stone
 * @link phpdevtips.com
 * @version 1.0
 * @date 19-May-2013
 * @package Flash Messages
 **/

require( 'function.php' );
?>
<html>
<head>
    <title>Example Session Based Flash Messages</title>
    <style>
    .success {
        padding: 15px;
        margin-bottom: 15px;
        -moz-box-shadow: inset 0px 1px 0px 0px #c1ed9c;
        -webkit-box-shadow: inset 0px 1px 0px 0px #c1ed9c;
        box-shadow: inset 0px 1px 0px 0px #c1ed9c;
        background-color: #9dce2c;
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
        border: 1px solid #83c41a;
        color: white;
        font: bold 1em / 1.5em "Helvetica Neue", Arial, "Liberation Sans", FreeSans, sans-serif;
        text-shadow: 1px 1px 0px #689324;
    }
    .error {
        padding: 15px;
        margin-bottom: 15px;
        -moz-box-shadow: inset 0px 1px 0px 0px #f5978e;
        -webkit-box-shadow: inset 0px 1px 0px 0px #f5978e;
        box-shadow: inset 0px 1px 0px 0px #f5978e;
        background-color: #f24537;
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
        border: 1px solid #d02718;
        color: white;
        font: bold 1em / 1.5em "Helvetica Neue", Arial, "Liberation Sans", FreeSans, sans-serif;
        text-shadow: 1px 1px 0px #810e05;
    }
    </style>
</head>
<body>
    <h1>Loading this page will set a session based flash message</h1>
    <p>
        <?php flash( 'example_message' ); ?>
        
        <?php flash( 'example_class' ); ?>
    </p>
</body>
</html>