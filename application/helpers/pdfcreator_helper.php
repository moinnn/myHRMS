<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    function pdf_create($html, $filename='', $stream=TRUE) 
    {
        require_once("dompdf/dompdf_config.inc.php");
        //$this->load->library("dompdf/dompdf_config.inc");

        $dompdf = new DOMPDF();
        //$dompdf->set_paper('letter', 'landscape');
        $dompdf->load_html($html);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf");
        } else {
            return $dompdf->output();
        }        
        
    }
    
    function create_pdf_html2pdf($html, $school_name, $orientation, $paper_size, $filename)
    {
        require_once('tcpdf/config/lang/eng.php');
        require_once('tcpdf/tcpdf.php');
        
        // create new PDF document
        $pdf = new TCPDF($orientation, PDF_UNIT, $paper_size, true, 'UTF-8', false);
        
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Baze University');
        $pdf->SetTitle($school_name.' - Broadsheet');
        $pdf->SetSubject('Remark Broadsheet for '.$school_name);
        $pdf->SetKeywords('Baze University, PDF, Broadsheet, Nigeria');
        
        // set default header data
        $pdf->SetHeaderData("", "", $school_name, "", array(0,64,255), array(0,64,128));
        //$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));
        
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // set default monospaced font
        //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        //set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        
        // ---------------------------------------------------------
        
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 9, '', true);
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
        
        // ---------------------------------------------------------
        
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('broadsheet-'.date("Y-m-d").'.pdf', 'I');
        $pdf->Output($filename, 'I');
        
        //============================================================+
        // END OF FILE
        //============================================================+
    }
