<?php 

  require('validator.php');

  $errors = [];

  class User {
    public $name;
    public $surname;
    public $email;
    public $password;
    public $phonenumber;
    function __construct($data) {
      $this->name = $data['name']; 
      $this->surname = $data['surname']; 
      $this->email = $data['email']; 
      $this->password = $data['password1']; 
      $this->phonenumber = $data['phonenumber']; 
    }
    function showData() {
      echo " imie: " .  $this->name; echo nl2br("\n"); echo " nazwisko: " .  $this->surname; echo nl2br("\n");   echo " email: " .  $this->email; echo nl2br("\n"); echo " haslo: " .  $this->password; echo nl2br("\n");  echo " numer telefonu: " .  $this->phonenumber; echo nl2br("\n");   
    }
  }

  if(isset($_POST['submit'])){
    $validation = new Validator($_POST);
    $errors = $validation->validateForm();
    if (empty($errors)) {
      $arg = $validation->getData();
      $user = new User($arg);
      echo "Wprowadzono poprawne dane, utworzono nowego użytkownika";
      echo nl2br("\n");
      $user->showData();
    }
  }

?>

<html lang="en">
<head>
  <title></title>
</head>
<body>
  <div class="user">
    <h2>Formularz</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

      <label>Imie: </label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['name'] ?? '' ?>
      </div>

      <label>Nazwisko: </label>
      <input type="text" name="surname" value="<?php echo htmlspecialchars($_POST['surname']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['surname'] ?? '' ?>
      </div>

      <label>Email: </label>
      <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['email'] ?? '' ?>
      </div>

      <label>Hasło: </label>
      <input type="text" name="password1" value="<?php echo htmlspecialchars($_POST['password1']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['password1'] ?? '' ?>
      </div>
      
      <label>Hasło: </label>
      <input type="text" name="password2" value="<?php echo htmlspecialchars($_POST['password2']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['password2'] ?? '' ?>
      </div>

      <label>Numer telefonu: </label>
      <input type="text" name="phonenumber" value="<?php echo htmlspecialchars($_POST['phonenumber']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['phonenumber'] ?? '' ?>
      </div>

      <input type="submit" value="submit" name="submit" >

    </form>
  </div>

</body>
</html>