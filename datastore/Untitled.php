<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "username", "password", "your_database_name");

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Check if a file was uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Get file details
    $filename = $file['name'];
    $filetmp = $file['tmp_name'];

    // Check if the file is an Excel file
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext != 'xlsx' && $ext != 'xls') {
        die("Error: Invalid file format. Please upload an Excel file.");
    }

    // Include the PHPExcel library
    require_once 'PHPExcel/IOFactory.php';

    // Load the Excel file
    $excel = PHPExcel_IOFactory::load($filetmp);

    // Get the active worksheet
    $worksheet = $excel->getActiveSheet();

    // Get the highest row and column
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();

    // Loop through each row and extract data
    for ($row = 1; $row <= $highestRow; $row++) {
        // Get data from each column
        $data1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
        $data2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $data3 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

        // Insert data into MySQL database
        $insert_query = "INSERT INTO your_table_name (column1, column2, column3) VALUES ('$data1', '$data2', '$data3')";
        mysqli_query($conn, $insert_query);
    }

    // Display success message
    echo "Data has been successfully extracted from the Excel file and stored in the database.";
}
?>

<!-- HTML form to upload the Excel file -->
<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <input type="submit" value="Upload">
</form>