<?php

namespace csl\commands;

use csl\exceptions\ConstraintViolationException;
use csl\services\SpiralCalculator;
use csl\utils\BytesUtil;
use Silly\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class responsibilities:
 * - read input parameters
 * - delegates spiral length calculation to proper Service
 * - prepares output
 */
class RunCommand extends Command
{
    /**
     * Coordinate values limits
     */
    private const COORDINATE_VALUE_MIN = -1000000;
    private const COORDINATE_VALUE_MAX = 1000100;

    /**
     * @var SpiralCalculator
     */
    private SpiralCalculator $spiralCalculator;

    public function __construct(
        SpiralCalculator $spiralCalculator
    ) {
        parent::__construct();

        $this->spiralCalculator = $spiralCalculator;
    }

    /**
     * @throws ConstraintViolationException
     */
    public function __invoke(
        int $x,
        int $y,
        bool $mem,
        OutputInterface $output,
        BytesUtil $bytesUtil
    ): void {
        if ($mem) {
            // Print max. allocated memory
            $output->writeln($bytesUtil->formatBytes(memory_get_peak_usage()));
        }

        foreach ([$x, $y] as $coordinate) {
            if (($coordinate > self::COORDINATE_VALUE_MAX)
                || ($coordinate < self::COORDINATE_VALUE_MIN)
            ) {
                throw new ConstraintViolationException("Coordinate value: $coordinate is out of range");
            }
        }

        $output->writeln(sprintf('Spiral length: %s', $this->spiralCalculator->getTotalLength($x, $y)));
    }
}