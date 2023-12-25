<?php

namespace providers\korolev\cashmachine\classes;

class User
{
    const BANKNOTES = array(5000, 2000, 1000, 500, 200, 100);
    const LOGIN = "mendeleev";
    const PASSWORD = "f9lVbUSUaDP3HOeRLxYSYPp%bzGW%w";
    private int $limit;
    private array $arPost;

    public function __construct()
    {
        $this->limit = 100000;
        $this->arPost = $_POST;
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
}