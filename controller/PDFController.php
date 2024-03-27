<?php

namespace kapcco\controller;

use TCPDF;
use kapcco\core\Request;
use kapcco\model\Model;
use kapcco\view\BladeView;

class PDFController
{

    private $blade_view;
    private $model;

    public function __construct()
    {
        $this->blade_view = new BladeView();
        $this->model = new Model();
    }

    public function export_last_five_collections_pdf()
    {

        $result = $this->model->get_last_collections();
        // $result = [];

        // Create new TCPDF instance
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Last Five Collections Report');
        $pdf->SetSubject('Last Five Collections Report');
        $pdf->SetKeywords('TCPDF, PDF, Last Five Collections Report');

        // Add a page
        $pdf->AddPage();

        // Set some content
        $html = $this->blade_view->render('lastCollectionsReport', [
            'lastCollections' => $result,
            'appName' => 'kapcco',
        ]);


        // Output the HTML content
        $pdf->writeHTML($html);

        // Close and output PDF
        $pdfContent =  $pdf->Output('last_collections_report.pdf', 'S');

        Request::send_pdf_response(200, $pdfContent);

        // Exit the script
        exit;
    }
}
