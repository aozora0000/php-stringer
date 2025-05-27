<?php

namespace Stringer;

use Closure;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;
use Stringer\Macros\Array\Split;
use Stringer\Macros\Bool\Is;
use Stringer\Macros\Bool\IsAccepted;
use Stringer\Macros\Bool\IsBoolean;
use Stringer\Macros\Bool\IsContains;
use Stringer\Macros\Bool\IsEmpty;
use Stringer\Macros\Bool\IsEqual;
use Stringer\Macros\Bool\IsNumeric;
use Stringer\Macros\Datetime\Datetime;
use Stringer\Macros\Datetime\Timestamp;
use Stringer\Macros\Format\ToBinary;
use Stringer\Macros\Format\ToDouble;
use Stringer\Macros\Format\ToInteger;
use Stringer\Macros\Format\ToString;
use Stringer\Macros\Integer\Count;
use Stringer\Macros\Integer\Length;
use Stringer\Macros\Misc\DD;
use Stringer\Macros\Misc\Dump;
use Stringer\Macros\Stringer\Finish;
use Stringer\Macros\Stringer\Kebab;
use Stringer\Macros\Stringer\Lcfirst;
use Stringer\Macros\Stringer\Limit;
use Stringer\Macros\Stringer\Lower;
use Stringer\Macros\Stringer\Ltrim;
use Stringer\Macros\Stringer\Mask;
use Stringer\Macros\Stringer\Offset;
use Stringer\Macros\Stringer\PregReplace;
use Stringer\Macros\Stringer\Replace;
use Stringer\Macros\Stringer\Rtrim;
use Stringer\Macros\Stringer\Snake;
use Stringer\Macros\Stringer\Sprintf;
use Stringer\Macros\Stringer\Studly;
use Stringer\Macros\Stringer\Substr;
use Stringer\Macros\Stringer\Trim;
use Stringer\Macros\Stringer\Ucfirst;
use Stringer\Macros\Stringer\UcWords;
use Stringer\Macros\Stringer\Upper;

/**
 * @method Stringer|void dd()
 * @method Stringer dump()
 *
 * @method integer length(integer $offset = 0)
 * @method integer count(string $argument)
 *
 * @method Stringer datetime(string $format)
 * @method Stringer timestamp()
 *
 * @method string toString()
 * @method integer toInteger()
 * @method float toDouble()
 * @method string ToBinary()
 * @method string ToHex()
 *
 * @method Stringer sprintf(string $format, string ...$arguments)
 * @method Stringer replace(string | array $search = '', string | array $needle = '')
 * @method Stringer offset(int $offset = 0, int $length = -1)
 * @method Stringer upper()
 * @method Stringer lower()
 * @method Stringer substr(int $start = 0, int $length = null)
 * @method Stringer lcfirst()
 * @method Stringer ucfirst()
 * @method Stringer ucwords()
 * @method Stringer studly()
 * @method Stringer trim(string $charlist = null)
 * @method Stringer ltrim(string $charlist = null)
 * @method Stringer rtrim(string $charlist = null)
 * @method Stringer finish(string $cap = '')
 * @method Stringer snake(string $delimiter = '_')
 * @method Stringer kebab(string $delimiter = '-')
 * @method Stringer pReplace(string $pattern, string $replacement, int $limit = -1, int $offset = 0)
 * @method Stringer limit(int $limit, string $end = '...')
 * @method Stringer mask(string $charactor = '*', int $index = 0, string $length = null)
 *
 * @method boolean is(string | Stringer $argument = '')
 * @method boolean isEqual(string|Stringer $argument = '')
 * @method boolean isEmpty()
 * @method boolean isNumeric()
 * @method boolean isInteger()
 * @method boolean isBoolean()
 * @method boolean isAccepted(string ...$arguments)
 * @method boolean isContains(string ...$arguments)
 *
 * @method Stringer[] split(string $delimiter = ',')
 */
