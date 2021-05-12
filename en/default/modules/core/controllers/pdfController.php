<?php

class pdfController extends Controller
{

    private $pdf;

    public function __construct()
    {
        parent::__construct();
        $this->pdf = new mPDF();
        $this->access_init();
    }

    public function index()
    {
        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'pdf page')));
        $this->view->setJs(array('main'));
    }

    public function dopdf($html = false)
    {
        ob_start();
        $title = strcode2utf("New Doucument");
        $author = strcode2utf(AppCompany);
        $this->pdf->SetTitle($title);
        $this->pdf->SetAuthor($author);
        $this->pdf->SetCreator("Al Amin @ " . AppCompany);
        $this->pdf->SetSubject($title);
        $this->pdf->SetKeywords($title);
        $this->pdf->SetDisplayMode('fullpage');
        $this->pdf->setBasePath(BaseURL);
        $this->pdf->autoScriptToLang = true;
        $this->pdf->baseScript = 1;    // Use values in classes/ucdn.php  1 = LATIN
        $this->pdf->autoLangToFont = true;
        $this->pdf->WriteHTML($html);
        ob_get_clean();

        $this->pdf->Output('New Doucument.pdf', 'D');
    }

}
