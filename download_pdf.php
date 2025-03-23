<?php
require_once('tcpdf/tcpdf.php');
require_once('database.php');

// Fetch the last journey details from the database
$sql = "SELECT * FROM journey ORDER BY journey_id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $journey = mysqli_fetch_assoc($result);

    // Close the database connection
    mysqli_close($conn);

    // Create new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    // Set document information and properties
    $pdf->SetCreator('Your Website');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Journey Details');
    $pdf->SetSubject('Journey Details');
    $pdf->SetKeywords('Journey, Details');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', 'B', 16);

    // Output journey details
    $pdf->Cell(0, 10, 'Journey Details', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(0, 10, 'Flights: ' . $journey['flights']);
    $pdf->MultiCell(0, 10, 'Departure: ' . $journey['departure']);
    $pdf->MultiCell(0, 10, 'Arrival: ' . $journey['arrival']);
    $pdf->MultiCell(0, 10, 'Transportation: ' . $journey['transportation']);
    $pdf->MultiCell(0, 10, 'Hotel: ' . $journey['hotel']);
    $pdf->MultiCell(0, 10, 'Sightseeings: ' . $journey['sightseeings']);

    // Output PDF as a download
    $pdf->Output('journey_details.pdf', 'D');
} else {
    echo 'No journeys found.';
}
?>