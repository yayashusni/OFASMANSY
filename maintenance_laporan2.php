<?php
include "koneksi.php";
require "fpdf/fpdf.php";
class PDF extends FPDF
{
    // Membuat Page header
    public function Header()
    {
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(30);
        $this->Cell(133, 5, 'OFFICE ASSET MAINTENANCE SYSTEM', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(92, 85, 191);
        $this->Cell(30);
        $this->Cell(133, 9, 'OFASMANSY', 0, 1, 'C');

        // Menambahkan garis header
        $this->SetLineWidth(1);
        $this->Line(10, 27, 200, 27);
        $this->SetLineWidth(0);
        $this->Line(10, 28.5, 200, 28.5);
        $this->Ln();
    }

    // Membuat page footer
    public function Footer()
    {

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}



$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
//tampilkan judul laporan
$pdf->SetFont('Arial', 'B', '12');
$pdf->Cell(0, 10, 'Laporan Data Perbaikan Asset ', '0', 1, 'C');
// tanggal 
$tgl1=date_format(date_create($_POST['tgl_awal']), 'd-m-Y');
$tgl2=date_format(date_create($_POST['tgl_akhir']), 'd-m-Y');
$pdf->SetFont('Arial', '', '9');
$pdf->Cell(0, 8, 'Tanggal : '.$tgl1 .' sampai '. $tgl2, '0', 1, 'C');

//Membuat kolom judul tabel
$pdf->SetFont('Arial', '', '11');
$pdf->SetFillColor(92, 85, 191);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 0, 0);
$pdf->Cell(8, 7, 'No', 1, '0', 'C', true);
$pdf->Cell(40, 7, 'Nama Barang', 1, '0', 'C', true);
$pdf->Cell(45, 7, 'Kerusakan', 1, '0', 'C', true);
$pdf->Cell(55, 7, 'Spot area', 1, '0', 'C', true);
$pdf->Cell(40, 7, 'Status perbaikan', 1, '0', 'C', true);
$pdf->Ln();
//Membuat kolom isi tabel
$pdf->SetFont('Arial', '', '11');
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$i = 0;
$tampil = mysqli_query($koneksi, "SELECT * FROM maintenance_yayas WHERE tanggal_upload >='$_POST[tgl_awal]' AND tanggal_upload<='$_POST[tgl_akhir]' order by nama_barang ASC");
while ($data = mysqli_fetch_array($tampil)) {
    $i++;
    $pdf->Cell(8, 7, $i, 1, '0', 'C', true);
    $pdf->Cell(40, 7, $data['nama_barang'], 1, '0', 'L', true);
    $pdf->Cell(45, 7, $data['jenis_kerusakan'], 1, '0', 'L', true);
    $pdf->Cell(55, 7, $data['spot_area'], 1, '0', 'L', true);
    $pdf->Cell(40, 7, $data['status_perbaikan'], 1, '0', 'L', true);
    $pdf->Ln();
}
// Menampilkan output file PDF
$pdf->Output('i', 'Laporan Data Perbaikan Asset Per Tanggal.pdf', 'false');
