<?php
require_once __DIR__ . '/../packages/phpqrcode/qrlib.php';
require_once __DIR__ . '/../packages/fpdf186/fpdf.php';

function generateQRCodePDFWithItems($items, $filename = 'qr_codes.pdf') {
    $tempDir = __DIR__ . '/../temp/'; // Directory to store temporary QR code images
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0777, true); // Create temp directory if it doesn't exist
    }

    // Initialize PDF and settings
    $pdf = new FPDF();
    $pdf->AddPage('P', 'A4'); // A4 Portrait
    $pdf->SetFont('Arial', '', 10);

    // Page and QR code layout settings
    $qrWidth = 210 / 10; // A4 width is 210mm, divide by 10
    $qrHeight = $qrWidth; // Square QR codes
    $marginX = 10; // Horizontal margin in mm
    $marginY = 10; // Vertical margin in mm
    $currentX = $marginX;
    $currentY = $marginY;

    // Generate QR Codes and Add to PDF
    foreach ($items as $item) {
        // Generate QR code image
        $qrImagePath = $tempDir . md5($item) . '.png';
        QRcode::png($item, $qrImagePath, QR_ECLEVEL_L, 3, 2);

        // Add QR code image to PDF
        $pdf->Image($qrImagePath, $currentX, $currentY, $qrWidth, $qrHeight);
        $pdf->SetXY($currentX, $currentY + $qrHeight + 2); // Add some space below QR

        // Add label below the QR code
        $pdf->Cell($qrWidth, 5, $item, 0, 0, 'C');

        // Move to next position
        $currentX += $qrWidth + 5; // Move to the right, add spacing
        if ($currentX + $qrWidth > 210 - $marginX) { // Check if exceeds page width
            $currentX = $marginX; // Reset X position
            $currentY += $qrHeight + 10; // Move to next row
        }

        // Check if new page is needed
        if ($currentY + $qrHeight > 297 - $marginY) { // A4 height is 297mm
            $pdf->AddPage(); // Add new page
            $currentX = $marginX; // Reset X
            $currentY = $marginY; // Reset Y
        }

        // Delete temporary QR code image
        if (file_exists($qrImagePath)) {
            unlink($qrImagePath);
        }
    }

    // Output the PDF for download
    $pdf->Output('D', $filename);
    exit;
}
?>