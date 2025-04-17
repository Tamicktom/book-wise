<?php

require 'components/input.php';
require 'components/label.php';
require 'components/button.php';

?>

<div class="grid w-full grid-cols-2 gap-2 pt-6">

  <div class="flex items-center justify-center col-span-2">
    <div class="flex flex-col border rounded border-stone-700">
      <h1 class="px-4 py-2 text-2xl font-bold text-center border-b text-stone-400 dark:text-stone-200 border-stone-700 dark:border-stone-800">
        Registrar
      </h1>

      <form action="" method="post" class="flex flex-col gap-2 p-4 space-y-2">
        <div>
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
          ?>
        </div>

        <div>
          <?php
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
        </div>

        <div>
          <?php
          $label = new Label();
          $label->for = "confirm-password-input";
          $label->text = "Confirmar Senha";
          echo $label->render();

          $confirm_password_input = new Input();
          $confirm_password_input->id = "confirm-password-input";
          $confirm_password_input->name = "confirm-password";
          $confirm_password_input->placeholder = "Confirmar Senha";
          $confirm_password_input->type = InputType::PASSWORD;
          $confirm_password_input->required = true;
          echo $confirm_password_input->render();
          ?>
        </div>

        <?php
        $button = new Button();
        $button->id = "register-button";
        $button->name = "login";
        $button->text = "Logar";
        $button->type = ButtonType::SUBMIT;
        echo $button->render();
        ?>
      </form>

      <div>
        <p class="px-4 py-2 text-sm font-bold text-center text-stone-400 dark:text-stone-200">
          Já tem uma conta? <a href="/login" class="text-lime-500 dark:text-lime-400">Faça login</a>
        </p>
      </div>
    </div>
  </div>

  <div></div>

</div>