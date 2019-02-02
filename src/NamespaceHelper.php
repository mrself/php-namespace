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

    public function toNamespace(): string
    {
        return implode('\\', $this->source);
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
     * @return $this
     */
    public function append($part)
    {
        $part = (array) $part;
        $this->source = array_merge($this->source, $part);
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