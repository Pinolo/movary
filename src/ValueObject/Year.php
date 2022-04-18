<?php declare(strict_types=1);

namespace Movary\ValueObject;

class Year implements \JsonSerializable
{
    private const MIN_YEAR_ALLOWED = 1901;

    private const MAX_YEAR_ALLOWED = 2155;

    private int $year;

    private function __construct(int $year)
    {
        $this->ensureValidRange($year);
        $this->year = $year;
    }

    public static function createFromInt(int $year) : self
    {
        return new self($year);
    }

    public static function createFromString(string $year) : self
    {
        return new self((int)$year);
    }

    public function __toString() : string
    {
        return (string)$this->year;
    }

    public function asInt() : int
    {
        return $this->year;
    }

    public function jsonSerialize() : int
    {
        return $this->year;
    }

    private function ensureValidRange(int $year) : void
    {
        if ($year < self::MIN_YEAR_ALLOWED || $year > self::MAX_YEAR_ALLOWED) {
            throw new \InvalidArgumentException('Year has to be between 1901 and 2155, invalid value: ' . $year);
        }
    }
}