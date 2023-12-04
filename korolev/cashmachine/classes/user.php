<?php

namespace korolev\cashmachine\classes;

class User
{

    public function __construct()
    {

    }

    public function setUser(int $iLimit = 100000): void
    {
        $_SESSION["USER"][session_id()] = array(
            "LIMIT" => $iLimit,
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
        $this->setUser($iLimit);
    }
}