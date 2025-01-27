<?php

namespace App\Http\Controllers;

use App\Models\Rover;
use App\Services\Scenes\SceneService;
use Illuminate\Http\Request;

class RoverController extends Controller
{
    public $sceneService;
    protected $gridSize = 200;
    protected $directions = ['N', 'E', 'S', 'W'];
    protected $obstacles = [];

    public function __construct(SceneService $sceneService){
        $this->sceneService = $sceneService;
    }

    public function index()
    {
        return view('welcome');
    }

    /**
     * Funcion que procesa el movimiento dado por el input
     * @param Request $request
     */
    public function proceedMovement(Request $request)
    {
        $command = str_split($request->command);
        $scene = $this->getScene();        
        $rover = $this->getRover();

        $info = $this->sceneService->proceed($command, $scene, $rover);
        return $info;
    }

    /**
     * Obtiene la tabla con los obstaculos;
     */
    private function getScene()
    {
        return $this->sceneService->generateScene();
    }

    /**
     * Crea el objeto rover que nos permitira movernos por la tabla.
     */
    private function getRover(){
        $rover = new Rover();

        $directionId = rand(1,4);
        $rover->setDirection($directionId);
        return $rover;
    }
}
