<?php

namespace providers\korolev\cashmachine\classes;

class CashMachine
{
    private $arFields;
    private array $arPost;

    public function __construct()
    {
        $this->setCashMachine();
        $this->arPost = $_POST;
        $this->arFields = $this->arPost["FIELDS"];
    }

    public function setCashMachine(int $iLimit = 1000000): void
    {
        if(!empty($this->arFields)){
            $_SESSION["CASH_MACHINE"][session_id()][$this->arFields["NAME"]] = array(
                "SESSION_ID" => session_id(),
                "ID" => $this->arFields["NAME"],
                "ADDRESS" => $this->arFields["ADDRESS"],
                "WORK_TIME" => $this->arFields["WORK_TIME"],
                "BANKNOTES" => array(
                    "5000" => $this->arFields["BANKNOTES"]["5000"],
                    "2000" => $this->arFields["BANKNOTES"]["2000"],
                    "1000" => $this->arFields["BANKNOTES"]["1000"],
                    "500" => $this->arFields["BANKNOTES"]["500"],
                    "200" => $this->arFields["BANKNOTES"]["200"],
                    "100" => $this->arFields["BANKNOTES"]["100"],
                ),
                "LOAD_CASHMACHINE" => $this->arFields["LOAD_CASHMACHINE"],
            );
        }
    }

    public function getCashMachine()
    {
        if(isset($_SESSION["CASH_MACHINE"][session_id()])){
            return $_SESSION["CASH_MACHINE"][session_id()];
        }else{
//            $this->setCashMachine();
        }
        return $_SESSION["CASH_MACHINE"][session_id()];
    }

    public function setLimit($iLimit): void
    {
        $this->setCashMachine($iLimit);
    }

    public function getBanknotes(): array
    {
        return array(5000, 2000, 1000, 500, 200, 100);
    }
}