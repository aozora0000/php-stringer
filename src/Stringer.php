<?php

namespace Stringer;

use Closure;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;
use Stringer\Macros\Array\Split;
use Stringer\Macros\Bool\EndsWith;
use Stringer\Macros\Bool\Is;
use Stringer\Macros\Bool\IsAccepted;
use Stringer\Macros\Bool\IsBoolean;
use Stringer\Macros\Bool\IsClass;
use Stringer\Macros\Bool\IsClassMethod;
use Stringer\Macros\Bool\IsContains;
use Stringer\Macros\Bool\IsContainsAll;
use Stringer\Macros\Bool\IsDatetime;
use Stringer\Macros\Bool\IsDirectory;
use Stringer\Macros\Bool\IsEmail;
use Stringer\Macros\Bool\IsEmpty;
use Stringer\Macros\Bool\IsEqual;
use Stringer\Macros\Bool\IsFile;
use Stringer\Macros\Bool\IsHTML;
use Stringer\Macros\Bool\IsInteger;
use Stringer\Macros\Bool\IsJson;
use Stringer\Macros\Bool\IsMatch;
use Stringer\Macros\Bool\IsNumeric;
use Stringer\Macros\Bool\IsRegexPattern;
use Stringer\Macros\Bool\IsUrl;
use Stringer\Macros\Bool\StartsWith;
use Stringer\Macros\Datetime\Datetime;
use Stringer\Macros\Datetime\Timestamp;
use Stringer\Macros\Format\ToBase64;
use Stringer\Macros\Format\ToBinary;
use Stringer\Macros\Format\ToDouble;
use Stringer\Macros\Format\ToHex;
use Stringer\Macros\Format\ToInteger;
use Stringer\Macros\Format\ToString;
use Stringer\Macros\Integer\Count;
use Stringer\Macros\Integer\Length;
use Stringer\Macros\Integer\Position;
use Stringer\Macros\Misc\Callback;
use Stringer\Macros\Misc\DD;
use Stringer\Macros\Misc\Dump;
use Stringer\Macros\Misc\Then;
use Stringer\Macros\Stringer\Basename;
use Stringer\Macros\Stringer\Camel;
use Stringer\Macros\Stringer\Concat;
use Stringer\Macros\Stringer\Escape;
use Stringer\Macros\Stringer\Finish;
use Stringer\Macros\Stringer\Hash;
use Stringer\Macros\Stringer\Kebab;
use Stringer\Macros\Stringer\Lcfirst;
use Stringer\Macros\Stringer\Limit;
use Stringer\Macros\Stringer\Lower;
use Stringer\Macros\Stringer\Ltrim;
use Stringer\Macros\Stringer\Mask;
use Stringer\Macros\Stringer\Offset;
use Stringer\Macros\Stringer\Plural;
use Stringer\Macros\Stringer\PluralStudly;
use Stringer\Macros\Stringer\Postfix;
use Stringer\Macros\Stringer\Prefix;
use Stringer\Macros\Stringer\Random;
use Stringer\Macros\Stringer\Remove;
use Stringer\Macros\Stringer\Repeat;
use Stringer\Macros\Stringer\Replace;
use Stringer\Macros\Stringer\ReplaceArray;
use Stringer\Macros\Stringer\Reverse;
use Stringer\Macros\Stringer\Rtrim;
use Stringer\Macros\Stringer\Singular;
use Stringer\Macros\Stringer\Slugify;
use Stringer\Macros\Stringer\Snake;
use Stringer\Macros\Stringer\Sprintf;
use Stringer\Macros\Stringer\Squish;
use Stringer\Macros\Stringer\Studly;
use Stringer\Macros\Stringer\Substr;
use Stringer\Macros\Stringer\Take;
use Stringer\Macros\Stringer\Title;
use Stringer\Macros\Stringer\Trim;
use Stringer\Macros\Stringer\Ucfirst;
use Stringer\Macros\Stringer\UcWords;
use Stringer\Macros\Stringer\Unwrap;
use Stringer\Macros\Stringer\Upper;
use Stringer\Macros\Stringer\WordWrap;
use Stringer\Macros\Stringer\Wrap;

