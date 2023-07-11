<?php

declare(strict_types=1);

namespace Dot\Twig\Extension;

use DateTimeInterface;
use DateTimeZone;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

use function twig_date_converter;

class DateExtension extends AbstractExtension
{
    public static array $units = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];

    public function getFilters(): array
    {
        return [
            new TwigFilter('time_diff', [$this, 'diff'], ['needs_environment' => true]),
        ];
    }

    /**
     * Filters for converting dates to a time ago string like Facebook and Twitter has.
     * If none given, the current time will be used.
     */
    public function diff(
        Environment $env,
        string|DateTimeInterface|null $date,
        string|DateTimeZone|null $now = null
    ): string {
        // Convert both dates to DateTime instances.
        $date = twig_date_converter($env, $date);
        $now  = twig_date_converter($env, $now);

        // Get the difference between the two DateTime objects.
        $diff = $date->diff($now);

        // Check for each interval if it appears in the $diff object.
        foreach (self::$units as $attribute => $unit) {
            $count = $diff->$attribute;

            if (0 !== $count) {
                return $this->getPluralizedInterval($count, $diff->invert, $unit);
            }
        }

        return '';
    }

    public function getPluralizedInterval(mixed $count, int $invert, string $unit): string
    {
        if (1 !== $count) {
            $unit .= 's';
        }

        return $invert ? "in $count $unit" : "$count $unit ago";
    }
}
