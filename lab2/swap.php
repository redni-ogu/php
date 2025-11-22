<?php declare(strict_types=1);

$swap = function (&$a, &$b): void { $t = $a; $a = $b; $b = $t; };

/**
 * @param array<int,int> $items
 * @param callable(int):int $cb
 * @return array<int,int>
 */
function map(array $items, callable $cb): array {
    $out = [];
    foreach ($items as $i => $v) { $out[$i] = $cb($v); }
    return $out;
}

// Демонстрация
$a = 5; $b = 8;
console_log(['a' => $a, 'b' => $b], 'до swap');
$swap($a, $b);

function console_log(mixed $data, string $label = 'PHP'): void {
    $json = json_encode(['label' => $label, 'data' => $data], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    echo "<script>console.log($json);</script>";
}

// Логи в консоль браузера

console_log(['a' => $a, 'b' => $b], 'swap result');