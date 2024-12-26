<?php declare(strict_types=1);

namespace JuanchoSL\Cronjobs;

use JuanchoSL\Terminal\Contracts\CommandInterface;
use JuanchoSL\Terminal\Contracts\InputInterface;
use JuanchoSL\Cronjobs\Contracts\ProgrammingInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class Crontab implements LoggerAwareInterface
{

    use LoggerAwareTrait;

    /**
     * Summary of commands
     * @var array<string, CommandInterface>
     */
    protected array $commands = [];

    protected bool $debug = false;

    public function setDebug(bool $debug = false): static
    {
        $this->debug = $debug;
        return $this;
    }

    public function add(CommandInterface $command, InputInterface $input, ProgrammingInterface $program): void
    {
        if (isset($this->logger)) {
            $command->setLogger($this->logger);
        }
        $command->setDebug($this->debug);
        $this->commands[] = [
            'command' => $command,
            'input' => $input,
            'time' => $program
        ];
    }

    protected function checkTimmer(ProgrammingInterface $program): bool
    {

        foreach (['i' => $program->getMinute(), 'G' => $program->getHour(), 'j' => $program->getDayOfMonth(), 'm' => $program->getMonth()] as $param => $value) {
            if ($value != '*') {
                $comparator = date($param);
                $value = str_replace('*', $comparator, $value);
                if (strpos($value, ',') !== false) {
                    if (!in_array($comparator, array_map('trim', explode(',', $value)))) {
                        return false;
                    }
                } elseif (strpos($value, '/') !== false) {
                    $value = str_replace('/', '%', $value);
                    if (eval ("return $value;") != 0) {
                        return false;
                    }
                } elseif ($comparator != $value) {
                    return false;
                }

            }
        }
        return true;
    }

    public function run(): int
    {
        if ($this->debug) {
            $this->logger?->debug("Starting cronjobs");
        }
        $executable = [];
        foreach ($this->commands as $command) {
            if ($this->checkTimmer($command['time'])) {
                if ($this->debug) {
                    $this->logger?->debug("Need to execute {cronjob}", ['cronjob' => $command['command']->getName()]);
                }
                $executable[] = $command;
            }
        }
        foreach ($executable as $command) {
            $this->logger?->info("Start executing {cronjob}", ['cronjob' => $command['command']->getName()]);
            $command['command']->run($command['input']);
            $this->logger?->info("End executing {cronjob}", ['cronjob' => $command['command']->getName()]);
        }
        return 0;
    }
}
