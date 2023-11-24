<?php 

 class Email {
  protected string $emailAdress;
  protected string $theme;
  protected string $content;

  public function __construct(string $emailAdress, string $theme, string $content)
  {
    $this->emailAdress = $emailAdress;
    $this->theme = $theme;
    $this->content = $content;
  }

  public function getAddress(): string {
    return $this->emailAdress;
  }
  public function getTheme(): string {
    return $this->theme;
  }
  public function getContent(): string {
    return $this->content;
  }
  
}

class MailService {
  private static $instance;
  private $count;

  private function __construct(){
    $this->count = 0;
  }

  static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new MailService();
    }
return self::$instance;
  }

  public function incrementCount() {
    $this->count++;
  }

  public function getCount() {
    return $this->count;
  }
  public function sendEmail(Email $email) {
   echo 'Sending email to' . $email->getAddress();
  }

}

class EmailFactory {
  public function makeEmail(string $emailAdress, string $theme, string $content) {
    return new Email( $emailAdress,  $theme,  $content);
  }
}

$emailFactory = new EmailFactory();
$email = $emailFactory->makeEmail('asdasd', 'asdasd', 'asdasd');


MailService::getInstance()->sendEmail($email);