/**
 * @method Stringer|void dd()
 * @method Stringer dump()
 * @method Stringer then(callable $then, callable $callback)
 * @method Stringer callback(callable $callback)
 *
 * @method integer length(integer $offset = 0)
 * @method integer count(string $argument)
 * @method integer position(string $needle, integer $offset = 0)
 *
 * @method Stringer datetime(string $format, string $timezone = date_default_timezone_get())
 * @method Stringer timestamp(string $timezone = date_default_timezone_get())
 *
 * @method string toString()
 * @method integer toInteger()
 * @method float toDouble()
 * @method string toBinary()
 * @method string toHex()
 * @method string toBase64()
 *
 * @method Stringer sprintf(string $format, string ...$arguments)
 * @method Stringer replace(string | array $search = '', string | array $needle = '')
 * @method Stringer replaceArray(array $search = '', array $needle = [])
 * @method Stringer offset(int $offset = 0, int $length = -1)
 * @method Stringer wrap(string $prefix = '', string $postfix = '')
 * @method Stringer upper()
 * @method Stringer lower()
 * @method Stringer substr(int $start = 0, int $length = null)
 * @method Stringer remove(string $word = '')
 * @method Stringer repeat(int $times = 1)
 * @method Stringer lcfirst()
 * @method Stringer ucfirst()
 * @method Stringer ucwords()
 * @method Stringer studly()
 * @method Stringer plural()
 * @method Stringer singular()
 * @method Stringer pluralStudy()
 * @method Stringer slugify(string $separator = '-', string $language = 'en')
 * @method Stringer title()
 * @method Stringer trim(string $charlist = null)
 * @method Stringer ltrim(string $charlist = null)
 * @method Stringer rtrim(string $charlist = null)
 * @method Stringer finish(string $cap = '')
 * @method Stringer snake(string $delimiter = '_')
 * @method Stringer kebab(string $delimiter = '-')
 * @method Stringer camel()
 * @method Stringer limit(int $limit, string $end = '...')
 * @method Stringer mask(string $charactor = '*', int $index = 0, string $length = null)
 * @method Stringer concat(string ...$words)
 * @method Stringer reverse()
 * @method Stringer squish()
 * @method Stringer take(int $length = 0)
 * @method Stringer hash(string $algorithm = 'sha1', ...$arguments)
 * @method Stringer escape(string $type = 'html')
 * @method Stringer wordWrap(int $width = 75, string $break = "\n")
 * @method Stringer unwrap(string $prefix = '', string $postfix = '')
 * @method Stringer basename()
 * @method Stringer prefix(string $prefix = '')
 * @method Stringer postfix(string $postfix = '')
 * @method Stringer random(int $length = 10)
 *
 * @method boolean is(string | Stringer $argument = '')
 * @method boolean isEqual(string|Stringer $argument = '')
 * @method boolean isEmpty()
 * @method boolean isNumeric()
 * @method boolean isInteger()
 * @method boolean isBoolean()
 * @method boolean isAccepted(string ...$arguments)
 * @method boolean isContains(string ...$arguments)
 * @method boolean isContainsAll(string ...$arguments)
 * @method boolean isMatch(string $pattern = '')
 * @method boolean isRegexPattern()
 * @method boolean isJson()
 * @method boolean isHTML(string ...$tags)
 * @method boolean isUrl()
 * @method boolean isEmail()
 * @method boolean startsWith(string ...$arguments)
 * @method boolean endsWith(string ...$arguments)
 * @method boolean isDatetime()
 * @method boolean isClass()
 * @method boolean isClassMethod(string $sep = '::')
 * @method boolean isFile(string $root = '')
 * @method boolean isDirectory(string $root = '')
 *
 * @method Stringer[] split(string $delimiter = ',')
 */
