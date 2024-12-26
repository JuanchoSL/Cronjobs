<?php declare(strict_types=1);

namespace JuanchoSL\Cronjobs\Entities;

use JuanchoSL\Cronjobs\Contracts\ProgrammingInterface;

class Programming implements ProgrammingInterface
{

    protected string $hour = '*';
    protected string $minute = '*';
    protected string $day_of_month = '*';
    protected string $month = '*';
    protected string $day_of_week = '*';

    public function setMinute(string $minute): static
    {
        $this->minute = $minute;
        return $this;
    }

    public function setHour(string $hour): static
    {
        $this->hour = $hour;
        return $this;
    }

    public function setDayOfMonth(string $day_of_month): static
    {
        $this->day_of_month = $day_of_month;
        return $this;
    }

    public function setMonth(string $month): static
    {
        $this->month = $month;
        return $this;
    }

    public function setDayOfWeek(string $day_of_week): static
    {
        $this->day_of_week = $day_of_week;
        return $this;
    }

    public function getMinute(): string
    {
        return $this->minute;
    }

    public function getHour(): string
    {
        return $this->hour;
    }

    public function getDayOfMonth(): string
    {
        return $this->day_of_month;
    }

    public function getMonth(): string
    {
        return $this->month;
    }

    public function getDayOfWeek(): string
    {
        return $this->day_of_week;
    }
}