<?php declare(strict_types=1);

namespace JuanchoSL\Cronjobs\Contracts;

interface ProgrammingInterface
{

    /**
     * Set the desired execution minute
     * @param string $var Minute for execution or * for all minutes
     * @return static The same object
     */
    public function setMinute(string $var): static;

    /**
     * Set the desired execution hour
     * @param string $var Hour for execution or * for all hours
     * @return static The same object
     */
    public function setHour(string $var): static;

    /**
     * Set the desired execution minute
     * @param string $var Minute for execution or * for all minutes
     * @return static The same object
     */
    public function setDayOfMonth(string $var): static;

    /**
     * Set the desired execution day of week
     * @param string $var Day of week for execution or * for all days
     * @return static The same object
     */
    public function setMonth(string $var): static;

    /**
     * Set the desired execution month
     * @param string $var Month for execution or * for all months
     * @return static The same object
     */
    public function setDayOfWeek(string $var): static;

    public function getMinute(): string;
    public function getHour(): string;
    public function getDayOfMonth(): string;
    public function getMonth(): string;
    public function getDayOfWeek(): string;
}