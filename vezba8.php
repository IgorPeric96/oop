<?php 

abstract class Status {
  abstract public function insertCardAndPin();
  abstract public function inputAmountAndConfirm();
  abstract public function demandCheck();
}

class Ready extends Status {
  public function insertCardAndPin() {
    return true;
  }
  public function inputAmountAndConfirm() {
    return false;
  }
  public function demandCheck() {
    return false;
  }
}

class Validated extends Status {
  public function insertCardAndPin(){
    return false;
  }
  public function inputAmountAndConfirm(){
    return true;
  }
  public function demandCheck(){
    return false;
  }
}
class Paid extends Status {
  public function insertCardAndPin(){
    return false;
  }
  public function inputAmountAndConfirm(){
    return false;
  }
  public function demandCheck(){
    return true;
  }
}

class ATM {
  private Status $state;

  public function __construct()
  {
    $this->state = new Ready();
  }

  public function insertCardAndPin($card, $pin){
    if($this->state->insertCardAndPin($card, $pin)) {
      $this->state = new Validated();
    }
   
  }

  public function inputAmountAndConfirm($amount){
    if($this->state->inputAmountAndConfirm($amount)){
      $this->state = new Paid();
    }
  }

  public function demandCheck(bool $demandCheck){
    if($this->state->demandCheck($demandCheck)){
      echo "Here is your check";
    }

  }
}


