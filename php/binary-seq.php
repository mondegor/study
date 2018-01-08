<?php
/**
 * Исследование производительности последовательностей
 * на конктретной логике заложенной в функции itemPerformance().
 *
 * @author     Andrey J. N. <mondegor@gmail.com>
 */

// мера производительности
const PERFOMANCE_INCREASED = 2;
const PERFOMANCE_NORMAL    = 1;

##############################################################################

// анализ зависимости длин лучших последовательностей от их производительности:
// length: 3
// performance = 6 :: B G G
// performance = 6 :: G B G
// performance = 6 :: G G B

// length: 4
// performance = 7 :: B G G G
// performance = 7 :: G B G G
// performance = 7 :: G G B G
// performance = 7 :: G G G B

// length: 5
// performance = 9 :: B G B G G
// performance = 9 :: B G G B G
// performance = 9 :: G B G B G
// performance = 9 :: G B G G B
// performance = 9 :: G G B G B

// length: 6
// performance = 12 :: B G G B G G
// performance = 12 :: G B G G B G
// performance = 12 :: G G B G G B

// length: 7
// performance = 13 :: B G G B G G G
// performance = 13 :: B G G G B G G
// performance = 13 :: G B G G B G G
// performance = 13 :: G B G G G B G
// performance = 13 :: G G B G G B G
// performance = 13 :: G G B G G G B
// performance = 13 :: G G G B G G B

// length: 8
// performance = 15 :: B G B G G B G G
// performance = 15 :: B G G B G B G G
// performance = 15 :: B G G B G G B G
// performance = 15 :: G B G B G G B G
// performance = 15 :: G B G G B G B G
// performance = 15 :: G B G G B G G B
// performance = 15 :: G G B G B G G B
// performance = 15 :: G G B G G B G B
for ($i = 3; $i < 9; $i++) {
    print "length: " . $i . "\n";
    findBestChain($i);
    print "\n";
}

print "\n";

##############################################################################

// тесты основного алгоритма генерации последовательности с лучшей производительностью:
printBestSequence(18, 12); // test
printBestSequence(12, 18); // test
printBestSequence(10, 20); // max perfomance
printBestSequence(0, 30); // test
printBestSequence(30, 0); // test
printBestSequence(500, 1000); // best max perfomance
printBestSequence(1000, 1000); // max
printBestSequence(0, 2); // error
printBestSequence(2, 0); // error
printBestSequence(1, 1); // error
printBestSequence(-1, 10); // error
printBestSequence(10, -1); // error

// результаты работы тестов основного алгоритма:
// $m =   18; $n =   12; performance =   47 :: G G B G G B G G B G G B G G B G G B B B B B B B B B B B B B
// $m =   12; $n =   18; performance =   56 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B B B B
// $m =   10; $n =   20; performance =   60 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B
// $m =    0; $n =   30; performance =   30 :: G G G G G G G G G G G G G G G G G G G G G G G G G G G G G G
// $m =   30; $n =    0; performance =   30 :: B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B
// $m =  500; $n = 1000; performance = 3000 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B
// $m = 1000; $n = 1000; performance = 3499 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B
// Error :: incorrect input data: m = 0; n = 2
// Error :: incorrect input data: m = 2; n = 0
// Error :: incorrect input data: m = 1; n = 1
// Error :: incorrect input data: m = -1; n = 10
// Error :: incorrect input data: m = 10; n = -1

##############################################################################
##############################################################################

/**
 * Алгоритм построения всех вариантов двоичной последовательности указанной длины (2^n).
 * Использовался для поиска максимально производительных последовательностей.
 *
 * @param $length int
 * @param $items array
 * @param $cb(array &$items) Closure
 */
function genBinarySequences($length, array &$items, Closure $cb)
{
    if ($length > 16)
    {
        return;
    }

    $cnt = pow(2, $length);

    for ($i = 0; $i < $cnt; $i++)
    {
        $items = array();

        for ($j = $length - 1; $j >= 0; $j--)
        {
            $items[] = $i>>$j & 1 ? 'G' : 'B';
        }

        $cb($items);
    }
}

/**
 * Алгоритм поиска всех максимально производительных последовательностей.
 * На основе него был написан алгоритм genBestSequence.
 *
 * @param $length int
 */
function findBestChain($length)
{
    $max = 0;
    $a = array();

    genBinarySequences
    (
        $length,
        $a,
        function(&$a) use (&$max)
        {
            $tmp = calcPerformance($a);

            if ($tmp > $max)
            {
                $max = $tmp;
            }
        }
    );

    ##################################################################################

    // второй прогон, для вывода всех последовательностей
    // с максимальной производительностью
    genBinarySequences
    (
        $length,
        $a,
        function(&$a) use (&$max)
        {
            if (calcPerformance($a) == $max)
            {
                print 'performance = ' . $max . ' :: ';

                for ($i = 0; $i < count($a); $i++)
                {
                    print $a[$i] . ' ';
                }

                print "\n";
            }
        }
    );
}

##############################################################################

