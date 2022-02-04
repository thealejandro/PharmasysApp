<?php

    /* Call this file 'hello-world.php' */
    require __DIR__ . '/vendor/autoload.php';

    use Mike42\Escpos\Printer;
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
    try {
        // Enter the share name for your USB printer here
//        $connector = null;
        $connector = new WindowsPrintConnector("LR2000");

        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);

//        $printer->selectPrintMode(Printer::MODE_UNDERLINE);
//        $printer->text("Hello World! \n");
//        $printer->selectPrintMode();
//        $printer->setJustification(Printer::JUSTIFY_CENTER);
//        $printer->text("@thealejandro \n");


        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_EMPHASIZED | Printer::MODE_DOUBLE_HEIGHT);
        $printer->text("PROBGAM\n");
        $printer->selectPrintMode();

        $printer->selectPrintMode(Printer::FONT_B);
        $printer->text("Blanca Jhonston \n");
        $printer->text("04 AVE LTE 157 COL STA MARTA 00-000 ZONA 19\n");
        $printer->text("GUATEMALA, GUATEMALA \n");
        $printer->text("NIT: 12345678 \n");

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Whatsapp: 3068-3865 \n");
        $printer->selectPrintMode();

        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Documento Tributario Electronico \n");
        $printer->feed();

        $printer->setEmphasis(TRUE);
        $printer->text("Factura \n");
        $printer->setEmphasis(FALSE);

//        $printer->selectCharacterTable(2);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Serie: 22404C45");
//        $printer->text("      ");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("Numero: 2264092132 \n");

        $printer->text("Numero de autorizacion: \n");
        $printer->text("22404C45-86F3-4DE4-9B25-0719C812F8EB \n");

        $printer->text("Fecha: ".today()->format("Y-m-d"));
        $printer->text("      ");
        $printer->text("Hora: ".today()->format("H:m\n"));

        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Nombre: JOSE CAAL \n");
        $printer->text("Direccion: Ciudad \n");
        $printer->text("NIT: 103237119 \n");

        echo Printer::ESC."$".chr(0) .chr(255) ;


        $printer->cut();

        /* Close printer */
        $printer -> close();
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }

