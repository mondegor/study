/**
 *
 * Исследование производительности последовательностей
 * на конктретной логике заложенной в функции itemPerformance().
 *
 * compile to javascript:
 *     npm install -g typescript
 *     tsc tbinary-seq.ts
 *
 * @author     Andrey J. N. <mondegor@gmail.com>
 */

// мера производительности
const PERFOMANCE_INCREASED = 2;
const PERFOMANCE_NORMAL    = 1;

let APP_RESULT = ''; // переменная для формирования результата работы программы

// ############################################################################

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
for (let ii = 3; ii < 9; ii++) {
    APP_RESULT += "length: " + ii + "\n";
    findBestChain(ii);
    APP_RESULT += "\n";
}

APP_RESULT += "\n";

// ############################################################################

// тесты основного алгоритма генерации последовательности с лучшей производительностью:
printBestSequence(18, 12); // test
printBestSequence(12, 18); // test
printBestSequence(10, 20); // max perfomance
printBestSequence(0, 30); // test
printBestSequence(30, 0); // test
printBestSequence(500, 1000); // best max perfomance
printBestSequence(1000, 1000); // max items
printBestSequence(0, 2); // error
printBestSequence(2, 0); // error
printBestSequence(1, 1); // error
printBestSequence(-1, 10); // error
printBestSequence(10, -1); // error

console.log(APP_RESULT);

// результаты работы тестов основного алгоритма:
// m =   18; n =   12; performance =   47 :: G G B G G B G G B G G B G G B G G B B B B B B B B B B B B B
// m =   12; n =   18; performance =   56 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B B B B
// m =   10; n =   20; performance =   60 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B
// m =    0; n =   30; performance =   30 :: G G G G G G G G G G G G G G G G G G G G G G G G G G G G G G
// m =   30; n =    0; performance =   30 :: B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B
// m =  500; n = 1000; performance = 3000 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B
// m = 1000; n = 1000; performance = 3499 :: G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B G G B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B B
// Error :: incorrect input data: m = 0; n = 2
// Error :: incorrect input data: m = 2; n = 0
// Error :: incorrect input data: m = 1; n = 1
// Error :: incorrect input data: m = -1; n = 10
// Error :: incorrect input data: m = 10; n = -1

// ############################################################################
// ############################################################################

/**
 * Алгоритм построения всех вариантов двоичной последовательности указанной длины (2^n).
 * Использовался для поиска максимально производительных последовательностей.
 *
 * @param {int} length
 * @param {string[]} items
 * @param {(string[]) => void} cb
 */
function genBinarySequences(length: number, items: string[], cb: (items: string[]) => void): void {
    if (length > 16) {
        return;
    }

    const cnt = Math.pow(2, length);

    for (let i = 0; i < cnt; i++) {
        items = [];

        for (let j = length - 1; j >= 0; j--) {
            items.push(i >> j & 1 ? 'G' : 'B');
        }

        cb(items);
    }
}

/**
 * Алгоритм поиска всех максимально производительных последовательностей.
 * На основе него был написан алгоритм genBestSequence.
 *
 * @param {int} length
 */
function findBestChain(length: number): void {
    let max = 0;
    let a = [];

    genBinarySequences(
        length,
        a,
        function(a: string[]) {
            const tmp = calcPerformance(a);

            if (tmp > max) {
                max = tmp;
            }
        }
    );

    // ################################################################################

    // второй прогон для вывода всех последовательностей
    // с максимальной производительностью
    genBinarySequences(
        length,
        a,
        function(a: string[]) {
            if (calcPerformance(a) === max) {
                APP_RESULT += "performance = " + max + " :: ";

                for (let i = 0; i < a.length; i++) {
                    APP_RESULT += a[i] + ' ';
                }

                APP_RESULT += "\n";
            }
        }
    );
}

// ############################################################################

/**
 * Стандартный рекурсивный алгоритм перестановок (n!).
 * Использовался для поиска максимально производительных последовательностей.
 *
 * :WARNING: не используется
 *
 * @param {int} l
 * @param {int} cnt
 * @param {string[]} items
 * @param {(string[]) => void} cb
 */
function genPermutations(l: number, cnt: number, items: string[], cb: (items: string[]) => void): void {
    if (cnt > 10) {
        return;
    }

    if (l === cnt) {
        cb(items);
    } else {
        for (let i = l; i < cnt; i++) {
            let v = items[l]; items[l] = items[i]; items[i] = v; // change neighbors
            genPermutations(l + 1, cnt, items, cb);
            v = items[l]; items[l] = items[i]; items[i] = v; // change neighbors
        }
    }
}

/**
 * Алгоритм поиска максимально производительной последовательности.
 * На основе него был написан эффективный алгоритм genBestSequence.
 *
 * :WARNING: не используется
 *
 * @param {int} m
 * @param {int} n
 */
function findBestChain2(m: number, n: number): void {
    let a = [];
    for (let i = 0; i < m; i++) a.push('B');
    for (let i = 0; i < n; i++) a.push('G');

    let result = [];
    let max = 0;

    const cnt = m + n;

    genPermutations(
        0,
        cnt,
        a,
        function(a) {
            const tmp = calcPerformance(a);

            if (tmp > max) {
                max = tmp;
                result = a;
            }
        }
    );

    // ############################################################################

    APP_RESULT += max + " :: ";

    for (let i = 0; i < cnt; i++) {
        APP_RESULT += result[i] + ' ';
    }

    APP_RESULT += "\n";
}

// ############################################################################
// ############################################################################

/**
 * Расчёт производительности указанной последовательности.
 *
 * @param  {string[]} items
 * @return {int}
 */
function calcPerformance(items: string[]): number {
    const cnt = items.length;

    if (cnt < 3) {
        return PERFOMANCE_NORMAL;
    }

    // ############################################################################

    let result = 0;

    // cnt >= 3
    for (let i = 0; i < cnt; i++) {
        // добавлена проверка граничных условий,
        // для эмуляции кругового расположения элементов
		const item = items[i];
        const left = (0 === i ? items[cnt - 1] : items[i - 1]);
        const right = (cnt - 1 === i ? items[0] : items[i + 1]);

        result += itemPerformance(item, left, right);
    }

    return result;
}

/**
 * Вычисляется производительность указанного
 * элемента item в его окружении.
 *
 * GGB = INCREASED; GBG = INCREASED; BGG = INCREASED;
 *
 * @param {string} item
 * @param {string} left
 * @param {string} right
 * @return int
 */
function itemPerformance(item: string, left: string, right: string): number {
    if ('B' === left) {
        return ('G' === item && 'G' === right ? PERFOMANCE_INCREASED : PERFOMANCE_NORMAL);
    } else { // if ('G' === left) {
        return ('B' === item && 'G' === right ||
                'G' === item && 'B' === right ? PERFOMANCE_INCREASED : PERFOMANCE_NORMAL);
    }

    // return PERFOMANCE_NORMAL;
}

// ############################################################################

/**
 * Алгоритм генерации максимально производительной
 * последовательности написанный на основе поставленной задачи.
 *
 * @param {int} m
 * @param {int} n
 * @return {string[]}
 */
function genBestSequence(m: number, n: number): string[] {
    // самая эффективная цепочка GGB
    // расчёт количества таких цепочек
    let chains = Math.floor(n / 2);

    if (chains > m) {
        chains = m;
        n -= 2 * m;
        m = 0;
    } else {
        n -= 2 * chains; // n=[0,1] на случай если n нечётно
        m -= chains;
    }

    // ############################################################################

    let items = [];

    // последовательное сцепление цепочек
    for (let i = 0; i < chains; i++) {
        items.push('G', 'G', 'B');
    }

    // добавление оставшихся n
    for (let i = 0; i < n; i++) {
        items.push('G');
    }

    // добавление оставшихся m
    for (let i = 0; i < m; i++) {
        items.push('B');
    }

    return items;
}

/**
 * Генерация максимально производительной
 * последовательности и её отображение.
 *
 * @param {int} m
 * @param {int} n
 */
function printBestSequence(m: number, n: number): void {
    if (m < 0 || m > 1000 || n < 0 || n > 1000 || m + n < 3) {
        APP_RESULT += "Error :: incorrect input data: m = " + m + "; n = " + n + "\n";
        return;
    }

    // ############################################################################

    const a = genBestSequence(m, n);
    const cnt = a.length;

    APP_RESULT += "m = " + m + "; " +
                  "n = " + n + "; " +
                  "performance = " + calcPerformance(a) + " :: ";

    for (let i = 0; i < cnt; i++) {
        APP_RESULT += a[i] + ' ';
    }

    APP_RESULT += "\n";
}