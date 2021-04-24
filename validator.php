<?php 

class Validator {

  private $data;
  private $errors = [];
  private static $fields = ['name', 'surname', 'email', 'password1', 'password1', 'phonenumber'];

  public function __construct($data){
    $this->data = $data;
  }
  public function getData(){
    return $this->data;
  }
  public function validateForm(){

    $this->validateName();
    $this->validateSurname();
    $this->validateEmail();
    $this->validatePassword1();
    $this->validatePassword2();
    $this->validatePhonenumber();
    return $this->errors;

  }

  private function validateName(){

    $val = trim($this->data['name']);

    if(empty($val)){
      $this->addError('name', 'Imie nie może być puste');
    } else {
      if(!preg_match("/^[\p{L} '-]+$/", $val)){
        $this->addError('name','Imie musi się składać z samych liter');
      }
    }

  }
  private function validateSurname(){

    $val = trim($this->data['surname']);

    if(empty($val)){
      $this->addError('surname', 'Nazwisko nie może być puste');
    } else {
      if(!preg_match("/^[\p{L} '-]+$/", $val)){
        $this->addError('surname','Nazwisko musi się składać z samych liter');
      }
    }

  }

  private function validateEmail(){

    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addError('email', 'Email nie może być pusty');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'Email musi być w odpowiednim formacie');
      }
    }

  }

  private function validatePassword1(){

    $val1 = trim($this->data['password1']);
    $val2 = trim($this->data['password2']);
    $numberOfDigits = preg_match_all( "/[0-9]/", $val1 );
    $stringLenght = strlen($val1);
    if(empty($val1)){
      $this->addError('password1', 'Hasło nie może być puste');
    } else {
      if($val1 != $val2) {
        $this->addError('password1','Hasła są różne');
      }
      if(($numberOfDigits < 2 )|| ($stringLenght < 10)) { 
        $this->addError('password1','Hasło musi spełniać wymagania: min. 10 znaków, min. 1 duża litera, min. 1 mała litera, min. 2 cyfry');
      }
      if((!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{9,99}$/', $val1))){
        $this->addError('password1','Hasło musi spełniać wymagania: min. 10 znaków, min. 1 duża litera, min. 1 mała litera, min. 2 cyfry');
      }
    }

  }

  private function validatePassword2(){

    $val1 = trim($this->data['password1']);
    $val2 = trim($this->data['password2']);
    $numberOfDigits = preg_match_all( "/[0-9]/", $val2 );
    $stringLenght = strlen($val2);
    if(empty($val2)){
      $this->addError('password2', 'Powtórz hasło');
    } else {
      if($val1 != $val2) {
        $this->addError('password2','Hasła są różne');
      }
      if(($numberOfDigits <2) || ($stringLenght < 10)) { 
        $this->addError('password2','Hasło musi spełniać wymagania: min. 10 znaków, min. 1 duża litera, min. 1 mała litera, min. 2 cyfry');
      }
      if((!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{9,99}$/', $val2))){
        $this->addError('password2','Hasło musi spełniać wymagania: min. 10 znaków, min. 1 duża litera, min. 1 mała litera, min. 2 cyfry');
      }
    }

  }

  private function validatePhonenumber(){

    $val = trim($this->data['phonenumber']);

    if(empty($val)){
      $this->addError('phonenumber', 'Numer telefonu nie może być pusty');
    } else {
      if(!preg_match('/^\\d{9}$/', $val)){
        $this->addError('phonenumber','Numer telefonu musi się składać z dziewięciu cyfr');
      }
    }

  }


  private function addError($key, $val){
    $this->errors[$key] = $val;
  }

}

?>