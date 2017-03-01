<?php
    session_start();
    include_once("../db_conx.php");
if(isset($_SESSION["cursessname"]) || isset($_SESSION["studentsessname"])){
    $sess = isset($_SESSION["cursessname"]) ? mysqli_real_escape_string($db_conx,$_SESSION["cursessname"]): mysqli_real_escape_string($db_conx,$_SESSION["studentsessname"]);
$data_source_file = 'json/'.$sess.'.json';
// main loop

    // if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
    //$last_ajax_call = isset($_GET['timestamp']) ? (int) $_GET['timestamp'] : null;
    if(isset($_GET['timestamp'])){
        if($_GET['timestamp'] != '' || $_GET['timestamp'] != NULL){
            $last_ajax_call = (int) $_GET['timestamp'];
        }else{
            $last_ajax_call = null;
        }
    }

    // PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
    clearstatcache();
    // get timestamp of when file has been changed the last time
    $last_change_in_data_file = filemtime($data_source_file);

    // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
    if ($last_ajax_call == null || $last_change_in_data_file > $last_ajax_call) {

        // get content of data.txt
        $data = file_get_contents($data_source_file);
        
        // put data.txt's content and timestamp of last data.txt change into array
        $result = array(
            'data_from_file' => $data,
            'timestamp' => $last_change_in_data_file
        );
        // if(isset($_SESSION["tid"])){
        //     $tch = mysqli_real_escape_string($db_conx,$_SESSION["tid"]);
        //     $result["teacher"] => $tch;
        // }else if(isset($_SESSION["sid"])){
        //     $stu = mysqli_real_escape_string($db_conx,$_SESSION["sid"]);
        //     $result["student"] => $stu;
        // }

        // encode to JSON, render the result (for AJAX)
        $json = json_encode($result);
        echo $json;
        exit();

    } else {
        
    }
}