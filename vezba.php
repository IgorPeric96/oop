<?php 

class User {
  private string $name;
  private string $email;
  private string $password;
  public static $counter = 0;


  public function __construct(string $name, string $email, string $password)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    self::$counter++;
  }
  public function getPassword(): string {
    return $this->password;
  }
    public function setPassword(string $password): void {
      $this->password = $password;
    }
    public function getName(): string {
      return $this->name;
    }
    public function setName(string $name): void {
      $this->name = $name;
    }
    public function getEmail(): string {
      return $this->email;
    }
    public function setEmail(string $email): void {
      $this->email = $email;
    }
  
  }
  $prviUser = new User("Petar Petrovic", "petrovic@gmail.com","password123");
  $drugiUser = new User("Milan Milankovic", "milanovic@gmail.com", "novipass");
  $treciUser = new User("Dejan Dejanovic", "dejanovic@gmail.com", "nekipass123");

  echo User::$counter;

