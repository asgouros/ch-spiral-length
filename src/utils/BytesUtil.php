<?php

namespace csl\utils;

/**
 * Bytes manipulation Utility methods
 * @todo Move into generic MicroServices/Core module/package?
 */
class BytesUtil
{
    /**
     * Formats bytes into a human readable string.
     * Picks the most appropriate byte-unit and displays value and unit
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
