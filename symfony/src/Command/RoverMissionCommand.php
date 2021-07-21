<?php

namespace App\Command;

use App\Application\UseCase\RoverMission\RoverMissionRequest;
use App\Application\UseCase\RoverMission\RoverMissionUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;

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
            ->setDescription('Mars Rover Mission - The rover can move forward (F) - The rover can move left/right (L,R).')
            ->addArgument('commands', InputArgument::REQUIRED, 'Collection of commands to move rover.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $io->note('Validating commands to start the exploration of Mars...');
        $commands = $input->getArgument('commands');
        $output->writeln('Commands received: ' . $commands);
        $io->newLine();

        // Validate commands
        if(!$this->validateCommands($commands)){
            $io->error('The collection of commands are invalid. The valid commands are: F,L,R. Fix collection of commands and try again.');
            return 0;
        }
        $request = new RoverMissionRequest();
        $request->commands = $commands;
        $response = $this->useCase->run($request);
        if (!json_decode($response, true)['result'][0]['error']) {
            $io->success(json_decode($response, true)['result'][0]['message']);
        } else {
            $io->error('The Rover was unable to reach its destination');
        }

        return 0;
    }

    /**
     * Validate input commands from earth
     * @param string $commands
     * @return bool
     */
    private function validateCommands(string $commands): bool
    {
        preg_match('/[^flr]/i', $commands, $matches);
        return count($matches) === 0;
    }
}
