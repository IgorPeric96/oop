<?php 
class BankAccount{
    protected float $balance = 0;
    protected  bool $blocked = false;

    protected float $maxMinus = -200;
    protected float $provision = 0;
  
    public function getBalance(): float{
        return $this->balance;
    }

    public function setBalance($balance): void {
        $this->balance ;
    }

    public function getBlocked(): bool {
        return $this->blocked;
    }

    public function setBlocked($blocked): void{
        $this->blocked ;
    }
    
  

    public function podigniNovac($amount) {
        if ($this->blocked) {
            echo "Račun je blokiran. Ne možete podići novac.";
        }  else {
            $this->balance -= $amount + (($amount/100)*$this->provision);
            echo "Podigli ste $amount. Trenutno stanje na računu: $this->balance.";
        }
        if($this->balance <= $this->maxMinus){
            $this->blocked = true;
            echo "Vaš račun je blokiran jer je stanje manje od $this->maxMinus ";
        }
    }

    public function uplatiNovac($amount) {
        $this->balance += $amount - (($amount/100)*$this->provision);
        echo "Uplatili ste $amount. Trenutno stanje na računu je $this->balance.";
        if ($this->balance >= 0) {
            $this->blocked = false;
            echo "";
        }
    }
    
}

class User{
    public string $firstName;
    public string $lastName;
    public string $racun;

    function __construct(string $firstName, string $lastName, string $racun)
    {
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->racun=$racun;
    }
    public function getFirstName(): string{
        return $this->firstName;
    }

    public function setfirstName($ime): void{
        $this->firstName ;
    }

    public function getLastName(): string{
        return $this->lastName;
    }

    public function setPrezime($prezime): void {
        $this->lastName;
    }

}

 

class SimpleBankAccount extends BankAccount{

}

class SecuredBankAccount extends BankAccount {
 protected float $maxMinus = -1000;
 protected float $provision = 2.5; 
}
    
$secure = new SecuredBankAccount();
$secure->uplatiNovac(100);
$secure->podigniNovac(50);
$secure->podigniNovac(1000);
$secure->podigniNovac(100);

