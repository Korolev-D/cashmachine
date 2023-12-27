<?php

namespace providers\korolev\cashmachine\classes;

class User
{
    const CASH_MACHINE_DIR = __DIR__ . "/../../../../storage/cashmachines/";
    const USER_DIR = __DIR__ . "/../../../../storage/users/";
    const LOG_DIR = __DIR__ . "/../../../../log";
    const BANKNOTES = array(5000, 2000, 1000, 500, 200, 100);
    const LOGIN = "mendeleev";
    const PASSWORD = "f9lVbUSUaDP3HOeRLxYSYPp%bzGW%w";
    private int $limit;
    private array $arPost;
    private array $arFields;
    private array $arGet;

    public function __construct()
    {
        $this->limit = 100000;
        $this->arPost = $_POST;
        $this->arGet = $_GET;
        $this->arFields = $this->arPost["FIELDS"] ?? array();

        if(!empty($this->arFields["ACTION"]) && $this->arFields["ACTION"] === "exit"){
            session_unset();
            session_destroy();
        }

        if(!empty($this->arFields["ACTION"]) && $this->arFields["ACTION"] === "ok" && !empty($this->arFields["PIN_CODE"])){
            $sFilename = self::USER_DIR . "{$this->arFields["PIN_CODE"]}.txt";
            $_SESSION["USER"] = $this->arFields["PIN_CODE"];
            if(!file_exists($sFilename)){
                file_put_contents($sFilename,
                    json_encode(
                        array(
                            "BALANCE" => 100000,
                            "PIN_CODE" => $this->arFields["PIN_CODE"],
                        )
                    )
                );
            }
        }

        if(!empty($this->arFields["ACTION"]) && $this->arFields["ACTION"] === "ok" && !empty($this->arFields["GET_MONEY"])){
            $arUser = $this->getUser();
            $iGetMoney = (int)$this->arFields["GET_MONEY"];
            if(!empty($arUser)){
                $arCashMachine = array();
                $sFileCashMachineName = self::CASH_MACHINE_DIR . "{$this->arGet["id"]}.txt";
                $filePath = realpath($sFileCashMachineName);
                if($filePath !== false && is_file($filePath)){
                    $arCashMachine = json_decode(file_get_contents($filePath), true);
                }
                if((int)$arUser["BALANCE"] - $iGetMoney > 0 && (int)$arCashMachine["BALANCE"] - $iGetMoney > 0){
                    $arUser["BALANCE"] -= $iGetMoney;
                    $sFileUsername = self::USER_DIR . $_SESSION["USER"] . ".txt";
                    file_put_contents($sFileUsername,
                        json_encode(
                            array(
                                "BALANCE" => $arUser["BALANCE"],
                                "PIN_CODE" => $this->arFields["PIN_CODE"],
                                "SUM" => $this->arFields["GET_MONEY"],
                                "BANKNOTES" => $this->getCash($iGetMoney),
                            )
                        )
                    );
                    $arCashMachine["BALANCE"] -= $iGetMoney;
                    file_put_contents($sFileCashMachineName,
                        json_encode(
                            array(
                                "ID" => $arCashMachine["ID"],
                                "COLOR" => $arCashMachine["COLOR"],
                                "ADDRESS" => $arCashMachine["ADDRESS"],
                                "WORK_TIME" => $arCashMachine["WORK_TIME"],
                                "BANKNOTES" => array(
                                    "5000" => $arCashMachine["BANKNOTES"]["5000"],
                                    "2000" => $arCashMachine["BANKNOTES"]["2000"],
                                    "1000" => $arCashMachine["BANKNOTES"]["1000"],
                                    "500" => $arCashMachine["BANKNOTES"]["500"],
                                    "200" => $arCashMachine["BANKNOTES"]["200"],
                                    "100" => $arCashMachine["BANKNOTES"]["100"],
                                ),
                                "BALANCE" => $arCashMachine["BALANCE"],
                            )
                        )
                    );
                    $_POST["STATUS_GET_MONEY"] = "Y";
                }else{
                    $_POST["STATUS_GET_MONEY"] = "N";
                }
            }
        }
    }

    public function getUser(): array
    {
        $arResult = array();
        if(isset($_SESSION["USER"])){
            $sFilename = self::USER_DIR . $_SESSION["USER"] . ".txt";
            $filePath = realpath($sFilename);
            if($filePath !== false && is_file($filePath)){
                $arResult = json_decode(file_get_contents($filePath), true);
            }
        }
        return $arResult;
    }

    public function getCash($iSum): array
    {
        $arResult = array();
        $arBanknotes = self::BANKNOTES;

        if($iSum < $this->limit){
            $this->limit -= $iSum;
            foreach($arBanknotes as $arBanknote){
                $iCount = 1;
                while($iSum - $arBanknote >= 0){
                    $iSum -= $arBanknote;
                    $arResult[$arBanknote] = $iCount++;
                }
            }
        }
        return $arResult;
    }

    public function isAdmin(): bool
    {
        return $_SESSION["USER"][session_id()]["IS_ADMIN"] === "Y";
    }

    public function checkAdmin(): string
    {
        $bResult = $this->arPost["FIELDS"]["NAME"] === self::LOGIN && $this->arPost["FIELDS"]["PASSWORD"] === self::PASSWORD;
        $_SESSION["USER"][session_id()]["IS_ADMIN"] = $bResult ? "Y" : "";
        return $bResult ? "" : "Неверный логин или пароль!";
    }

    public function isAuthorized(): bool
    {
        return !empty($this->getUser());
    }
}