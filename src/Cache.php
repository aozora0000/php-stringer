<?php

namespace Stringer;

trait Cache
{
    public static array $cache = [];

    public function when(Stringer $stringable, array $arguments, callable $callback): mixed
    {
        $key = $this->key($stringable, $arguments);
        if ($this->exists($key)) {
            return $this->get($key);
        }
        $this->set($key, $callback());
        return $this->set($key, $callback());
    }

    public function key(Stringer $stringable, ...$arguments): string
    {
        return hash('sha256', serialize([$stringable, $arguments]));
    }

    public function exists(string $key): bool
    {
        return isset(self::$cache[$key]);
    }

    public function set(string $key, mixed $value): mixed
    {
        return self::$cache[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return self::$cache[$key];
    }
}