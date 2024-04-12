<?php
session_start();
include("../config/dbcon.php");
include("../functions/myfunctions.php");
if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $check_email_query = "SELECT email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Already Registred!!";
        header("Location: ../register.php");
    } else {
        if ($password == $confirm_password) {
            $insert_query = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            $insert_query->bind_param('ssss', $name, $email, $phone, $password);
            $insert_query_run = $insert_query->execute();
            if ($insert_query_run) {
                $_SESSION['message'] = "Registered Successfully!!";
                header("Location: ../login.php");
            } else {
                $_SESSION['message'] = "Something went Wrong!!";
                header("Location: ../register.php");
            }
        } else {
            $_SESSION['message'] = "Passwords does not match!!";
            header("Location: ../register.php");
        }
    }
} else if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!$email || !$password) {
        $_SESSION['message'] = "All Fields are Required...";
        header("Location: ../login.php");
        exit(); // Added to prevent further execution
    }

    $login_query = $conn->prepare("SELECT name, email, role_as FROM users WHERE email=? AND password=?");
    $login_query->bind_param('ss', $email, $password);
    $login_query_run = $login_query->execute();

    if (!$login_query_run) {
        $_SESSION['message'] = 'Error executing query: ' . $conn->error;
        header("Location: ../login.php");
        exit(); // Added to prevent further execution
    }

    $login_query_result = $login_query->get_result();

    if ($login_query_result->num_rows > 0) {
        $user_data = $login_query_result->fetch_assoc(); // Fetch associative array

        $username = $user_data['name'];
        $useremail = $user_data['email'];
        $role_as = $user_data['role_as'];

        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'name' => $username,
            'email' => $useremail,
        ];
        $_SESSION['role_as'] = $role_as;
        error_log(print_r($role_as, true));
        // Redirect user based on role
        if ($role_as == 1) {
            redirect("../admin/index.php", "Welcome to Admin Dashboard");
            exit; // Ensure script stops after redirection
        } else {
            redirect("../index.php", "Login Success");
            exit; // Ensure script stops after redirection
        }
    } else {
        redirect("../login.php", "No such User Found!!");
    }

    $login_query->close(); // Close prepared statement

}
