<?php
require '../vendor/autoload.php';

include '../connection.php';
include '../db.php';
include_once('../conf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the 'files' field is set in the form data
    if (!empty($_FILES['file'])) {
        $uploadedFiles = $_FILES['file'];
        $uploadDir = APP_PATH.'/store_file/temp/'; // Define where you want to store uploaded files

        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = basename($uploadedFiles['name']);
        $fileTmpName = $uploadedFiles['tmp_name'];
        $fileUpdatedName = date('YmdHis') . '_' . str_replace(' ', '', pathinfo($fileName, PATHINFO_FILENAME));
        $filePath = $uploadDir . $fileUpdatedName;
        // Path to the input PDF file
        $pdfFile = $filePath.'.pdf';

        // Move the file to the upload directory
        if (move_uploaded_file($fileTmpName, $pdfFile)) {
            $popplerBin = 'C:/Proppler/poppler-24.08.0/Library/bin';

            $destinationFile = $filePath.'.html';

            // Get PDF metadata using pdfinfo
            $command = "pdftohtml -s -noframes $pdfFile $destinationFile";

            $output = shell_exec($command);

            // Add base URL to the HTML file

            if (file_exists($destinationFile)) {
                $htmlContent = file_get_contents($destinationFile);

                // Insert the <base> tag in the <head> section
                $htmlContent = str_replace('src="', 'src="'.APP_URL.'store_file/temp/', $htmlContent);

                // Save the modified HTML content back to the file
                file_put_contents($destinationFile, $htmlContent);
            }

            $htmlContent = file_get_contents($destinationFile);
            // Return a JSON response
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', "htmlContent" => $htmlContent]);
        } else {
            // Return a JSON response
            header('Content-Type: application/json');
            echo json_encode(['status' => 'failed',]);
        }
    } else {
        // No files were uploaded
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'No files uploaded.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
