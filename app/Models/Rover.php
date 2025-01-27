<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rover extends Model
{
    const FACING_DIRECTION = [1 => 'N', 2 => 'S', 3 => 'W', 4 => 'E'];

    public $currentPos = ['x' => 100, 'y' => 100];
    public $direction;
    
    /**
     * Obtiene la posicion X actual del rover
     * @return int
     */
    public function getXPositionAttribute(): int
    {
        return $this->currentPos['x'];
    }

    /**
     * Obtiene la posicion Y actual del rover
     * @return int
     */
    public function getYPositionAttribute(): int
    {
        return $this->currentPos['y'];
    }
    
    /**
     * Obtiene el punto cardinal al que mira el rover
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Indica el punto cardinal al que mirara el rover
     * @param $directionId
     */
    public function setDirection($directionId)
    {
        $this->direction = $this::FACING_DIRECTION[$directionId];
    }

    /**
     * Incrementa la coordenada X del rover
     */
    public function increaseXPosition()
    {
        $this->currentPos['x'] = $this->currentPos['x'] + 1;
    }

    /**
     * Reduce la coordenada X del rover
     */
    public function decreaseXPosition()
    {
        $this->currentPos['x'] = $this->currentPos['x'] - 1;
    }

    /**
     * Incrementa la coordenada Y del rover
     */
    public function increaseYPosition()
    {
        $this->currentPos['y'] = $this->currentPos['y'] + 1;
    }

    /**
     * Reduce la coordenada Y del rover
     */
    public function decreaseYPosition()
    {
        $this->currentPos['y'] = $this->currentPos['y'] - 1;
    }
}
