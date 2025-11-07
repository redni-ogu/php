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
    // Полная дата + полное время для ru_RU и текущего часового пояса
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
    // День рождения в текущем году
    $currentYear = (int) $now->format('Y');
    $next = $birthdayДата->setDate($currentYear, (int)$birthdayДата->format('m'), (int)$birthdayДата->format('d'));

    if ($next < $now) {
        $next = $next->modify('+1 year');
    }

    return $now->diff($next);
}

// ЗАДАНИЕ 1
$nowTs = time();                                  // текущая метка времени [web:209][web:208]
$birthdayTs = strtotime('1995-09-01');            // пример: заменить на вашу дату рождения [web:206][web:214]

$hour = getdate($nowTs)['hours'];                 // текущий час 0..23 [web:219][web:223]

// ЗАДАНИЕ 2
$welcome = getWelcomeByHour($hour);
echo "<p>{$welcome}</p>";

// Локаль ru_RU.UTF-8 (для форматтера ICU локаль указываем при создании)
setlocale(LC_ALL, 'ru_RU.UTF-8');                 // может требовать установленную локаль в системе [web:217][web:213]

// Форматированная дата/время: "Сегодня 1 сентября 2018 года, суббота 09:30:00"
$fmt = buildRuFormatter();                         // FULL дата и FULL время [web:216]
$formatted = datefmt_format($fmt, $nowTs);         // [web:216]
echo "<p>Сегодня {$formatted}</p>";

// До дня рождения осталось ...
$now = new DateTimeImmutable('now');               // текущий момент
$birthdayDate = (new DateTimeImmutable('@' . $birthdayTs))->setTimezone($now->getTimezone()); // выравниваем TZ

$diff = diffToNextBirthday($birthdayDate, $now);   // [web:222]
$days = $diff->days;                               // общее число дней
$hours = $diff->h;
$minutes = $diff->i;
$seconds = $diff->s;

echo "<p>До моего дня рождения осталось {$days} дн., {$hours} ч., {$minutes} мин., {$seconds} сек.</p>";
