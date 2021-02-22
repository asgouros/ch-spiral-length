<?php

namespace cslTests\utils;

use PHPUnit\Framework\TestCase;
use csl\utils\BytesUtil;

/**
 * @coversDefaultClass \csl\utils\BytesUtil
 */
class BytesUtilTest extends TestCase
{
    /**
     * @covers ::formatBytes
     *
     * @dataProvider formatBytesDataProvider
     *
     * @param int $bytes
     * @param int $precision
     */
    public function testFormatBytes(int $bytes, int $precision, string $expectedString)
    {
        self::assertSame((new BytesUtil)->formatBytes($bytes, $precision), $expectedString);
    }

    public function formatBytesDataProvider(): array
    {
        return [
            [
                5,
                2,
                '5 Bytes'
            ],
            [
                5,
                3,
                '5 Bytes'
            ],
            [
                5,
                0,
                '5 Bytes'
            ],
            [
                55,
                2,
                '55 Bytes'
            ],
            [
                55,
                0,
                '55 Bytes'
            ],
            [
                555,
                2,
                '555 Bytes'
            ],
            [
                1234,
                2,
                '1.21 KB'
            ],
            [
                12345,
                2,
                '12.06 KB'
            ],
            [
                123456,
                2,
                '120.56 KB'
            ],
            [
                1234567,
                2,
                '1.18 MB'
            ],
            [
                12345678,
                2,
                '11.77 MB'
            ],
            [
                123456789,
                2,
                '117.74 MB'
            ],
            [
                1234567890,
                2,
                '1.15 GB'
            ],

        ];

    }
}