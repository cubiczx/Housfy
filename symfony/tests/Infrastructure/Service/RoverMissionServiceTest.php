<?php

namespace App\Tests\Infrastructure\Service;

use App\Domain\Service\RoverMissionServiceInterface;
use App\Infrastructure\Service\RoverMissionService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class RoverMissionServiceTest extends TestCase
{
    protected $roverMissionService;

    /**
     * @return MockObject|RoverMissionServiceInterface
     */
    protected function getRoverMissionService()
    {
        return $this->roverMissionService = $this->roverMissionService ?: $this->createMock(RoverMissionServiceInterface::class);
    }

    /**
     * @throws ResourceNotFoundException
     * @throws CustomerNotFoundException
     * @throws \Exception
     */
    public function testStartMission(): void
    {
        try {
            $roverMissionService = new RoverMissionService();
            $missionResponse = $roverMissionService->startMission('FFRRFFFRL');
            $this->assertIsArray($missionResponse);
            $this->assertArrayHasKey('error', $missionResponse[0]);
            $this->assertArrayHasKey('message', $missionResponse[0]);
        } catch (\Exception $e) {
            $this->expectException(\Exception::class);
            throw $e;
        }
    }

}