class Stringer implements Stringable, JsonSerializable
{
    protected static array $macros = [
        'dd' => DD::class,
        'dump' => Dump::class,
        'then' => Then::class,
        'callback' => Callback::class,

        // Integer
        'length' => Length::class,
        'count' => Count::class,
        'position' => Position::class,

        // Datetime
        'datetime' => Datetime::class,
        'timestamp' => Timestamp::class,

        // Format
        'toString' => ToString::class,
        'toInteger' => ToInteger::class,
        'toDouble' => ToDouble::class,
        'toBinary' => ToBinary::class,
        'toHex' => ToHex::class,
        'toBase64' => ToBase64::class,

        // Stringer
        'sprintf' => Sprintf::class,
        'replace' => Replace::class,
        'replaceArray' => ReplaceArray::class,
        'wrap' => Wrap::class,
        'offset' => Offset::class,
        'upper' => Upper::class,
        'lower' => Lower::class,
        'substr' => Substr::class,
        'remove' => Remove::class,
        'repeat' => Repeat::class,
        'lcfirst' => Lcfirst::class,
        'ucfirst' => Ucfirst::class,
        'ucwords' => UcWords::class,
        'studly' => Studly::class,
        'plural' => Plural::class,
        'pluralStudy' => PluralStudly::class,
        'singular' => Singular::class,
        'slugify' => Slugify::class,
        'title' => Title::class,
        'trim' => Trim::class,
        'ltrim' => Ltrim::class,
        'rtrim' => Rtrim::class,
        'finish' => Finish::class,
        'snake' => Snake::class,
        'kebab' => Kebab::class,
        'camel' => Camel::class,
        'limit' => Limit::class,
        'mask' => Mask::class,
        'concat' => Concat::class,
        'reverse' => Reverse::class,
        'squish' => Squish::class,
        'take' => Take::class,
        'hash' => Hash::class,
        'escape' => Escape::class,
        'unwrap' => Unwrap::class,
        'wordWrap' => WordWrap::class,
        'basename' => Basename::class,
        'prefix' => Prefix::class,
        'postfix' => Postfix::class,
        'random' => Random::class,

        // Boolean
        'is' => Is::class,
        'isEqual' => IsEqual::class,
        'isEmpty' => IsEmpty::class,
        'isNumeric' => IsNumeric::class,
        'isInteger' => IsInteger::class,
        'isBoolean' => IsBoolean::class,
        'isAccepted' => IsAccepted::class,
        'isContains' => IsContains::class,
        'isContainsAll' => IsContainsAll::class,
        'startsWith' => StartsWith::class,
        'endsWith' => EndsWith::class,
        'isMatch' => IsMatch::class,
        'isRegexPattern' => IsRegexPattern::class,
        'isJson' => IsJson::class,
        'isHTML' => IsHTML::class,
        'isUrl' => IsUrl::class,
        'isEmail' => IsEmail::class,
        'isDatetime' => IsDatetime::class,
        'isClass' => IsClass::class,
        'isClassMethod' => IsClassMethod::class,
        'isFile' => IsFile::class,
        'isDirectory' => IsDirectory::class,

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
    public static function sets(array $macros): void
    {
        foreach ($macros as $name => $macro) {
            self::set($name, $macro);
        }
    }

    public static function set(string $name, StringerCallable|Closure $macro): void
    {
        self::$macros[$name] = $macro;
    }

    public static function all(): array
    {
        return self::$macros;
    }

    public static function remove(string $name): void
    {
        unset(self::$macros[$name]);
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
            self::has($name) && is_a(self::$macros[$name], Closure::class) => 'closure',
            self::has($name) && is_subclass_of(self::$macros[$name], StringerCallable::class) => 'stringer-callable',
            self::has($name) => 'class-string',
            default => 'default',
        };
    }

    public static function has(string $name): bool
    {
        return array_key_exists($name, self::$macros);
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
        [$class, $method] = preg_split('/(@|::)/', self::$macros[$name]);
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