/**
 * Стандартный рекурсивный алгоритм перестановок (n!).
 * Использовался для поиска максимально производительных последовательностей.
 *
 * :WARNING: не используется
 *
 * @param $l int
 * @param $cnt int
 * @param $items array
 * @param $cb(array &$items) Closure
 */
function genPermutations($l, $cnt, array &$items, Closure $cb)
{
    if ($cnt > 10)
    {
        return;
    }

    if ($l == $cnt)
    {
        $cb($items);
    }
    else
    {
        for ($i = $l; $i < $cnt; $i++)
        {
            $v = $items[$l]; $items[$l] = $items[$i]; $items[$i] = $v; // change neighbors
            genPermutations($l + 1, $cnt, $items, $cb);
            $v = $items[$l]; $items[$l] = $items[$i]; $items[$i] = $v; // change neighbors
        }
    }
}

/**
 * Алгоритм поиска максимально производительной последовательности.
 * На основе него был написан эффективный алгоритм genBestSequence.
 *
 * :WARNING: не используется
 *
 * @param $m int
 * @param $n int
 */
function findBestChain2($m, $n)
{
    $a = array_merge(array_fill(0, $m, 'B'), array_fill($m, $n, 'G'));
    $result = array();
    $max = 0;

    $cnt = $m + $n;

    genPermutations
    (
        0,
        $cnt,
        $a,
        function(&$a) use (&$result, &$max)
        {
            $tmp = calcPerformance($a);

            if ($tmp > $max)
            {
                $max = $tmp;
                $result = $a;
            }
        }
    );

    ##############################################################################

    print $max . ' :: ';

    for ($i = 0; $i < $cnt; $i++)
    {
        print $result[$i] . ' ';
    }

    print "\n";
}

##############################################################################
##############################################################################

/**
 * Расчёт производительности указанной последовательности.
 *
 * @param $items array
 * @return int
 */
function calcPerformance(array &$items)
{
    $cnt = count($items);

    if ($cnt < 3)
    {
        return PERFOMANCE_NORMAL;
    }

    ##############################################################################

    $result = 0;

    // $cnt >= 3
    for ($i = 0; $i < $cnt; $i++)
    {
        // добавлена проверка граничных условий,
        // для эмуляции кругового расположения элементов
		$item = $items[$i];
        $left = (0 == $i ? $items[$cnt - 1] : $items[$i - 1]);
        $right = ($cnt - 1 == $i ? $items[0] : $items[$i + 1]);

        $result += itemPerformance($item, $left, $right);
    }

    return $result;
}

/**
 * Вычисляется производительность указанного
 * элемента $item в его окружении.
 *
 * GGB = INCREASED; GBG = INCREASED; BGG = INCREASED;
 *
 * @param $item string
 * @param $left string
 * @param $right string
 * @return int
 */
function itemPerformance($item, $left, $right)
{
    if ('B' == $left)
    {
        return ('G' == $item && 'G' == $right ? PERFOMANCE_INCREASED : PERFOMANCE_NORMAL);
    }
    else // if ('G' == $left)
    {
        return ('B' == $item && 'G' == $right ||
                'G' == $item && 'B' == $right ? PERFOMANCE_INCREASED : PERFOMANCE_NORMAL);
    }

    // return PERFOMANCE_NORMAL;
}

##############################################################################

/**
 * Алгоритм генерации максимально производительной
 * последовательности написанный на основе поставленной задачи.
 *
 * @param $m int
 * @param $n int
 * @return array
 */
function &genBestSequence($m, $n)
{
    // самая эффективная цепочка GGB
    // расчёт количества таких цепочек
    $chains = floor($n / 2);

    if ($chains > $m)
    {
        $chains = $m;
        $n -= 2 * $m;
        $m = 0;
    }
    else
    {
        $n -= 2 * $chains; // (0,1) на случай если $n нечётно
        $m -= $chains;
    }

    ##############################################################################

    $items = array();

    // последовательное сцепление цепочек
    for ($i = 0; $i < $chains; $i++)
    {
        $items[] = 'G';
        $items[] = 'G';
        $items[] = 'B';
    }

    // добавление оставшихся $n
    for ($i = 0; $i < $n; $i++)
    {
        $items[] = 'G';
    }

    // добавление оставшихся $m
    for ($i = 0; $i < $m; $i++)
    {
        $items[] = 'B';
    }

    return $items;
}

/**
 * Генерация максимально производительной
 * последовательности и её отображение.
 *
 * @param $m int
 * @param $n int
 */
function printBestSequence($m, $n)
{
    if ($m < 0 || $m > 1000 || $n < 0 || $n > 1000 || $m + $n < 3)
    {
        print "Error :: incorrect input data: m = $m; n = $n\n";
        return;
    }

    ##############################################################################

    $a = genBestSequence($m, $n);
    $cnt = count($a);

    print '$m = ' . str_pad($m, 4, ' ', STR_PAD_LEFT) . '; ' .
          '$n = ' . str_pad($n, 4, ' ', STR_PAD_LEFT) . '; ' .
          'performance = ' . str_pad(calcPerformance($a), 4, ' ', STR_PAD_LEFT) . ' :: ';

    for ($i = 0; $i < $cnt; $i++)
    {
        print $a[$i] . ' ';
    }

    print "\n";
}