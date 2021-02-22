<?php

namespace cslTests\commands;

use csl\exceptions\ConstraintViolationException;
use Exception;
use PHPUnit\Framework\TestCase;
use csl\commands\RunCommand;
use csl\services\SpiralCalculator;
use csl\utils\BytesUtil;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @coversDefaultClass \csl\commands\RunCommand
 */
class RunCommandTest extends TestCase
{
    protected $spiralCalculator;
    protected $output;
    private $bytesUtil;
    /**
     * Unit under test
     */
    private RunCommand $runCommand;

    public function setUp(): void
    {
        $this->spiralCalculator = $this->createMock(SpiralCalculator::class);
        $this->bytesUtil = $this->createMock(BytesUtil::class);
        $this->output = $this->createMock(OutputInterface::class);

        $this->runCommand = new RunCommand($this->spiralCalculator);
    }

    public function runExceptionsDataProvider(): array
    {
        return [
            '#1: X Out-of-range' => [
                'x' => 1000101,
                'y' => 0,
                'exception' => new ConstraintViolationException('Coordinate value: 1000101 is out of range')
            ],
            '#2: X Out-of-range' => [
                'x' => -22222222222,
                'y' => 0,
                'exception' => new ConstraintViolationException('Coordinate value: -22222222222 is out of range')
            ],
            '#3: Y Out-of-range' => [
                'x' => -100,
                'y' => 22222222222,
                'exception' => new ConstraintViolationException('Coordinate value: 22222222222 is out of range')
            ],
            '#4: Y Out-of-range' => [
                'x' => -100,
                'y' => -22222222222,
                'exception' => new ConstraintViolationException('Coordinate value: -22222222222 is out of range')
            ]
        ];
    }

    /**
     * Test that `run` command properly throws exceptions
     *
     * @covers ::__construct
     * @covers ::__invoke
     *
     * @dataProvider runExceptionsDataProvider
     */
    public function testRunExceptions(
        int $x,
        int $y,
        Exception $exception
    ): void {
        $this->expectExceptionObject($exception);

        ($this->runCommand)($x, $y, false, $this->output, $this->bytesUtil);
    }

    public function runSuccessDataProvider(): array
    {
        return [
            '#1' => [
                'x' => 1000100,
                'y' => -1000000,
                'spiralLength' => 123
            ]
        ];
    }

    /**
     * @covers ::__construct
     * @covers ::__invoke
     *
     * @dataProvider runSuccessDataProvider
     */
    public function testRunSuccess(
        int $x,
        int $y,
        int $spiralLength
    ): void {
        $this->spiralCalculator->expects(self::once())
            ->method('getTotalLength')
            ->with($x, $y)
            ->willReturn($spiralLength);

        $this->output->expects(self::once())
            ->method('writeln')
            ->with("Spiral length for $x, $y: $spiralLength");

        ($this->runCommand)($x, $y, false, $this->output, $this->bytesUtil);
    }
}