<?php
/**
 * example.php
 *
 * @author Bennett Stone
 * @link phpdevtips.com
 * @version 1.0
 * @date 19-May-2013
 * @package Flash Messages
 **/

require( 'function.php' );

//Set the first flash message with default class
flash( 'example_message', 'This content will show up on example2.php' );

//Set the second flash with an error class
flash( 'example_class', 'This content will show up on example2.php with the error class', 'error' );
?>
<html>
<head>
    <title>Example Session Based Flash Messages</title>
</head>
<body>
    <h1>Loading this page will set a session based flash message</h1>
    <p>
        <a href="example2.php">Click here to see the message</a>
    </p>
    <p>
        <strong>Note: sessions must be initiated for this function to work</strong>
    </p>
    
    <p>To set a message:
        <pre>flash( 'example_message', 'This content will show up on example2.php' );</pre>
    </p>
    
    <p>To set a message with a custom class:
        <pre>flash( 'example_class', 'This content will show up on example2.php with the error class', 'error' );</pre>
    </p>
    
    <p>To display flash messages:
        <pre>flash( 'example_message' );</pre>
    </p>
</body>
</html>