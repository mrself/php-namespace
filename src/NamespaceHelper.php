<?php declare(strict_types=1);

namespace Mrself\NamespaceHelper;

class NamespaceHelper
{
    /**
     * @var array
     */
    protected $source;

    public function __construct(array $source)
    {
        $this->source = $source;
    }

    public static function fromSource(array $source)
    {
        return new static($source);
    }

    public static function from(array $source)
    {
        return static::fromSource($source);
    }

    public static function fromDotted(string $source)
    {
        return static::fromSource(explode('.', $source));
    }

    public static function fromNamespace(string $namespace)
    {
        return static::fromSource(explode('\\', $namespace));
    }

    public function toDotted(): string
    {
        return implode('.', $this->source);
    }

    public function toDirectory(): string
    {
        return implode(DIRECTORY_SEPARATOR, $this->source);
    }

    public function toDashed(bool $toLower = true): string
    {
        $source = $this->source;
        if ($toLower) {
            $source = array_map('strtolower', $source);
        }
        return implode('-', $source);
    }

    public function toSlashed(bool $toLower = true): string
    {
        $source = $this->source;
        if ($toLower) {
            $source = array_map('strtolower', $source);
        }
        return implode('/', $source);
    }

    public function toNamespace(bool $ucfirst = true): string
    {
        $source = $this->source;
        if ($ucfirst) {
            $source = array_map('ucfirst', $source);
        }
        return implode('\\', $source);
    }

    public function toUnderscore(): string
    {
        $source = array_map('strtolower', $this->source);
        return implode('_', $source);
    }

    public function camelize()
    {
        $firstPart = array_shift($this->source);
        $source = array_map('ucfirst', $this->source);
        array_unshift($source, $firstPart);
        return implode('', $source);
    }

    public function get()
    {
        return $this->source;
    }

    /**
     * @param $part
     * @return $this
     */
    public function prepend($part)
    {
        $part = (array) $part;
        $this->source = array_merge($part, $this->source);
        return $this;
    }

    /**
     * @param $part
     * @param int|string $index
     * @return $this
     */
    public function append($part, $index = null)
    {
        if (null === $index) {
            $part = (array) $part;
            $this->source = array_merge($this->source, $part);
        } else {
            array_splice($this->source, $index, 0 , $part);
        }
        return $this;
    }

    public function clone()
    {
        return static::fromSource($this->source);
    }

    public function last()
    {
        return $this->source[count($this->source) - 1];
    }

    public function first()
    {
        return $this->source[0];
    }
}