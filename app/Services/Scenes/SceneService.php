<?php
namespace app\Services\Scenes;

use App\Exceptions\LocationException;
use App\Models\Location;
use App\Models\Rover;
use Exception;

class SceneService {
    public $sceneTable = [];

    /**
     * Genera el escenario usando el objeto Location para indicar si tiene obstaculo o no
     * @return array
     */
    public function generateScene()
    {
        for($x = 1; $x <= 200; $x++){
            $this->sceneTable[$x] = [];
            for( $y = 1; $y <= 200; $y++){
                $location = new Location();
                if (rand(0, 1) == 1) {
                    $location->setIsBlocked(true);
                    $infoId = rand(1,3);
                    $location->setInfo($infoId);
                    $location->setXCoord($x);
                    $location->setYCoord($y);
                }
                $this->sceneTable[$x][$y] = $location;
            }
        }
        return $this->sceneTable;
    }

    /**
     * Procesa el movimiento del Rover por la tabla.
     */
    public function proceed(array $direction, array $scene, Rover $rover)
    {
        try{
            for($x = 0; $x < count($direction); $x++){
                    $xPosition = $rover->x_position;
                    $yPosition = $rover->y_position;
                if( $rover->direction == 'N' && $direction[$x] == 'F' || $rover->direction == 'E' && $direction[$x] == 'R' || $rover->direction == 'W' && $direction[$x] == 'L' ){
                    $this->checkLocation($scene[$xPosition-1][$yPosition]);
                    $rover->decreaseXPosition();
                } elseif( $rover->direction == 'S' && $direction[$x] == 'F' || $rover->direction == 'E' && $direction[$x] == 'L' || $rover->direction == 'W' && $direction[$x] == 'R'){
                    $this->checkLocation($scene[$xPosition+1][$yPosition]);
                    $rover->increaseXPosition();
                } elseif( $rover->direction == 'N' && $direction[$x] == 'R' || $rover->direction == 'S' && $direction[$x] == 'L' || $rover->direction == 'E' && $direction[$x] == 'F' ){
                    $this->checkLocation($scene[$xPosition][$yPosition+1]);
                    $rover->increaseYPosition();
                } elseif( $rover->direction == 'N' && $direction[$x] == 'L' || $rover->direction == 'S' && $direction[$x] == 'R' || $rover->direction == 'W' && $direction[$x] == 'F'){
                    $this->checkLocation($scene[$xPosition][$yPosition-1]);
                    $rover->decreaseYPosition();
                }
            }
            $message = 'The rover has reached its destination at X:'.$rover->x_position.' Y: '.$rover->y_position;
            return $message;
        } catch(Exception $exception){
           return $exception->getMessage();
        }
       
    }

    /**
     * Comprueba si la siguiente posicion del rover tiene un obstaculo o no
     * @return bool
     */
    public function checkLocation($location): bool
    {   
        if( $location->isBlocked ){
            throw new LocationException($location->info.' in X: '.$location->xCoord.' Y: '.$location->yCoord);
        }
        return $location->isBlocked;
    }
}