<?php

namespace korolev\cashmachine\classes;

class User
{
    const BANKNOTES = array(5000, 2000, 1000, 500, 200, 100);
    private int $limit;

    public function __construct()
    {
        $this->limit = 100000;
    }

    public function setUser(): void
    {
        $_SESSION["USER"][session_id()] = array(
            "LIMIT" => $this->limit,
        );
    }

    public function getUser(): array
    {
        if(isset($_SESSION["USER"][session_id()])){
            return $_SESSION["USER"][session_id()];
        }else{
            $this->setUser();
        }
        return $_SESSION["USER"][session_id()];
    }

    public function setLimit($iLimit): void
    {
        $this->limit = $iLimit;
        $this->setUser();
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
            $this->setLimit($this->limit);
        }
        return $arResult;
    }
}