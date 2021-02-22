<?php

namespace csl\utils;


use csl\exceptions\ConstraintViolationException;

/**
 * File handling operations Service
 */
class FileHandler
{
    /**
     * Generators-based file read operation
     * @see https://www.php.net/manual/en/language.generators.overview.php
     *
     * @param $file
     * @return \Generator
     */
    public function getLinesOfFile($file)
    {
        $handle = fopen($file, 'rb');
        if (false === $handle) {
            throw new ConstraintViolationException(sprintf(
                'File %s doesn\'t exist', $file
            ));
        }

        try {
            while ($line = fgets($handle)) {
                yield $line;
            }
        } finally {
            fclose($handle);
        }
    }

    /**
     * @param $file
     * @param $string
     */
    public function appendStringToFile($file, $string)
    {
        file_put_contents($file, $string, FILE_APPEND);
    }

    /**
     * @param $file
     */
    public function unlink($file)
    {
        @unlink($file);
    }
}