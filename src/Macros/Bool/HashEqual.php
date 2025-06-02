<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class HashEqual implements StringerCallable
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
    public function __invoke(Stringable $stringable, ...$arguments): bool
    {
        $hasher = self::param($arguments, 0, 'sha1');
        $target_value = self::param($arguments, 1, '');
        $arguments = array_slice($arguments, 2);
        if(!defined('PASSWORD_ARGON2I') && $hasher === 'argon2i') {
            throw new \Exception('Argon2i is not supported');
        }

        if(!defined('PASSWORD_ARGON2ID') && $hasher === 'argon2i') {
            throw new \Exception('Argon2id is not supported');
        }

        $target = new Stringer($target_value);
        // パスワードハッシュアルゴリズムの場合はpassword_verifyを使う
        if(is_string($hasher) && in_array(strtolower($hasher), array_keys(self::$password_hashers))) {
            return password_verify($target->toString(), $stringable->toString());
        }

        return $target->hash($hasher, ...$arguments)->is($stringable);
    }
}