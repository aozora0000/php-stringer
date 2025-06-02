<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class WordWrap implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $width = self::param($arguments, 0, 75);
        $break = self::param($arguments, 1, "\n");
        $cut = self::param($arguments, 2, false);
        // break words into tokens using white space as a delimiter
        $tokens = $stringable->split('!(\s)!Su');
        $length = 0;
        $t = '';
        $_previous = false;
        foreach ($tokens as $token) {
            $token_length = $token->length();
            $_tokens = $token_length > $width && $cut ? array($token) : $token->split('!(.{' . $width . '})!Su');

            foreach ($_tokens as $token) {
                $_space = (bool) $token->isMatch('!^\s$!Su');
                $token_length = $token->length();
                $length += $token_length;
                if ($length > $width) {
                    // remove space before inserted break
                    if ($_previous) {
                        $t = mb_substr($t, 0, -1, 'UTF-8');
                    }

                    if (!$_space) {
                        // add the break before the token
                        if ($t !== '' && $t !== '0') {
                            $t .= $break;
                        }

                        $length = $token_length;
                    }
                } elseif ($token->is("\n")) {
                    // hard break must reset counters
                    $length = 0;
                }

                $_previous = $_space;
                // add the token
                $t .= $token;
            }
        }

        return new Stringer($t);
    }
}