class Stringer implements Stringable, JsonSerializable
{
    protected static array $macros = [
        'dd' => DD::class,
        'dump' => Dump::class,
        // Integer
        'length' => Length::class,
        'count' => Count::class,

        // Datetime
        'datetime' => Datetime::class,
        'timestamp' => Timestamp::class,

        // Format
        'toString' => ToString::class,
        'toInteger' => ToInteger::class,
        'toDouble' => ToDouble::class,
        'toBinary' => ToBinary::class,
        'toHex' => ToBinary::class,

        // Stringer
        'sprintf' => Sprintf::class,
        'replace' => Replace::class,
        'offset' => Offset::class,
        'upper' => Upper::class,
        'lower' => Lower::class,
        'substr' => Substr::class,
        'lcfirst' => Lcfirst::class,
        'ucfirst' => Ucfirst::class,
        'ucwords' => UcWords::class,
        'studly' => Studly::class,
        'trim' => Trim::class,
        'ltrim' => Ltrim::class,
        'rtrim' => Rtrim::class,
        'finish' => Finish::class,
        'snake' => Snake::class,
        'kebab' => Kebab::class,
        'pReplace' => PregReplace::class,
        'limit' => Limit::class,
        'mask' => Mask::class,

        // Boolean
        'is' => Is::class,
        'isEqual' => IsEqual::class,
        'isEmpty' => IsEmpty::class,
        'isNumeric' => IsNumeric::class,
        'isBoolean' => IsBoolean::class,
        'isAccepted' => IsAccepted::class,
        'isContains' => IsContains::class,

        // Array
        'split' => Split::class,
    ];

    protected string|Stringable $string;

    public function __construct(string|Stringable $string)
    {
        $this->string = preg_replace('/[\x{200B}-\x{200D}]/u', '', is_string($string) ? $string : $string->toString());
    }

    public static function create(string|Stringable $string): static
    {
        return new static(is_string($string) ? $string : $string->toString());
    }

    /**
     * @param array<string, class-string|StringerCallable|Closure> $macros
     */
    public static function macros(array $macros): void
    {
        foreach ($macros as $name => $macro) {
            self::macro($name, $macro);
        }
    }

    public static function macro(string $name, StringerCallable|Closure $macro): void
    {
        self::$macros[$name] = $macro;
    }

    /**
     * @throws ReflectionException
     */
    public function __call(string $name, array $arguments): Stringable|string|int|float|bool|array
    {
        return match ($this->getType($name)) {
            'class-method' => $this->string->$name(...$arguments),
            'closure' => self::$macros[$name]($this, ...$arguments),
            'stringer-callable' => $this->__callStringerClass($name)->__invoke($this, ...$arguments),
            'class-string' => $this->__callClassString($name, $arguments),
            default => $this->string,
        };
    }

    public function getType(string $name): string
    {
        return match (true) {
            method_exists($this->string, $name) => 'class-method',
            self::hasMacro($name, Closure::class) => 'closure',
            self::hasMacro($name, StringerCallable::class) => 'stringer-callable',
            self::hasMacro($name, 'class-string') => 'class-string',
            default => 'default',
        };
    }

    /**
     * @param string $name
     * @param string $instanceType
     * @return bool
     */
    public static function hasMacro(string $name, string $instanceType = 'class-string'): bool
    {
        return match (true) {
            !array_key_exists($name, self::$macros) => false,
            $instanceType === 'class-string' => self::isClassString($name),
            is_subclass_of(self::$macros[$name], $instanceType, true) => true,
            is_a(self::$macros[$name], $instanceType, true) => true,
            self::$macros[$name] instanceof $instanceType => true,
            default => false,
        };
    }

    public static function isClassString($name): bool
    {
        $class = self::$macros[$name];
        if (!is_string($class)) {
            return false;
        }

        if (!str_contains($class, '@')) {
            return false;
        }

        [$class, $method] = explode('@', $class);
        return class_exists($class) && method_exists($class, $method);
    }

    protected function __callStringerClass($name)
    {
        return is_string(self::$macros[$name]) ? new self::$macros[$name] : self::$macros[$name];
    }

    /**
     * @throws ReflectionException
     */
    protected function __callClassString($name, $arguments)
    {
        [$class, $method] = explode('@', self::$macros[$name]);
        $class = new ReflectionClass($class);
        if ($class->getMethod($method)->isStatic()) {
            return $class::$method($this, $arguments);
        }
        return $class->newInstance()->$method($this, $arguments);
    }

    public function __toString(): string
    {
        return (string)$this->string;
    }

    public function jsonSerialize(): mixed
    {
        return $this->string;
    }
}