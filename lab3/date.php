<?php declare(strict_types=1); ?>

<?php
/**
 * Возвращает приветствие по текущему часу.
 *
 * @param int $hour Час в диапазоне 0..23.
 * @return string Приветственная фраза.
 */
function getWelcomeByHour(int $hour): string
{
    if ($hour >= 0 && $hour < 6) {
        return 'Доброй ночи';
    } elseif ($hour >= 6 && $hour < 12) {
        return 'Доброе утро';
    } elseif ($hour >= 12 && $hour < 18) {
        return 'Добрый день';
    } elseif ($hour >= 18 && $hour <= 23) {
        return 'Добрый вечер';
    }
    return 'Доброй ночи';
}

/**
 * Строит объект IntlDateFormatter для русской локали.
 *
 * @return IntlDateFormatter Форматтер для полной даты и времени.
 */
function buildRuFormatter(): IntlDateFormatter
{
    return datefmt_create(
        'ru_RU',
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        date_default_timezone_get(),
        IntlDateFormatter::GREGORIAN
    );
}

/**
 * Вычисляет интервал до следующего дня рождения.
 *
 * @param DateTimeImmutable $birthdayДата День рождения (дата без учета времени).
 * @param DateTimeImmutable $now Текущий момент.
 * @return DateInterval Положительный интервал до следующего ДР.
 */
function diffToNextBirthday(DateTimeImmutable $birthdayДата, DateTimeImmutable $now): DateInterval
{
    // День рождения в этом году
    $currentYear = (int) $now->format('Y');
    $next = $birthdayДата->setDate($currentYear, (int)$birthdayДата->format('m'), (int)$birthdayДата->format('d'));

    if ($next < $now) {
        $next = $next->modify('+1 year');
    }

    return $now->diff($next);
}

// ЗАДАНИЕ 1
$nowTs = time();
$birthdayTs = strtotime('2004-12-30');
$hour = getdate($nowTs)['hours'];

// ЗАДАНИЕ 2
$welcome = getWelcomeByHour($hour);
echo "<p>{$welcome}</p>";

setlocale(LC_ALL, 'ru_RU.UTF-8');

// Форматированная дата/время
$fmt = buildRuFormatter();
$formatted = datefmt_format($fmt, $nowTs);
echo "<p>Сегодня {$formatted}</p>";

// До дня рождения осталось ...
$now = new DateTimeImmutable('now');
$birthdayDate = (new DateTimeImmutable('@' . $birthdayTs))->setTimezone($now->getTimezone());

$diff = diffToNextBirthday($birthdayDate, $now);
$days = $diff->days;
$hours = $diff->h;
$minutes = $diff->i;
$seconds = $diff->s;

echo "<p>До моего дня рождения осталось {$days} дн., {$hours} ч., {$minutes} мин., {$seconds} сек.</p>";
