<?php

require 'components/input.php';
require 'components/label.php';

?>

<div class="grid w-full grid-cols-2 gap-2 pt-6">

  <div class="flex items-center justify-center col-span-2">
    <form action="" method="post" class="flex flex-col border rounded border-stone-700">
      <h1 class="mb-4 text-2xl font-bold text-center border-b text-stone-400 dark:text-stone-200 border-stone-700 dark:border-stone-800">
        Login
      </h1>

      <div class="flex flex-col gap-2 p-4">
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
      </div>
    </form>
  </div>

  <div></div>

</div>