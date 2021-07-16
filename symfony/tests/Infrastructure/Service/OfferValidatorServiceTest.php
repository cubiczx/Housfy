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
     */
    public function testShouldReturnCustomerSnapshotIfOperationIsNotActive(): void
    {
        $roverMissionService = new RoverMissionService();

        $offersAboveAverage = $roverMissionService->validateOffers();
        $this->assertIsArray($offersAboveAverage);
        $this->assertArrayHasKey('5', $offersAboveAverage);
    }

}