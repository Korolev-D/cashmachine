<?php

namespace providers\korolev\cashmachine\classes;
class CashMachine
{
    const BASE_DIR = __DIR__ . "/../../../../storage/cashmachines/";
    const LOG_DIR = __DIR__ . "/../../../../log";
    private $arFields;
    private array $arPost;

    public function __construct()
    {
        $this->setCashMachine();
        $this->arPost = $_POST;
        $this->arFields = $this->arPost["FIELDS"];
    }

    public function setCashMachine(): void
    {
        if(!empty($this->arFields)){
            $sFilename = self::BASE_DIR . "{$this->arFields["NAME"]}.txt";
            try{
                file_put_contents($sFilename,
                    json_encode(
                        array(
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
                        )
                    )
                );
            }catch(\Exception $e){
                $sFilename = self::LOG_DIR . "cashmachines.txt";
                file_put_contents($sFilename, PHP_EOL . date("d.m.Y H:i:s") . $e->getMessage(), FILE_APPEND);
            }
        }
    }

    public function getCashMachine(): array
    {
        $arResult = array();
        try{
            foreach(scandir(self::BASE_DIR) as $file){
                if(!in_array($file, array(".", ".."))){
                    $arResult[] = json_decode(file_get_contents(self::BASE_DIR . $file), true);
                }
            }
        }catch(\Exception $e){
            $sFilename = self::LOG_DIR . "cashmachines.txt";
            file_put_contents($sFilename, PHP_EOL . date("d.m.Y H:i:s") . $e->getMessage(), FILE_APPEND);
        }
        return $arResult;
    }

    public function getBanknotes(): array
    {
        return array(5000, 2000, 1000, 500, 200, 100);
    }
}