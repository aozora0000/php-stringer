<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Hash implements StringerCallable
{
    use Helper;

    public static array $password_hashers = [
        'bcrypt' => PASSWORD_BCRYPT,
        'argon2i' => 'argon2i',
        'argon2id' => 'argon2id',
    ];

    /**
     * @throws \Exception
     */
    public function __invoke(Stringable $stringable, ...$arguments): Stringer
    {
        $hasher = $arguments[0] ?? 'sha1';
        $arguments = array_slice($arguments, 1);
        if(!defined('PASSWORD_ARGON2I') && $hasher === 'argon2i') {
            throw new \Exception('Argon2i is not supported');
        }
        if(defined('PASSWORD_ARGON2ID') && $hasher === 'argon2i') {
            throw new \Exception('Argon2id is not supported');
        }

        // パスワードハッシュアルゴリズムの場合
        if(is_string($hasher) && in_array(strtolower($hasher), array_keys(self::$password_hashers))) {
            return new Stringer(password_hash($stringable->toString(), self::$password_hashers[$hasher], array_merge(...$arguments)));
        }
        // hash関数アルゴリズムの場合
        if(is_string($hasher) && in_array($hasher, hash_algos())) {
            return new Stringer(hash($hasher, $stringable->toString(),false));
        }
        // ユーザー関数の場合
        if(is_string($hasher) && function_exists($hasher)) {
            return new Stringer($hasher($stringable->toString(), ...$arguments));
        }
        // ユーザークラスメソッドの場合
        if(is_string($hasher) && self::is_class_method_string($hasher)) {
            return new Stringer(call_user_func_array($hasher, [$stringable->toString(), ...$arguments]));
        }
        // ClosureやStringableクラスの場合
        if(is_string($hasher) && self::is_class_string($hasher)) {
            return new Stringer($hasher($stringable->toString(), ...$arguments));
        }
        // callableな場合
        if(is_callable($hasher)) {
            return new Stringer($hasher($stringable->toString(), ...$arguments));
        }
        throw new InvalidArgumentException('Invalid hasher');
    }
}