<?php

namespace App\Command;

use App\Application\UseCase\RoverMission\RoverMissionRequest;
use App\Application\UseCase\RoverMission\RoverMissionUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class RoverMissionCommand
 * @package App\Command
 */
class RoverMissionCommand extends Command
{

    protected static $defaultName = 'housfy:rover-mission';

    /** @var RoverMissionUseCase */
    protected $useCase;

    public function __construct(RoverMissionUseCase $useCase)
    {
        parent::__construct();
        $this->useCase = $useCase;
    }

    protected function configure(): void
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Mars Rover Mission - The rover can move forward (F) - The rover can move left/right (L,R).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $io->note('Validating offers suspected of having a wrong price...');
        $io->newLine();

        $request = new RoverMissionRequest();
        $response = $this->useCase->run($request);
        if (json_decode($response, true)['result']) {
            $io->success('Offers that are above average!');
            var_dump(json_decode($response, true)['result']);
        } else {
            $io->error('Error validating offers suspected of having a wrong price!');
        }

        return 0;
    }
}
