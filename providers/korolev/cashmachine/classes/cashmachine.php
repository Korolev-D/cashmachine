<?php

namespace providers\korolev\cashmachine\classes;
class CashMachine
{
    const CASH_MACHINE_DIR = __DIR__ . "/../../../../storage/cashmachines/";
    const LOG_DIR = __DIR__ . "/../../../../log";
    const COLORS = array("blue", "tomato", "green");
    private $arFields;
    private array $arPost;
    private array $arGet;

    public function __construct()
    {
        $this->setCashMachine();
        $this->arPost = $_POST;
        $this->arGet = $_GET;
        $this->arFields = $this->arPost["FIELDS"] ?? array();

        if($this->arGet["reload"] === "Y"){
            session_unset();
            session_destroy();
        }
    }

    public function setCashMachine(): void
    {
        if(!empty($this->arFields)){
            $sFilename = self::CASH_MACHINE_DIR . "{$this->arFields["ID"]}.txt";
            try{
                file_put_contents($sFilename,
                    json_encode(
                        array(
                            "ID" => $this->arFields["ID"],
                            "COLOR" => self::COLORS[array_rand(self::COLORS)],
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
                            "BALANCE" => $this->arFields["BALANCE"],
                        )
                    )
                );
            }catch(\Exception $e){
                $sFilename = self::LOG_DIR . "cashmachines.txt";
                file_put_contents($sFilename, PHP_EOL . date("d.m.Y H:i:s") . $e->getMessage(), FILE_APPEND);
            }
        }
    }

    public function getCashMachineItems(): array
    {
        $arResult = array();
        try{
            foreach(scandir(self::CASH_MACHINE_DIR) as $file){
                if(!in_array($file, array(".", ".."))){
                    $arResult[] = json_decode(file_get_contents(self::CASH_MACHINE_DIR . $file), true);
                }
            }
        }catch(\Exception $e){
            $sFilename = self::LOG_DIR . "cashmachines.txt";
            file_put_contents($sFilename, PHP_EOL . date("d.m.Y H:i:s") . $e->getMessage(), FILE_APPEND);
        }
        return $arResult;
    }

    public function getCashMachine($iId): array
    {
        $arResult = array();
        $sFilename = self::CASH_MACHINE_DIR . "{$iId}.txt";
        if(file_exists($sFilename)){
            $arResult = json_decode(file_get_contents($sFilename), true);
        }
        return $arResult;
    }

    public function getBanknotes(): array
    {
        return array(5000, 2000, 1000, 500, 200, 100);
    }
}