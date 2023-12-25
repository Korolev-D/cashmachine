<?php

namespace providers\korolev\cashmachine\classes;

class CashMachine
{
    public function __construct()
    {
        $this->setCashMachine();
    }

    public function setCashMachine(int $iLimit = 1000000): void
    {
        $arQuery = $_GET;
        $arFields = $arQuery["FIELDS"];
//        $_SESSION["CASH_MACHINE"][session_id()] = array();
        if(!empty($arFields)){
            $_SESSION["CASH_MACHINE"][session_id()][$arFields["NAME"]] = array(
                "SESSION_ID" => session_id(),
                "ID" => $arFields["NAME"],
                "ADDRESS" => $arFields["ADDRESS"],
                "WORK_TIME" => $arFields["WORK_TIME"],
                "BANKNOTES" => array(
                    "5000" => $arFields["BANKNOTES"]["5000"],
                    "2000" => $arFields["BANKNOTES"]["2000"],
                    "1000" => $arFields["BANKNOTES"]["1000"],
                    "500" => $arFields["BANKNOTES"]["500"],
                    "200" => $arFields["BANKNOTES"]["200"],
                    "100" => $arFields["BANKNOTES"]["100"],
                ),
                "LOAD_CASHMACHINE" => $arFields["LOAD_CASHMACHINE"],
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
}