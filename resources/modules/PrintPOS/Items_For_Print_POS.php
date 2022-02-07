<?php

    use JetBrains\PhpStorm\Pure;

    /* A wrapper to do organise item names & prices into columns */

    class Items_For_Print_POS
	{
        private string $name;
        private string $price;
        private string $moneySign;

        public function __construct($name = '', $price = '', $moneySign = false)
        {
            $this->name = $name;
            $this->price = $price;
            $this->moneySign = $moneySign;
        }

        public function getAsString($width = 48): string // for 58mm Font A = 32 // 42 for 72mm Font A // 56 FOR 72mm Font B
        {
            $rightCols = 10;
            $leftCols = $width - $rightCols;
//            if ($this->moneySign) {
//                $leftCols = $leftCols / 2 - $rightCols / 2;
//            }
            $left = str_pad($this->name, $leftCols);

            $sign = ($this->moneySign ? 'Q ' : '');
            $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);
            return "$left$right\n";
        }

        /**
         * @return string
         */
        #[Pure] public function __toString() : string
        {
            return $this->getAsString();
        }
	}
