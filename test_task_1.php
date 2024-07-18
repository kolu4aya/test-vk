<?php

// Исправьте ошибки в приведенном ниже коде. Ваш исправленный код должен корректно выполнять поставленные задачи

/**
* Вычисляет факториал
*/
function calculateFactorial(float $number): int {
  if ($number == 0) {
    return 1;
  } else {
    return $number * calculateFactorial($number - 1);
  }
}

/**
* Проверяет, является ли число простым
 */
function isPrime($num) {
  if ($num <= 1) {
    return false;
  }
  for ($i = 2; $i <= $num/2; $i++) {
      if ($num % $i == 0) {
        return false;
    }
  }
  return true;
}

echo "Введите число: ";
$number = readline();
echo 'Факториал $number is: ' . calculateFactorial($number) . "\n";

if (isPrime($number)) {
  echo "$number - это простое число.\n";
} else {
  echo "$number - это не простое число.\n";
}

?>
