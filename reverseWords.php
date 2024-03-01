<?php


/**
 * Функция разделяющая слово на буквы
 * потому что PHP не умеет в крилицу
 *
 * @var string $input
 * @return array
 */
function cyr_split($input)
{
    preg_match_all('/./us', $input, $chars);
    return $chars[0];
}


/**
 * Функция определяющая является ли буква заглавной
 * потому что PHP не умеет в крилицу
 *
 * @var string $cha
 * @return boolean
 */
function isUpper($cha)
{
    if (mb_strlen($cha) !== 1) {
        throw new Exception('Wrong input, it should be only one character.');
    }
    return preg_match('/^\p{Lu}$/u', $cha);
}

/**
 * Функция  принимает строку на вход, разделяет на слова по пробелам и занкам препинания
 * инвертируя последовтельность букв в слове но сохраняя расположение заглавной буквы
 *
 * @var string $input
 * @return string $result
 */
function reverseWords($input)
{
    /**
     * Регэкс разделяющий строку на слова и знаки препинания
     * '\b\w+\b' - целое слово
     * '|' - или
     * [^\w] - знаки препинания и пробелы (не-слова)
     */
    preg_match_all('/\b\w+\b|[^\w]/u', $input, $matches);
    $words = $matches[0];
    $result = '';

    

    // "Пословный" перебор
    foreach ($words as $word) {
        $slen = mb_strlen($word);
        // Оптимизация
        if ($slen == 1) {
            $result .= $word;
            continue;
        }

        // Запоминает позиции заглавных букв
        $capitalization = [];
        $sub_word = cyr_split($word);
        for ($i = 0; $i < $slen; $i++) {
            $ch = isUpper($sub_word[$i]);
            if ($ch == 1) {
                $capitalization[] = $i;
            }
        }


        // Собственно поворот слова
        $reversedWordArr = array_reverse(cyr_split(mb_strtolower($word)));

        // Сделать буквы заглавными
        foreach ($capitalization as $pos) {
            $reversedWordArr[$pos] = mb_strtoupper($reversedWordArr[$pos], "utf-8");
        }

        //Присоединение слова к результату
        $result .= join('', $reversedWordArr);
    }

    return $result;
}
