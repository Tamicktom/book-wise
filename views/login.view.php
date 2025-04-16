<?php

require 'components/input.php';
require 'components/label.php';

?>

<div class="pt-6 grid grid-cols-2 gap-2">

  <div class="border border-stone-700 rounded p-4">
    <form action="" method="post" class="flex flex-col gap-2">
      <?php
      $label = new Label();
      $label->for = "email-input";
      $label->text = "Email";
      echo $label->render();

      $email_input = new Input();
      $email_input->id = "email-input";
      $email_input->name = "email";
      $email_input->placeholder = "Email";
      $email_input->type = InputType::EMAIL;
      $email_input->required = true;
      echo $email_input->render();

      $label = new Label();
      $label->for = "password-input";
      $label->text = "Senha";
      echo $label->render();

      $password_input = new Input();
      $password_input->id = "password-input";
      $password_input->name = "password";
      $password_input->placeholder = "Senha";
      $password_input->type = InputType::PASSWORD;
      $password_input->required = true;
      echo $password_input->render();

      ?>
    </form>
  </div>

  <div></div>

</div>