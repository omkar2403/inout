<?php
session_start();

if (!isset($_POST['submit'])) {
    header('Location: login.php');
    exit;
}

require_once "./functions/dbconn.php";
require_once "./functions/dbfunc.php";

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$loc = $_POST['loc'];

$ftime = strtotime("12:00:00");
$stime = strtotime("17:00:00");
$ltime = time(); // Fixed issue with undefined constant "now"

if ($ftime > $ltime) {
    $_SESSION['t'] = "Morning";
} elseif ($stime > $ltime) {
    $_SESSION['t'] = "Noon";
} else {
    $_SESSION['t'] = "Evening";
}

// Sanitize input
$name = sanitize($conn, $name);
$pass = sanitize($conn, $pass);

// Hash password
$pass = sha1($pass);

// Prepare and execute query to prevent SQL injection
$query = "SELECT * FROM users WHERE username = ? AND pass = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    header('Location: login.php?msg=1');
    exit;
}

$user = mysqli_fetch_assoc($result);

if ($user && $user['active'] == 1) {
    // Fetch setup data
    $setupArray = mysqli_query($conn, "SELECT * FROM setup");
    
    if (!$setupArray) {
        die("Database Error: " . mysqli_error($conn));
    }

			while($row = mysqli_fetch_array($setupArray)){
				$setup[$row[0]] = $row[1];
			}

    // Ensure `getDataById()` returns a mysqli_result, not an array
    $roleResult = getDataById($conn, "roles", $user['role']);

    if (!$roleResult || !is_object($roleResult)) {
        die("Database Error: Role query failed.");
    }

    $role = mysqli_fetch_assoc($roleResult);
    
    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $role['rname'];
    $_SESSION['user_name'] = $user['fname'];
    $_SESSION['user_access'] = explode(';', $role['acc_code']);

    if ($loc !== "Master") {
        if ($role['rname'] === "Admin") {
            $_SESSION["id"] = $role['rname'];
            $_SESSION["loc"] = sanitize($conn, $loc);
            $_SESSION["locname"] = $loc;
            $_SESSION["lib"] = $setup['cname'] ?? 'Unknown';
            header("Location: index.php?msg=" . $_SESSION['t']);
        } elseif ($role['rname'] === "User") {
            $_SESSION["id"] = $role['rname'];
            $_SESSION["loc"] = sanitize($conn, $loc);
            $_SESSION["locname"] = $loc;
            $_SESSION["lib"] = $setup['cname'] ?? 'Unknown';
            $_SESSION["libtime"] = $setup['libtime'] ?? '';
            $_SESSION["noname"] = $setup['noname'] ?? '';
            $_SESSION["banner"] = $setup['banner'] ?? '';
            $_SESSION["activedash"] = $setup['activedash'] ?? '';
            header("Location: dash.php");
        } else {
            header('Location: login.php?msg=1');
        }
    } elseif ($loc === "Master") {
        if ($role['rname'] === "Master") {
            $_SESSION["id"] = $role['rname'];
            $_SESSION["loc"] = "Master";
            $_SESSION["lib"] = "Master";
            header("Location: index.php?msg=" . $_SESSION['t']);
        } else {
            header('Location: login.php?msg=1');
        }
    }
} else {
    header('Location: login.php?msg=3');
}

// Close connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>
