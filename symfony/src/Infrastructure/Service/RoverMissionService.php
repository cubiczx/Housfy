<?php


namespace App\Infrastructure\Service;


use App\Domain\Model\Mars;
use App\Domain\Service\RoverMissionServiceInterface;

class RoverMissionService implements RoverMissionServiceInterface
{
    /**
     * @var Mars $mars
     */
    private $mars;

    /**
     * @var array $roverPosition
     */
    private $roverPosition;

    public function __construct(){
        // Create matrix of Mars
        $this->mars = new Mars();
        $this->roverPosition[0][0] = 0;
        echo "__construct";
        var_dump($this->roverPosition);
    }

    /**
     * Start mission in Mars with Rover
     *
     * @param string $commands
     * @return array
     */
    public function startMission(string $commands): array
    {
        // var_dump($this->mars);
        // Get commands to move rover by Mars matrix
        foreach (str_split($commands) as $command) {
            echo $command;
            switch ($command) {
                case 'F':
                    // Increase Y
                    //$this->roverPosition[][]
                    break;
                case 'L':
                    // Decrease X
                    break;
                case 'R':
                    // Increase X
                    break;
            }
        }
        // Return result of exploration

        // Return
        return array();
    }
}