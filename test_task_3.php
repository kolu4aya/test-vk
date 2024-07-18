<?php

// Доработайте код из test_task_2.php так, чтобы он мог выполняться на сайте с возможностью выбора языка отображения
// Для простоты считаем, что имя животного может быть на любом языке, при этом порода собаки только на выбранном языке
// Пример псевдо-кода такого сайта:

require_once('./test_task_2.php');


class ConfigReader {
  public const LOCALE_RU = 'ru';
  public const LOCALE_EN = 'en';
}

class Controller {
  private $locale;
  private $breed;
  private $sound;
  private $say;

  public function __construct($locale) {
    $this->locale = $locale;
    $this->breed = json_decode(file_get_contents("breed.json"),true);
    $this->sound = json_decode(file_get_contents("sound.json"),true);
    $this->say = array("ru" => "говорит", "en" => "says");
  }

  public function index() {
    $rex = new Dog('Rex', 'Labrador');
    $murka = new Cat('Мурка');

    $this->showLine($rex);
    $this->showLine($murka);
  }

  public function showLine(Animal $animal) {
    if ($animal instanceof Dog) {
      $breed_animal = [...array_filter($this -> breed["Dog"], fn($item) => array_filter($item, fn($val) => 
          $val == $animal -> getBreed()
         )
    )][0];
    } elseif ($animal instanceof Cat) {
      $breed_animal = $this -> breed["Cat"];
    }
    $breed_animal = $breed_animal[$this->locale];
    $sound_animal = $this->sound[get_class($animal)][$this->locale];
    echo "$breed_animal " . $animal->getName() . " " . $this->say[$this->locale] ." $sound_animal\n";
  }
}

echo "\nВывод задачи 3\n";
$controller = new Controller(ConfigReader::LOCALE_RU);
$controller->index();
$controller_en = new Controller(ConfigReader::LOCALE_EN);
$controller_en->index();

// Ожидаемый результат работы программы
// Лабрадор Rex говорит Гав
// Кошка Мурка говорит Мяу
// Labrador Rex says Woof
// Cat Мурка says Meow
