<?php

ob_start();
$this->pdf->AddPage();
$this->pdf->SetCreator("Al Amin @ Nano Eye");
$this->pdf->SetTitle("New Doucment");
$this->pdf->SetFont('Arial', 'B', 16);
$this->pdf->Cell(40, 10, utf8_decode($num . ' ' . $applet));
$this->pdf->Output('New Doucment.pdf', 'D');
ob_end_flush();