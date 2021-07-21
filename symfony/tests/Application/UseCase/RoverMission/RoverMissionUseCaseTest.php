<?php

namespace App\Tests\Application\UseCase\RoverMission;

use App\Application\UseCase\RoverMission\RoverMissionRequest;
use App\Application\UseCase\RoverMission\RoverMissionUseCase;
use App\Infrastructure\Service\RoverMissionService;
use PHPUnit\Framework\TestCase;

class RoverMissionUseCaseTest extends TestCase
{
    public function test()
    {
        try {
            $request = new RoverMissionRequest();
            $request->commands = 'FFRRFFFRL';
            $service = $this->createService();
            $useCase = new RoverMissionUseCase($service);
            $response = $useCase->run($request);
            $this->assertJson($response);
        } catch (\Exception $e) {
            $this->expectException(\Exception::class);
            throw $e;
        }
    }

    private function createService(): RoverMissionService
    {

        return new RoverMissionService();
    }
}
