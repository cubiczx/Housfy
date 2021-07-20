<?php


namespace App\Domain\Service;


interface RoverMissionServiceInterface
{

    public function startMission(string $commands);
}