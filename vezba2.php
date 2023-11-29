<?php 

class BankAccount {
  protected float $money;
  protected bool $isBlocked = false;

  public function getMoney() { return $this->money; }
  public function setMoney(float $money) { return $this->money = $money; }

  public function isAccountBlocked() { return $this->isBlocked; }
  public function setBlocked(bool $blocked) { $this->isBlocked = $blocked; }

  public function deposit(float $money) {
    $this->money += $money;
    printf("\nDeposit success. Current balance: %f", $this->money);
    if($this->isAccountBlocked() && $this->money >= 0) {
      $this->setBlocked(false);
      echo("\nAccount is now unblocked!");
    }
  }
  public function withdraw(float $money) {
    if($this->isAccountBlocked()) {
      echo("\nBank acccount is blocked");
    } else {
      $this->money -= $money;
      printf("\nWithdraw success. Current balance: %f", $this->money);
    }
  }
}

class SimpleBankAccount extends BankAccount {
  public function withdraw(float $money) {
    parent::withdraw($money);
    if($this->money <= -200) {
      $this->setBlocked(true);
      echo("\nAccount is blocked because balance is too low!");
    }
  }
}

class SecuredBankAccount extends BankAccount {
  public function deposit(float $money) {
    parent::deposit($money);
    $this->money -= ($this->money / 100) * 2.5;
    printf("\n Secured balance after fee: %f", $this->money);
  }

  public function withdraw(float $money) {
    parent::withdraw($money);
    if($this->isAccountBlocked()) return;
    $this->money -= ($this->money / 100) * 2.5;
    printf("\n Secured balance after fee: %f", $this->money);

    if($this->money <= -1000) {
      $this->setBlocked(true);
      echo("\nAccount is blocked because balance is too low!");
    }
  }
}

class User {
  private string $firstName;
  private string $lastName;
  private SecuredBankAccount $securedAccount;
  private SimpleBankAccount $simpleAccount;

  public function __construct(string $firstName, string $lastName) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->securedAccount = new SecuredBankAccount();
    $this->simpleAccount = new SimpleBankAccount();
    $this->simpleAccount->setMoney(0);
    $this->securedAccount->setMoney(0);
  }

  public function getName() {
    return "{$this->firstName} {$this->lastName}";
  }

  public function simpleAccount() { return $this->simpleAccount; }
  public function securedAccount() { return $this->securedAccount; }

  public function getSecuredBalance() {
    printf("\nCurrent secured balance: %f", $this->securedAccount()->getMoney());
  }
  public function getSimpleBalance() {
    printf("\nCurrent simple balance: %f", $this->securedAccount()->getMoney());
  }
}

$myUser = new User('Pera', 'Peric');
var_dump($myUser->getName());
$myUser->getSimpleBalance();
$myUser->getSecuredBalance();

$myUser->securedAccount()->deposit(100);
$myUser->simpleAccount()->deposit(100);

$myUser->securedAccount()->withdraw(100);
$myUser->securedAccount()->withdraw(2000);
$myUser->securedAccount()->withdraw(1);

$myUser->securedAccount()->deposit(3000);


$myUser->simpleAccount()->withdraw(200);

?>