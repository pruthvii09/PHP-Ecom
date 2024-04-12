<?php
include("config/dbcon.php");
function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status='0'";
    return $query_run = mysqli_query($conn, $query);
}
function getSlugActive($table, $slug)
{
    global $conn;

    // Prepare the SQL statement with a parameterized query
    $query = "SELECT * FROM $table WHERE slug=? AND status='0'";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $slug);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Check for errors
    if (!$result) {
        // Handle the error, such as logging or returning an error message
        // Example: return "Error executing query: " . mysqli_error($conn);
        return null; // Return null to indicate an error
    }

    // Return the result set
    return $result;
}
function getIDActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0'";
    return $query_run = mysqli_query($conn, $query);
}
function getAllProdBycategory($category)
{
    global $conn;
    $query = "SELECT * FROM products WHERE category_id='$category' AND status='0'";
    return $query_run = mysqli_query($conn, $query);
}
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit();
}
