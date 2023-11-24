<?php 

class Student {
  protected string $firstName;
  protected string $lastName;
  protected string $index;

  public function __construct(string $firstName, string $lastName, string $index) 
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->index = $index;
  }

  public function getInfo() {
    echo $this->firstName . ' ' . $this->lastName . ' ' . $this->index ;
  }

  public function prijaviIspit() {

  }

}
class Subject {
  protected string $subjectName;
  protected string $professor;
}
class Grade {
  protected int $ocena;
  protected string $date;
  protected Student $student;
  protected Subject $subject;
}

class StudentFactory {
  public function createNewStudent(string $firstName, string $lastName, string $index) {
    $student =  new Student($firstName, $lastName, $index);
    StudentskaSluzba::getInstance()->dodajStudenta($student);
    return $student;
  }
}

class StudentskaSluzba {
  private static $instance;
  private $studenti = [];
  

  private function __construct(){
  }

  static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new StudentskaSluzba();
    }
return self::$instance;
  }

  public function dodajStudenta(Student $student) {
    $this->studenti[] = $student;
  }

  public function getStudenti() {
    return $this->studenti;
  }
}

interface Ispit {
  
}

class PismeniIspit implements Ispit{ 
 
}

class UsmeniIspit implements Ispit{ 
  
}

interface CreateIspit {
  public function createIspit(): Ispit;
}

class CreatePismeniIspit implements CreateIspit {
  public function createIspit(): Ispit {
    return new PismeniIspit;
  }
}
class CreateUsmeniIspit implements CreateIspit {
  public function createIspit(): Ispit {
    return new UsmeniIspit;
  }
}

$studentfactory = new StudentFactory();
$student1 = $studentfactory->createNewStudent("asd", "asd", "asd");
