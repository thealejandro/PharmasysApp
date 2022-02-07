<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\PrintPOS\generateItems;
use App\Models\Stores;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class PrintPOS extends Controller
{
    private $nitClient;
    private $nameClient;
    private $addressClient;
    private mixed $totalSale;
    private $storeName;
    private mixed $items;
    private mixed $saleID;
    private string $serieDTE;
    private string $numberDTE;
    private string $autorizationDTE;

    public function printPOS(Request $data)
    {
        $this->nitClient = $data->invoiceData->nit;
        $this->nameClient = $data->invoiceData->name;
        $this->addressClient = $data->invoiceData->address;
        $this->totalSale = $data->totalSale;
        $this->saleID = $data->saleID;

        $store = Stores::where("storeID", $data->store_id)->first();
        $storeData = json_decode($store->dataFEL);

        $this->storeName = $storeData->nameStore;
        $this->items = $data->sale_details;
        $this->serieDTE = "22404C45";
        $this->numberDTE = "2264092132";
        $this->autorizationDTE = "22404C45-86F3-4DE4-9B25-0719C812F8EB";

        /**
         * Install the printer using USB printing support, and the "Generic / Text Only" driver,
         * then share it (you can use a firewall so that it can only be seen locally).
         *
         * Use a WindowsPrintConnector with the share name to print.
         *
         * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
         * "Receipt Printer), the following commands work:
         *
         *  echo "Hello World" > testfile
         *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
         *  del testfile
         */
        // Enter the share name for your USB printer here
        //        $connector = null;
        $connector = new WindowsPrintConnector("LR2000");

        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);
        try {

            $printer->setJustification(Printer::JUSTIFY_CENTER);

            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_EMPHASIZED | Printer::MODE_DOUBLE_HEIGHT);
            $printer->text($this->storeName."\n");
            $printer->selectPrintMode();

            $printer->selectPrintMode(Printer::FONT_B);
            $printer->text("Blanca Jhonston \n");
            $printer->text("04 AVE LTE 157 COL STA MARTA 00-000 ZONA 19\n");
            $printer->text("GUATEMALA, GUATEMALA \n");
            $printer->text("NIT: 12345678 \n");

            //        $printer->setJustification(Printer::JUSTIFY_LEFT);
            //        $printer->text("Whatsapp: 3068-3865 \n");
            //        $printer->selectPrintMode();

            $printer->feed();

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Documento Tributario Electronico \n");
            $printer->feed();

            $printer->setEmphasis(TRUE);
            $printer->text("Factura \n");
            $printer->setEmphasis(FALSE);

            $printer->text("Serie: $this->serieDTE \n");
            $printer->text("Numero: $this->numberDTE \n");
            $printer->text("Numero de autorizacion: \n");
            $printer->text("$this->autorizationDTE\n");

            $printer->text("Fecha: ".now("America/Guatemala")->format("d-m-Y"));
            $printer->text("      ");
            $printer->text("Hora: ".now("America/Guatemala")->format("h:i a \n"));

            $printer->text("Referencia interna: $this->saleID \n");

            $printer->setJustification(Printer::JUSTIFY_LEFT);

            $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));

            function generateString($strL, $strR = ""): string
            {
                $widthPaper = 56; // for 58mm Font A = 32 // 42 for 72mm Font A // 56 FOR 72mm Font B
                $rightCols = strlen($strR);
                $leftCols = $widthPaper - $rightCols;
                $left = str_pad($strL, $leftCols);
                $right = str_pad($strR, $rightCols, ' ', STR_PAD_LEFT);
                return "$left$right\n";
            }

            $printer->text(generateString("Nombre:", $this->nameClient));
            $printer->text(generateString("Direccion:", $this->addressClient));
            $printer->text(generateString("NIT:", $this->nitClient));

            $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));
            $printer->feed();

            foreach ($this->items as $item) {
                $printer->text($item["unit_quantity"]." ");
                $printer->text($item["name"]."\n");
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text(generateString("Precio: Q".$item["dataRegister"]["price_sale"], "Subtotal: Q".$item["total"]));
                $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));
                $printer->setJustification();
            }

            $total = new generateItems("Total", $this->totalSale, true);
            $taxes = new generateItems("IVA", "1.07", true);

//                $printer->text("1 ");
//                $printer->text("Gotas Pediatricas - Acetaminofen 100mg 30 ml - Selectpharma \n");
//                $printer->setJustification(Printer::JUSTIFY_CENTER);
//                $printer->text(generateString("Precio: Q10.00", "Subtotal: Q10.00"));
//                $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));


            $printer->text($taxes->getAsString(56));

            $printer->setEmphasis(TRUE);
            $printer->text($total->getAsString(56));
            $printer->setEmphasis(FALSE);

            $printer->feed();

            $printer->text("Total letras: ");
            $printer->text("Diez con 00/100 \n");
            $printer->text("Sujeto a pagos trimestrales ISR \n");
            $printer->text("Fecha y hora de certificacion: ");
            $printer->text(today("America/Guatemala")->format("d-m-Y h:i a \n"));
            $printer->text("Certificador: ".getenv("FEL_CERTIFICADOR")."\n");
            $printer->text("Nit Certificador: ".getenv("FEL_CERTIFICADOR_NIT")."\n");

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->qrCode("https://felpub.c.sat.gob.gt/verificador-web/publico/vistas/verificacionDte.jsf?tipo=autorizacion&numero=$this->autorizationDTE&emisor=".getenv("FEL_NIT")."&receptor=$this->nitClient&monto=$this->totalSale", Printer::QR_ECLEVEL_H, 3, Printer::QR_MICRO);
            $printer->setJustification();

            $printer->cut();
            /* Close printer */
        } catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        } finally {
            $printer -> close();
            return "Success";
        }
    }
}
