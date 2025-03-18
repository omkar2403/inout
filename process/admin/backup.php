<?php
session_start();
require '../../functions/dbconn.php';
require '../../functions/dbfunc.php';
require '../../functions/general.php';

$userid = $_SESSION['user_id'] ?? null;
$date = date('Y-m-d');
$time = date('His'); // Use time in 24-hour format without colons
$usertype = $_SESSION['user_role'] ?? 'Guest';

$conn->set_charset("utf8mb4");

// Get All Table Names From the Database
$tables = [];
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {
    // Prepare SQL script for creating table structure
    $query = "SHOW CREATE TABLE `$table`";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    $sqlScript .= "\n\n" . $row[1] . ";\n\n";

    // Dump data for each table
    $query = "SELECT * FROM `$table`";
    $result = mysqli_query($conn, $query);
    $columnCount = mysqli_num_fields($result);

    while ($row = mysqli_fetch_row($result)) {
        $sqlScript .= "INSERT INTO `$table` VALUES(";
        for ($j = 0; $j < $columnCount; $j++) {
            if (isset($row[$j])) {
                $sqlScript .= "'" . mysqli_real_escape_string($conn, $row[$j]) . "'";
            } else {
                $sqlScript .= "NULL";
            }
            if ($j < ($columnCount - 1)) {
                $sqlScript .= ',';
            }
        }
        $sqlScript .= ");\n";
    }

    $sqlScript .= "\n";
}

$appver = "5v";

if (!empty($sqlScript)) {
    // Save the SQL script to a backup file
    $backup_file_name = "{$appver}_backup_{$date}_{$time}.sql";
    file_put_contents($backup_file_name, $sqlScript);

    // Download the SQL backup file
    header('Content-Description: File Transfer');
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="' . basename($backup_file_name) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    readfile($backup_file_name);

    // Delete the backup file from the server
    unlink($backup_file_name);

    exit;
}

// Log the backup action
$logid = getsl($conn, "id", "log");
logthis($conn, $logid, $date, $time, $usertype, $userid, "Database Backup Done");

?>
