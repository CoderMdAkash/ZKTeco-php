<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'ZKTeco/ZKTecoClient.php';


$client = new ZKTecoClient('192.168.0.101', 4370);
$client->connect();
// if ($client->connect()) { 
    $users = $client->getUser();
    $attendance = $client->getAttendance();
    $client->disconnect();

    if ($users) {
        echo "Users List: ". count($users)." <br> ";
        foreach ($users as $user) {
            echo "ID: " . $user[0] . "<br>";
            echo "Name: " . $user[1][0] . "<br>";
            echo "Card Number: " . $user[2] . "<br>";
            echo "Privilege: " . $user[3] . "<br>";
            echo "Password: " . $user[4] . "<br>";
            echo "------------------------<br>";
        }
    } else {
        echo "No users found or failed to retrieve users.<br>";
        $users = [];
    }

    if ($attendance) {
        $userMap = [];
        foreach ($users as $user) {
            $userMap[$user[0]] = $user[1][0]; // $user[0] = ID, $user[1] = Name
        }

        // Show attendance list with user names
        echo "<br>Attendance List: " . count($attendance) . " <br>";
        foreach ($attendance as $att) {
            $userId = $att[1];
            $userName = isset($userMap[$userId]) ? $userMap[$userId] : 'Unknown';

            echo "ID: " . $att[0] . "<br>";
            echo "User ID: " . $userId . "<br>";
            echo "User Name: " . $userName . "<br>";
            echo "Date Time: " . $att[3] . "<br>";
            echo "------------------------<br>";
        }
    } else {
        echo "No attendance records found or failed to retrieve attendance.<br>";
    }
// } else {
//     echo "Failed to connect to ZKTeco device at 192.168.0.101:4370<br>";
// }