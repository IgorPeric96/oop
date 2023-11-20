<?php 
class BankAccount{
    private float $balance = 0;
    private  bool $blocked = false;
  
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
            $this->balance -= $amount;
            echo "Podigli ste $amount. Trenutno stanje na računu je $this->balance.";
        }
        if($this->balance <= -200){
            $this->blocked = true;
            echo "Vaš račun je sada blokiran jer je stanje manje od -200.";
        }
    }

    public function uplatiNovac($amount) {
        $this->balance += $amount;
        echo "Uplatili ste $amount. Trenutno stanje na računu je $this->balance.";
        if ($this->balance >= 0) {
            $this->blocked = false;
            echo "Vaš račun je sada odblokiran jer je stanje na računu 0 ili veće.";
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

$objekat = new BankAccount();
$objekat->podigniNovac(2000);
$objekat->podigniNovac(2000);

$objekat->uplatiNovac(4000);
$objekat->podigniNovac(2000);
 





  

