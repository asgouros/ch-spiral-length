<?php

namespace csl\services;

use RuntimeException;

/**
 * Encapsulates Spiral calculation logic
 */
class SpiralCalculator
{
    private const DIRECTION_UP = 1;
    private const DIRECTION_RIGHT = 2;
    private const DIRECTION_DOWN = 3;
    private const DIRECTION_LEFT = 4;

    /**
     * Clockwise order of directions
     */
    private const DIRECTIONS_CLOCKWISE = [
        self::DIRECTION_UP,
        self::DIRECTION_RIGHT,
        self::DIRECTION_DOWN,
        self::DIRECTION_LEFT
    ];

    /**
     * Key: X, Value: Y
     * Pairs of coordinates that have already been visited
     */
    private array $visitedBlocks = [0 => [0]];

    private int $currentX = 0;
    private int $currentY = 0;
    private int $lastDirection = 0;
    private int $blocksCount = 0;

    /**
     * Calculates the length of a spiral starting from the center and going outwards until it reaches
     * a given point (coordinates)
     */
    public function getTotalLength(int $targetX, int $targetY): int
    {
        // Point to first direction
        $nextDirection = self::DIRECTIONS_CLOCKWISE[0];

        // Move unit target is reached.
        while (($this->currentX !== $targetX)
            || ($this->currentY !== $targetY)
        ) {
            $nextDirection = $this->move($nextDirection);
        }

        return $this->blocksCount;
    }

    private function move(int $direction): int
    {
        [$nextX, $nextY] = $this->getNextPoint($direction);

        if (!isset($this->visitedBlocks[$nextX][$nextY])) {
            // Next x,y have not be visited before. Visit them!
            $this->visitPoint($nextX, $nextY, $direction);

            // Respond with next direction
            return $this->getNextDirection($direction);
        }

        // Keep moving in the last direction
        return $this->lastDirection;
    }

    /**
     * Based on current point, and passed move, get the next x,y point
     */
    private function getNextPoint(int $move): array
    {
        $nextX = $this->currentX;
        $nextY = $this->currentY;
        switch ($move) {
            case self::DIRECTION_UP:
                $nextY = $this->currentY + 1;
                break;
            case self::DIRECTION_RIGHT:
                $nextX = $this->currentX + 1;
                break;
            case self::DIRECTION_DOWN:
                $nextY = $this->currentY - 1;
                break;
            case self::DIRECTION_LEFT:
                $nextX = $this->currentX - 1;
                break;
            default:
                throw new RuntimeException('Unknown $nextMove value: ' . $move);
        }

        return [$nextX, $nextY];
    }

    /**
     * Mark that a x,y has been visited over a passed move. Also handle all necessary tracking
     */
    private function visitPoint(int $x, int $y, int $move): void
    {
        $this->visitedBlocks[$x][$y] = true;
        $this->blocksCount++;
        $this->currentX = $x;
        $this->currentY = $y;
        $this->lastDirection = $move;
    }

    /**
     * Get the next feasible move after passed move
     */
    private function getNextDirection(int $move): int
    {
        $nextMove = ($move + 1);
        $nextMoveIndex = (($nextMove > 4) ? $nextMove % 4 : $nextMove) - 1;

        return self::DIRECTIONS_CLOCKWISE[$nextMoveIndex];
    }
}