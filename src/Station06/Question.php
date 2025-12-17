<?php

namespace Src\Station06;

class Question
{
    public function main(): array
    {
        $array = ["red","blue","yellow"];
        array_splice($array,0,0,"white");
        print_r($array);
        array_splice($array,1,0,"black");
        print_r($array);
        array_pop($array);
        print_r($array);
        array_splice($array,3,0,"green");
        print_r($array);
        return $array;

    }
}
$question = new Question();
$question->main();