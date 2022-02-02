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
$pdf->Cell(0, 13, 'Laporan Data Karyawan ', '0', 1, 'C');
$pdf->SetFont('Arial', 'B', '11');

//Membuat kolom judul tabel
$pdf->SetFont('Arial', '', '9');
$pdf->SetFillColor(92, 85, 191);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 0, 0);
$pdf->Cell(8, 7, 'No', 1, '0', 'C', true);
$pdf->Cell(28, 7, 'Kode Karyawan', 1, '0', 'C', true);
$pdf->Cell(35, 7, 'Nama', 1, '0', 'C', true);
$pdf->Cell(35, 7, 'Alamat', 1, '0', 'C', true);
$pdf->Cell(28, 7, 'Tempat Lahir', 1, '0', 'C', true);
$pdf->Cell(28, 7, 'Tanggal Lahir', 1, '0', 'C', true);
$pdf->Cell(28, 7, 'Jenis Kelamin', 1, '0', 'C', true);
$pdf->Ln();
//Membuat kolom isi tabel
$pdf->SetFont('Arial', '', '9');
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$i = 0;
$tampil = mysqli_query($koneksi, "SELECT * FROM user_yayas order by kode_karyawan ASC");
while ($data = mysqli_fetch_array($tampil)) {
    $i++;
    $pdf->Cell(8, 7, $i, 1, '0', 'C', true);
    $pdf->Cell(28, 7, $data['kode_karyawan'], 1, '0', 'L', true);
    $pdf->Cell(35, 7, $data['nama'], 1, '0', 'L', true);
    $pdf->Cell(35, 7, $data['alamat'], 1, '0', 'L', true);
    $pdf->Cell(28, 7, $data['tempat_lahir'], 1, '0', 'L', true);
    $pdf->Cell(28, 7, date_format(date_create($data['tanggal_lahir']),'d-m-Y'), 1, '0', 'L', true);
    $pdf->Cell(28, 7, $data['jk'], 1, '0', 'L', true);
    $pdf->Ln();
}
// Menampilkan output file PDF
$pdf->Output('i', 'Laporan Data karyawan Keseluruhan.pdf', 'false');

