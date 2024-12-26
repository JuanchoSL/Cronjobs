<?php declare(strict_types=1);

namespace JuanchoSL\Cronjobs;

use JuanchoSL\Terminal\Command;
use JuanchoSL\Terminal\Contracts\InputInterface;
use JuanchoSL\Terminal\Enums\InputArgument;
use JuanchoSL\Terminal\Enums\InputOption;

class ExampleCommand extends Command
{
    public function getName(): string
    {
        return 'example';
    }
    public function configure(): void
    {
        $this->addArgument('command', InputArgument::REQUIRED, InputOption::SINGLE);
    }
    public function execute(InputInterface $input): int
    {
        $this->write($input->getArgument('command'));
        return 0;
    }
}