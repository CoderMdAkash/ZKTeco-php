<?php

require_once 'ZKTeco/ZKTecoClient.php';


$client = new ZKTecoClient('192.168.1.100', 4370);
$client->connect();

$users      = $client->getUsers();
$attendance = $client->getAttendance();
$client->disconnect();


echo "Users List: ". count($users)." <br> ";
foreach ($users as $user) {
    echo "ID: " . $user[0] . "<br>";
    echo "Name: " . $user[1] . "<br>";
    echo "Card Number: " . $user[2] . "<br>";
    echo "Privilege: " . $user[3] . "<br>";
    echo "Password: " . $user[4] . "<br>";
    echo "------------------------<br>";
}


$userMap = [];
foreach ($users as $user) {
    $userMap[$user[0]] = $user[1]; // $user[0] = ID, $user[1] = Name
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