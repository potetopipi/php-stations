<?php

namespace Src\Station02;

class Practice
{
    public function main(): void
    {
        $a = 1;
        $b = '1';

        if ($a === $b) {
            echo '等しい' . PHP_EOL;
        } else {
            echo '等しくない' . PHP_EOL;
        }
            }
        }

(new Practice())->main();
