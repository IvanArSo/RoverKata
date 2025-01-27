<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $isBlocked = false;
    public $info;
    public $xCoord;
    public $yCoord;
    CONST INFO_DESCRIPTIONS = [1 => "There is a rock", 2 => "A wall blocks your way", 3 => "There is a cliff"];

    public function setIsBlocked( $blocked )
    {
        $this->isBlocked = $blocked;
    }

    public function setInfo( $infoId )
    {
        $this->info = $this::INFO_DESCRIPTIONS[$infoId];
    }

    public function setXCoord( $xCoord )
    {
        $this->xCoord = $xCoord;
    }

    public function setYCoord( $yCoord )
    {
        $this->yCoord = $yCoord;
    }
}
