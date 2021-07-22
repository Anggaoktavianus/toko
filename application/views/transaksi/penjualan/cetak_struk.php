<?php
require_once(APPPATH . 'vendor/mike42/escpos-php/autoload.php');

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;

$b = $data->row_array();
$date = date('d-M-Y H:i:s');
// $connector = new WindowsPrintConnector("58");
$connector = new CupsPrintConnector("EPSON_L120_Series");
// $logo = EscposImage::load("./assets/img/logo.png", false);
$printer = new Printer($connector);
$printer->initialize();
/* Name of shop */
$printer->setJustification(Printer::JUSTIFY_CENTER);
// $printer -> bitImage($logo);
$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer->text("Toko Barry\n");
$printer->selectPrintMode();
$printer->text("Jl. \n");
$printer->text("Srengseng - Temanggung\n");
$printer->text("Temanggung\n");
$printer->text("================================\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("No Faktur    : ");
$printer->text($b['jual_nofak']);
$printer->feed();
$printer->text("Nama Kasir   : ");
$printer->text($this->session->userdata('name'));
$printer->feed();
$printer->text("Nama Pembeli : ");
$printer->text($b['jual_pembeli']);
$printer->feed();
$printer->text("--------------------------------\n");
/* Title of receipt */
$printer->setEmphasis(true);
$printer->text("Keterangan                Total");
foreach ($data->result_array() as $i) {
    $printer->feed();
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text($nabar = $i['d_jual_barang_nama']);
    $printer->feed();
    $printer->text($satuan = $i['d_jual_barang_satuan']);
    $printer->text("      ");
    $printer->text($qty = $i['d_jual_qty']);
    $printer->text("      ");
    $printer->text($diskon = number_format($i['d_jual_diskon']));
    $printer->text("       ");
    $printer->text($harjul = number_format($i['d_jual_barang_harjul']));
}
$printer->feed();
$printer->text("--------------------------------\n");
// $printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer->setEmphasis(true);
$printer->text("Total     :              ");
$printer->text(number_format($b['jual_total']));
$printer->setEmphasis(false);
$printer->feed();
$printer->text("Tunai     :              ");
$printer->text(number_format($b['jual_jml_uang']));
$printer->feed();
$printer->text("Kembalian :              ");
$printer->text(number_format($b['jual_kembalian']));
$printer->feed();
$printer->text("--------------------------------\n");
/* Footer */
$printer->feed();
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Terima Kasih Atas Kunjungan Anda\n");
$printer->feed();
$printer->text($date . "\n");

/* Cut the receipt and open the cash drawer */
$printer->cut();
$printer->pulse();
$printer->close();
