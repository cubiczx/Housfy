<?php


namespace App\Application\UseCase\RoverMission;


use App\Domain\Service\RoverMissionServiceInterface;

class RoverMissionUseCase
{

    /** @var RoverMissionServiceInterface */
    private $managerService;

    public function __construct(
        RoverMissionServiceInterface $managerService
    )
    {
        $this->managerService = $managerService;
    }

    /**
     * @param RoverMissionRequest $request
     * @return false|string
     */
    public function run(RoverMissionRequest $request)
    {
        $result = $this->managerService->startMission($request->commands);

        return json_encode([
            'result' => $result
        ]);
    }
}