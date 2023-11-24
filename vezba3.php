<?php 

interface Rentable {
  public function rent();
  public function returnRent();
}

abstract class Article {
  protected string $serialNumber;
  protected string $brand;
  protected string $model;
  protected float $price;
  protected int $numberAvailable;

  public function __construct(string $serialNumber, string $brand, string $model, float $price, int $numberAvailable)
  {
    $this->serialNumber = $serialNumber;
    $this->brand = $brand;
    $this->model = $model;
    $this->price = $price;
    $this->numberAvailable = $numberAvailable;
  }


  public function getInfo() {
    echo $this->serialNumber . ' ' . $this->brand . ' ' . $this->model . ' ' . $this->price . ' ' . $this->numberAvailable;
  }

  public function getPrice(): float {
   return $this->price;
  }

  public function setPrice($price): float {
    return $this->price = $price;
  }
}

class RAM extends Article {
  public string $capacity;
  public string $frequency;

  public function __construct(string $serialNumber, string $brand, string $model, float $price, int $numberAvailable, string $capacity, string $frequency)
  {
    parent::__construct($serialNumber, $brand, $model, $price, $numberAvailable);
    $this->capacity = $capacity;
    $this->frequency = $frequency;
  }
  public function rent(){
    $this->numberAvailable--;
  }
}

class CPU extends Article {
  public int $coreNumbers;
  public string $frequency;

  public function __construct(string $serialNumber, string $brand, string $model, float $price, int $numberAvailable, int $coreNumbers, string $frequency)
  {
    parent::__construct($serialNumber, $brand, $model, $price, $numberAvailable,$coreNumbers, $frequency);
    $this->coreNumbers = $coreNumbers;
    $this->frequency = $frequency;
  }
}

class HDD extends Article {
  public string $capacity;

  public function __construct(string $capacity)
  {
    $this->capacity = $capacity;
  }
}

class GPU extends Article {
  public string $frequency;
  
  public function __construct(string $frequency)
  {
    $this->frequency = $frequency;
  }
}

class PCStore implements Rentable {
  private array $articleList = [];
  private float $storeProfit = 0;

  public function addArticle(Article $article){
    $this->articleList[] = $article;
  }

  public function listAllItems() {
    foreach($this->articleList as $article){
      echo $article->getInfo();
    }
  }

  public function sellArticle($article) {
    if (in_array($article, $this->articleList) && $article->numberAvailable >= 1) {
      $article->numberAvailable -= 1;
      $this->storeProfit += $article->getPrice();
      echo 'Article sold: ' . $article->model . '. Left in stock: ' . $article->stanje . '<br>';
  } else {
      echo 'Out of stock <br>';
  }
  }

  public function rent() {
    if (in_array($article, $this->articleList) && $article->numberAvailable >= 1) {
      $article->numberAvailable -= 1;
      $this->storeProfit += $article->getPrice()*0.25;
      echo 'Article on rent: ' . $article->model . '. Left in stock: ' . $article->stanje . '<br>';
  } else {
      echo 'Out of stock <br>';
  }
  }
}

$store1 = new PCStore();

$graficka = new GPU("384", "A122", "NVIDIA", "RX580", 299.99, 15);
$procesor = new CPU(8, "255", "A812", "Ryzen", "2 2200G", 199.99, 6);
$noviRam = new RAM("8gb", "255", "B812", "Kingston", "3600", 99.99, 22);
$harddisk = new HDD("520gb", "C812", "SATA", "radnom", 119.99, 30);

$store1->addArticle($graficka);
$store1->addArticle($procesor);
$store1->addArticle($noviRam);
$store1->addArticle($harddisk);
