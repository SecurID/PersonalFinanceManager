<?php
namespace App\Helpers;

class InputValidator {
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePassword($password, $confirm_password): bool
    {
        return !empty($password) && strlen($password) >= 6 && $password === $confirm_password;
    }
}
