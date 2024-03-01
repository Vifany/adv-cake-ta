<?php

require 'reverseWords.php';


$testCases = [
    [
        'input' => "Hi! My name is Vifany.",
        'expectedOutput' => "Ih! Ym eman si Ynafiv.",
        'description' => "Базовый тест провален"
    ],
    [
        'input' => "",
        'expectedOutput' => "",
        'description' => "Тест пустой строки провален"
    ],
    [
        'input' => "Hello",
        'expectedOutput' => "Olleh",
        'description' => "Тест одиночного слова провален"
    ],
    [
        'input' => "Hello!",
        'expectedOutput' => "Olleh!",
        'description' => "Тест пунктуации провален"
    ],
    [
        'input' => "Hello World!",
        'expectedOutput' => "Olleh Dlrow!",
        'description' => "Тест смешанного регистра провален"
    ],
    [
        'input' => "Hello  World",
        'expectedOutput' => "Olleh  Dlrow",
        'description' => "Тест множества пробелов провален"
    ],
    [
        'input' => "12345 !@#",
        'expectedOutput' => "54321 !@#",
        'description' => "Тест цифр и спец-символов провален"
    ],
    [
        'input' => "This\tis\na\nTest.",
        'expectedOutput' => "Siht\tsi\na\nTset.",
        'description' => "Тест переноса строк и табуляций провален"
    ],
    [
        'input' => "Test!NoSpaces",
        'expectedOutput' => "Tset!SeCapson",
        'description' => "Тест пунктуации без пробелов провален"
    ],
    [
        'input' => "mIdlle of wOrd",
        'expectedOutput' => "eLldim fo dRow",
        'description' => "Тест неравномерного регистра провален"
    ],
    [
        'input' => "КирилиЦа",
        'expectedOutput' => "АцилирИк",
        'description' => "Кирилический тест провален"
    ],
    [
        'input' => "Word!? Yes!",
        'expectedOutput' => "Drow!? Sey!",
        'description' => "Тест множественной пунктуации провален"
    ],

];


foreach ($testCases as $testCase) {
    $input = $testCase['input'];
    $expectedOutput = $testCase['expectedOutput'];
    $description = $testCase['description'];

    $actualOutput = reverseWords($input);
    assert(
        $actualOutput === $expectedOutput,
        "$description - Input: $input, Expected: $expectedOutput, Actual: $actualOutput"
    );
}

echo "Тесты пройдены успешно\n";
