<?php
include('../functions/myfunctions.php');
if (isset($_SESSION['auth'])) {
    if ($_SESSION['role_as'] != 1) {
        redirect("../index.php", "Tou cannot access this page");
    }
} else {
    redirect("../login.php", "Login to Continue");
}
