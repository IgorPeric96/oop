<?php 

interface Vehicle {
  public function inspect();
}

class Car implements Vehicle {
  public function inspect(){
    echo "Car inspection finished";
  }
}

class Bike implements Vehicle {
  public function inspect() {
    echo "Bike inspection finished";
  }
}

interface VehicleFactory {
  public function makeVehicle(): Vehicle;
}

class CarFactory implements VehicleFactory {
  public function makeVehicle(): Vehicle {
    return new Car();
  }
}
class BikeFactory implements VehicleFactory {
  public function makeVehicle(): Vehicle {
    return new Bike();
  }
}

class InspectionService {
  private static $instance;
  private $count;

  private function __construct(){
    $this->count = 0;
  }

  static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new InspectionService();
    }
return self::$instance;
  }

  public function incrementCount() {
    $this->count++;
  }

  public function getCount() {
    return $this->count;
  }
  public function inspectVehicle($vehicle) {
   echo 'Number of inspected vehicles:' . $this->count;
  }
}

$volvo = new Car();
$volvo->inspect();
$volvo->inspect();


InspectionService::getInstance()->inspectVehicle($volvo);

