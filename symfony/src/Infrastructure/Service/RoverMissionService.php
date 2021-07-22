<?php


namespace App\Infrastructure\Service;


use App\Domain\Model\Mars;
use App\Domain\Service\RoverMissionServiceInterface;
use function PHPUnit\Framework\throwException;

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
        $this->roverPosition['x'] = rand(0, 200);
        $this->roverPosition['y'] = rand(0, 200);
        $this->roverPosition['orientation'] = substr(str_shuffle("NSEW"), 0, 1);
        echo "The Rover has landed at (" . $this->roverPosition['x'] . "," . $this->roverPosition['y'] .")";
    }

    /**
     * Start mission in Mars with Rover
     *
     * @param string $commands
     * @return array[]
     * @throws \Exception
     */
    public function startMission(string $commands): array
    {
        // Get commands to move rover by Mars matrix
        foreach (str_split($commands) as $command) {
            switch ($command) {
                case 'F':
                    switch ($this->roverPosition['orientation']) {
                        case 'N':
                            // Increase Y
                            $nextYAxis = $this->roverPosition['y'] + 1;
                            // Validate next position
                            $this->roverPosition['y'] = $this->validateStep($this->roverPosition['x'], $nextYAxis)
                                ? $nextYAxis
                                : $this->roverPosition['y'];
                            break;
                        case 'S':
                            // Decrease Y
                            $nextYAxis = $this->roverPosition['y'] - 1;
                            // Validate next position
                            $this->roverPosition['y'] = $this->validateStep($this->roverPosition['x'], $nextYAxis)
                                ? $nextYAxis
                                : $this->roverPosition['y'];
                            break;
                        case 'E':
                            // Increase X
                            $nextXAxis = $this->roverPosition['x'] + 1;
                            // Validate next position
                            $this->roverPosition['x'] = $this->validateStep($nextXAxis, $this->roverPosition['y'])
                                ? $nextXAxis
                                : $this->roverPosition['x'];
                            break;
                        case 'W':
                            // Decrease X
                            $nextXAxis = $this->roverPosition['x'] - 1;
                            // Validate next position
                            $this->roverPosition['x'] = $this->validateStep($nextXAxis, $this->roverPosition['y'])
                                ? $nextXAxis
                                : $this->roverPosition['x'];
                            break;
                    }
                    break;
                case 'L':
                    switch ($this->roverPosition['orientation']) {
                        case 'N':
                            // Decrease X
                            $nextXAxis = $this->roverPosition['x'] - 1;
                            // Validate next position
                            $this->roverPosition['x'] = $this->validateStep($nextXAxis, $this->roverPosition['y'])
                                ? $nextXAxis
                                : $this->roverPosition['x'];
                            break;
                        case 'S':
                            // Increase X
                            $nextXAxis = $this->roverPosition['x'] + 1;
                            // Validate next position
                            $this->roverPosition['x'] = $this->validateStep($nextXAxis, $this->roverPosition['y'])
                                ? $nextXAxis
                                : $this->roverPosition['x'];
                            break;
                        case 'E':
                            // Increase Y
                            $nextYAxis = $this->roverPosition['y'] + 1;
                            // Validate next position
                            $this->roverPosition['y'] = $this->validateStep($this->roverPosition['x'], $nextYAxis)
                                ? $nextYAxis
                                : $this->roverPosition['y'];
                            break;
                        case 'W':
                            // Decrease Y
                            $nextYAxis = $this->roverPosition['y'] - 1;
                            // Validate next position
                            $this->roverPosition['y'] = $this->validateStep($this->roverPosition['x'], $nextYAxis)
                                ? $nextYAxis
                                : $this->roverPosition['y'];
                            break;
                    }
                    break;
                case 'R':
                    switch ($this->roverPosition['orientation']) {
                        case 'N':
                            // Increase X
                            $nextXAxis = $this->roverPosition['x'] + 1;
                            // Validate next position
                            $this->roverPosition['x'] = $this->validateStep($nextXAxis, $this->roverPosition['y'])
                                ? $nextXAxis
                                : $this->roverPosition['x'];
                            break;
                        case 'S':
                            // Decrease X
                            $nextXAxis = $this->roverPosition['x'] - 1;
                            // Validate next position
                            $this->roverPosition['x'] = $this->validateStep($nextXAxis, $this->roverPosition['y'])
                                ? $nextXAxis
                                : $this->roverPosition['x'];
                            break;
                        case 'E':
                            // Decrease Y
                            $nextYAxis = $this->roverPosition['y'] - 1;
                            // Validate next position
                            $this->roverPosition['y'] = $this->validateStep($this->roverPosition['x'], $nextYAxis)
                                ? $nextYAxis
                                : $this->roverPosition['y'];
                            break;
                        case 'W':
                            // Increase Y
                            $nextYAxis = $this->roverPosition['y'] + 1;
                            // Validate next position
                            $this->roverPosition['y'] = $this->validateStep($this->roverPosition['x'], $nextYAxis)
                                ? $nextYAxis
                                : $this->roverPosition['y'];
                            break;
                    }
            }
        }
        // Return result of exploration
        return array([
            'error' => false,
            'message' => "The Rover has reached its destination (" . $this->roverPosition['x'] . "," . $this->roverPosition['y'] .")"
        ]);
    }

    /**
     * Validate position with Mars surface and check possible collision with obstacle
     *
     * @param int $xAxis
     * @param string $yAxis
     * @return bool
     * @throws \Exception
     */
    private function validateStep(int $xAxis, string $yAxis): bool
    {
        if ($this->mars->checkBoundaries($xAxis, $yAxis)){
            if($this->mars->haveObstacle($xAxis, $yAxis)){
                // An error message would also be valid, but I wanted to use exceptions to show their use
                throw new \Exception('Cannot move to (' . $xAxis . ',' . $yAxis . ') position due to an obstacle. Rover remains on the position (' . $this->roverPosition['x'] . ',' . $this->roverPosition['y'] . ')');
            }
        }else{
            // An error message would also be valid, but I wanted to use exceptions to show their use
            throw new \Exception('It cannot exceed the limits of the Martian surface. Rover remains on the position (' . $this->roverPosition['x'] . ',' . $this->roverPosition['y'] . ')');
        }
        return true;
    }
}