<?php 


class User {
  protected string $id;
  protected string $name;
}

class Item {
  protected string $id;
  protected string $name;
  protected string $owner;
  protected float $price;

  public function __construct(string $id, string $name, string $owner, float $price)
  {
    $this->id = $id;
    $this->name = $name;
    $this->owner = $owner;
    $this->price = $price;
  }

  public function getPrice() {
    return $this->price;
  }
  public function setPrice(float $price) {
    return $this->price = $price;
  }
}

class UserFactory {
  public function createNewUser(string $id, string $name){
    $user = new User($id, $name);
    AuctionMarketplace::getInstance()->addUser($user);
    return $user;
  }
}

class ItemFactory {
  public function createItem(string $id, string $name, string $owner, string $price){
    $item = new Item($id, $name, $owner, $price);
    AuctionMarketplace::getInstance()->addItem($item);
  }
}

class UserItemRelation {
  public int $userID;
  public int $itemID;

  public function __construct(int $userID, int $itemID)
  {
   $this->userID = $userID;
   $this->itemID = $itemID;
  }
}
class Offer {
  public int $customerID;
  public int $itemID;
  public float $amount; 

  public function __construct(int $customerID, int $itemID, float $amount)
  {
    $this->customerID = $customerID;
    $this->itemID = $itemID;
    $this->amount = $amount;
  }
}

class AuctionMarketplace {
  private static $instance;

  private $userList = [];
  private $itemList = [];
  private $wishlist = [];
  private $offers = [];

  private function __construct(){}

  static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new AuctionMarketplace();
    }
return self::$instance;
  }
  public function addUser(User $user) {
    $this->userList[] = $user;
  }
  public function addItem(Item $item) {
    $this->itemList[] = $item;
  }

  public function addToWishlist($itemID, $userID) {
    $this->wishlist[] = new UserItemRelation($itemID, $userID);
  }
  public function removeFromWishlist($itemID, $userID){
    foreach($this->wishlist as $key => $value) {
      if($key == $itemID && $value == $userID) {
        unset($this->wishlist[$key]);
      }
    }
  }
  public function sendOffer($itemID, $customerID, $amount){
    $this->offers[] = new Offer($itemID, $customerID, $amount);
  }
  public function removeOffer($itemID, $customerID){
    foreach($this->offers as $key => $value) {
      if($key == $itemID && $value == $customerID){
        unset($this->offers[$key]);
      }
    }
  }
  public function sellItem($itemID, $customerID){
    
  }
  public function notifyCustomer($itemID, $customerID) {

  }
}
