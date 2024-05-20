<?php
class MYPDF extends TCPDF
{
    public function __construct($kode_perm)
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $this->kode_perm = $kode_perm;
    }
}

// create new PDF document
$pdf = new MYPDF($kode_perm);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Habib Oktarian');
$pdf->setTitle('Cetak Permintaan ATK');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('times', '', 12);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->setFillColor(255, 255, 127);

// title
$title = <<<EOD
<h2>Invoice Permintaan ATK </h2>
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);

// tabel
$table = '<table style="border: 1px solid #000; padding: 6px;">';
$table .= '<tr>
                <th style="border: 1px solid #000; width: 34px; text-align: center;">No</th>
                <th style="border: 1px solid #000; width: 180px; text-align: center;">Nama Barang</th>
                <th style="border: 1px solid #000; width: 96px; text-align: center;">QTY / Satuan</th>
                <th style="border: 1px solid #000; text-align: center;">Harga Satuan</th>
                <th style="border: 1px solid #000; text-align: center;">Keterangan</th>
                <th style="border: 1px solid #000; text-align: center;">Sub Total</th>
            </tr>';
$count = 1;

foreach ($nama_barang as $key => $value) :
    $table .= '<tr>';
    $table .= '<td style="border: 1px solid #000; text-align: center;">' . $count++ . '</td>';
    $table .= '<td style="border: 1px solid #000;">' . $value->nama_barang . '</td>';
    $table .= '<td style="border: 1px solid #000; text-align: center;">' . $value->jumlah_perm . ' / ' . $value->nama_satuan . '</td>';
    $table .= '<td style="border: 1px solid #000;">Rp. ';
    if ($value->Harga !== null && $value->Harga != 0) {
        $table .= 'Rp. ' . number_format($value->Harga, 0, ',', '.');
    }
    $table .= '</td>';
    $table .= '<td style="border: 1px solid #000;">' . $value->ket . '</td>';
    $table .= '<td style="border: 1px solid #000;">Rp. ';
    if ($value->sub_total !== null && $value->sub_total != 0) {
        $table .= 'Rp. ' . number_format($value->sub_total, 0, ',', '.');
    }
    $table .= '</td>
            </tr>';
endforeach;

$table .= '<tr>
    <td style="border: 1px solid #000; text-align: center;" colspan="5">Total Bayar</td>
    <td style="border: 1px solid #000;">Rp. ';

if ($tb_konfperm->total_bayar !== null && $tb_konfperm->total_bayar != 0) {
    $table .= 'Rp. ' . number_format($tb_konfperm->total_bayar, 0, ',', '.');
}

$table .= '</td>
        </tr>';
$table .= '</table>';

// output HTML ke PDF
$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'L', true);

// menggeser ke bawah sejauh 10 piksel
$pdf->SetY($pdf->GetY() + 10);

$qr_code_path = $qr_code;

// tabel
$signature1 = '<table>';
$signature1 .=  '<tr>
                    <th>Nama Peminta</th>
                    <th>Staf Administrasi</th>
                </tr>';
$count = 1;
$signature1 .=  '<tr>
                    <td></td>
                    <td><img src="' . $qr_code_path . '" alt="QR Code" style="width: 75px;"></td>
                </tr>';
$signature1 .=  '<tr>
                    <td><strong>' . $nama_user->nama_user . '</strong></td>
                    <td><strong>WELLY DESVITRI YANTI, S.Pd</strong> <br> NIP. 19841217 201001 2 026</td>
                </tr>';
$signature1 .=  '<tr>
                    <td></td>
                    <td></td>
                </tr>';
$signature1 .= '</table>';
$pdf->writeHTMLCell(0, 0, '', '', $signature1, 0, 1, 0, true, 'C', true);

$signature2 = '<table>';
$signature2 .=   '<tr>
                    <th>Diketahui oleh: <br> Pejabat Pelaksana Teknis Kegiatan</th>
                    <th>Disetujui oleh: <br> Pengguna Anggaran</th>
                </tr>';
$signature2 .=   '<tr>
                    <td><img src="' . $qr_code_path . '" alt="QR Code" style="width: 75px;"></td>
                    <td><img src="' . $qr_code_path . '" alt="QR Code" style="width: 75px;"></td>
                </tr>';
$signature2 .=   '<tr>
                    <td><strong>JATIRMAN, SST</strong> <br> NIP. 19671012 198903 1 007</td>
                    <td><strong>Dr. MHD LUTFI AR, SH, M.Si</strong> <br> NIP. 19730313 199703 1 005</td>
                </tr>';
$signature2 .= '</table>';
// output HTML ke PDF
$pdf->writeHTMLCell(0, 0, '', '', $signature2, 0, 1, 0, true, 'C', true);

// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

// fungsi ob_clean untuk menghapus outpun buffer
ob_clean();

//Close and output PDF document
$pdf->Output($kode_perm . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
