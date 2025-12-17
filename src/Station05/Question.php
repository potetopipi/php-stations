<?php

namespace Src\Station05;

class Question
{
    public function main(): int
    {
        $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $sum = 0;

        foreach ($array as $value) {

            // 値が8以上なら中断
            if ($value >= 8) {
                break;
            }

            // 4で割った余りが2より大きい場合は加算しない
            if ($value % 4 > 2) {
                continue;
            }

            // 加算
            $sum += $value;
        }

        return $sum;
    }
}

$q = new Question();
echo $q->main() . PHP_EOL;