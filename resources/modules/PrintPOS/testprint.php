<?php

    require __DIR__ . '/../../../vendor/autoload.php';
    require __DIR__.'/Items_For_Print_POS.php';

    use App\Models\Stores;
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
    use Mike42\Escpos\Printer;
    use Illuminate\Http\Request;


    class PrintPOS
    {
        private $nitClient;
        private $nameClient;
        private $addressClient;
        private mixed $totalSale;
        private $storeName;
        private mixed $items;
        private mixed $saleID;

        public function __construct(Request $data)
        {
            $this->nitClient = $data->invoiceData->nit;
            $this->nameClient = $data->invoiceData->name;
            $this->addressClient = $data->invoiceData->address;
            $this->totalSale = $data->totalSale;
            $this->saleID = $data->saleID;

            $store = Stores::where("store_id", $data->store_id)->first();
            $storeData = json_decode(json_encode($store->dataFEL));

            $this->storeName = $storeData->nameStore;
            $this->items = $data->sale_details;
        }

        public function printPOS(): string
        {
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
//                $printer->text("PROBGAM\n");
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

                $printer->text("Serie: 22404C45 \n");
                $printer->text("Numero: 2264092132 \n");
            //        $printer->text(new Items_For_Print_POS("Serie: 224104C45", "Numero: 226492134132"));

            //        $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("Numero de autorizacion: \n");
                $printer->text("22404C45-86F3-4DE4-9B25-0719C812F8EB \n");

                $printer->text("Fecha: ".today("America/Guatemala")->format("d-m-Y"));
                $printer->text("      ");
                $printer->text("Hora: ".today("America/Guatemala")->format("h:i a \n"));

                $printer->text("Referencia interna: $this->saleID \n");

                $printer->setJustification(Printer::JUSTIFY_LEFT);

                $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));

//                $nameClient = $data->invoiceData->name;
//                $nitClient = $data->invoiceData->nit;
//                $addressClient = $data->invoiceData->address;

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

            //        $items = array(
            //            new Items_For_Print_POS("Gotas Pediatricas - Acetaminofen 100mg 30 ml - Selectpharma", "10.00", true),
            //            new Items_For_Print_POS("Another thing", "30032.50", true),
            //            new Items_For_Print_POS("Something else", "1222.00", true),
            //            new Items_For_Print_POS("A final item", "43.45", true),
            //        );

                $total = new Items_For_Print_POS("Total", $this->totalSale, true);
                $taxes = new Items_For_Print_POS("IVA", "1.07", true);

            //        foreach ($items as $item) {
            //            $printer->text($item->getAsString(56));
            //        }

                foreach ($this->items as $item) {
                    $printer->text($item->unit_quantity." ");
                    $printer->text($item->name."\n");
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
                    $printer->text(generateString("Precio: Q".$item->dataRegister->price_sale, "Subtotal: Q".$item->total));
                    $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));
                }

//                $printer->text("1 ");
//                $printer->text("Gotas Pediatricas - Acetaminofen 100mg 30 ml - Selectpharma \n");
//                $printer->setJustification(Printer::JUSTIFY_CENTER);
//                $printer->text(generateString("Precio: Q10.00", "Subtotal: Q10.00"));
//                $printer->text(str_pad("", 56, "-", STR_PAD_RIGHT));


                //        $printer->feed();
                $printer->setJustification();

//                $printer->text($subtotal->getAsString(56));
                $printer->text($taxes->getAsString(56));

                $printer->setEmphasis(TRUE);
                $printer->text($total->getAsString(56));
                $printer->setEmphasis(FALSE);

            //        $printer->text("Total ");
            //        $printer->text("Q20.00 \n");

                $printer->feed();

                $printer->text("Total letras: ");
                $printer->text("Diez con 00/100 \n");
                $printer->text("Sujeto a pagos trimestrales ISR \n");
                $printer->text("Fecha y hora de certificacion: ");
                $printer->text(today("America/Guatemala")->format("d-m-Y h:i a \n"));

                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->qrCode("HOLA", Printer::QR_ECLEVEL_H, 4);
                $printer->setJustification();

            //        echo Printer::ESC."$".chr(0) .chr(255) ;


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

