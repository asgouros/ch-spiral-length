<?php

namespace cslTests\services;

use PHPUnit\Framework\TestCase;
use csl\services\SpiralCalculator;

/**
 * @coversDefaultClass \csl\services\SpiralCalculator
 */
class SpiralCalculatorTest extends TestCase
{
    /**
     * Unit under test
     */
    private SpiralCalculator $spiralCalculator;

    protected function setUp(): void
    {
        $this->spiralCalculator = new SpiralCalculator();
    }

    public function getTotalLengthProvider(): array
    {
        return [
            'TestCase #1' => [
                'x' => 1,
                'y' => 1,
                'expected' => 2,
            ],
            'TestCase #2' => [
                'x' => 2,
                'y' => -2,
                'expected' => 16,
            ],
            'TestCase #3' => [
                'x' => -2,
                'y' => -2,
                'expected' => 20,
            ],
            'TestCase #4' => [
                'x' => 4,
                'y' => 4,
                'expected' => 56,
            ]
        ];
    }

    /**
     * @covers ::getTotalLength
     *
     * @dataProvider getTotalLengthProvider
     */
    public function testGetTotalLength(
        int $x,
        int $y,
        int $expected
    ): void {
        $actual = $this->spiralCalculator->getTotalLength($x, $y);

        self::assertSame($expected, $actual);
    }
}