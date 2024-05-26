<?php
require_once("../machi_db_connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $category_name = $_POST['category_name'];
    $subcategory_name = $_POST['subcategory_name'];




    // Insert into categories table
    $sql_category = "INSERT INTO category (category_name, category_status) VALUES ('$category_name', 1)";
    $conn->query($sql_category);

    // Retrieve the category_id using a SELECT query
    $sql_select_category_id = "SELECT category_id FROM category WHERE category_name = '$category_name'";
    $result = $conn->query($sql_select_category_id);
    $category_id = $result->fetch_assoc()['category_id'];


    // Insert into subcategories table using the retrieved category_id
    $sql_subcategory = "INSERT INTO subcategory (subcategory_name, subcategory_status, category_id_fk) VALUES ('$subcategory_name', 1, $category_id)";


    $conn->query($sql_subcategory);
    if ($conn->error) {
        die("Query failed: " . $conn->error);
    }
    
    // Close the connection
    $conn->close();
}

header("Location: category.php");


