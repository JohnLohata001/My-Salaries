<?php 
 
   
    echo realpath('fpdf/fpdf.php');
 
    // Include the FPDF library

    
    // Create a new instance of FPDF
    $doc = new FPDF();
    
    // Add a page
    $doc->AddPage();
    
    // Set the document title
    $doc->SetTitle('Example PDF Page with Content');
    
    // Set a font and size for the title
    $doc->SetFont('Arial', 'B', 18);
    
    // Add a title to the page
    $doc->Cell(0, 10, 'Welcome to FPDF', 0, 1, 'C');
    
    // Add a line break
    $doc->Ln(10);
    
    // Add a subtitle
    $doc->SetFont('Arial', 'B', 14);
    $doc->Cell(0, 10, 'Introduction', 0, 1, 'L');
    $doc->Ln(5);
    
    // Add some content text
    $doc->SetFont('Arial', '', 12);
    $content = "FPDF is a PHP class that allows you to generate PDF files easily. "
             . "You can create documents with text, images, and tables, customize "
             . "the layout, and export the content as a PDF file. This is a sample page "
             . "showing how to add a title, subtitle, and some content to a PDF.";
    
    $doc->MultiCell(0, 10, $content);
    
    // Add another section
    $doc->Ln(10); // Add some space before the next section
    $doc->SetFont('Arial', 'B', 14);
    $doc->Cell(0, 10, 'Features of FPDF', 0, 1, 'L');
    
    // Content for the features section
    $doc->SetFont('Arial', '', 12);
    $features = "- Free to use\n"
              . "- Supports multiple page formats\n"
              . "- Allows text styling (bold, italic, underline)\n"
              . "- Supports images, links, and more\n"
              . "- Easy to integrate with PHP applications.";
    
    $doc->MultiCell(0, 10, $features);
    
    // Add a footer
    $doc->Ln(10);
    $doc->SetFont('Arial', 'I', 10);
    $doc->Cell(0, 10, 'Generated using FPDF - www.fpdf.org', 0, 0, 'C');
    
    // Output the PDF to the browser
    $doc->Output();
    
    
    
?>

   





