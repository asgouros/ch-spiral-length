<?php

namespace csl\utils;

/**
 * Helper trait may be used with any class that needs to provide read-only attributes
 * @todo Move into generic MicroServices/Core module/package?
 */
trait ReadonlyAttributesTrait
{
    /**
     * Is utilized for reading data from inaccessible properties.
     *
     * @param string $name Readonly property name
     * @return mixed Either null or requested property value
     */
    public function __get($name)
    {
        // Try explicitly defined `getter` first
        $getter = 'get' . ucfirst($name);
        if (method_exists($this, $getter)) {
            // Respond with value from `get<$name>` method
            return $this->$getter();
        }

        // Respond with property value
        return $this->$name ?? null;
    }

    /**
     * Important because __isset() is triggered by calling isset() or empty() on inaccessible properties.
     * @see https://www.php.net/manual/en/function.isset.php
     *
     * @param mixed $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->$name);
    }
}
