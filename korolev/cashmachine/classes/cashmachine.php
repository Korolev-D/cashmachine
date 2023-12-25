<?php

namespace korolev\cashmachine\classes;

class CashMachine
{
    public function __construct()
    {
        $this->setCashMachine();
    }

    public function setCashMachine(int $iLimit = 1000000): void
    {
        $_SESSION["CASH_MACHINE"][session_id()] = array(
            "ID" => session_id(),
            "LIMIT" => $iLimit,
            "BANKNOTES" => array(5000, 2000, 1000, 500, 200, 100)
        );
    }

    public function getCashMachine(): array
    {
        if(isset($_SESSION["CASH_MACHINE"][session_id()])){
            return $_SESSION["CASH_MACHINE"][session_id()];
        }else{
            $this->setCashMachine();
        }
        return $_SESSION["CASH_MACHINE"][session_id()];
    }

    public function setLimit($iLimit): void
    {
        $this->setCashMachine($iLimit);
    }
}