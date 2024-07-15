<?php
namespace App\Services;

use App\Models\User;
use App\Helpers\InputValidator;

class UserService {
    private User $userModel;
    private InputValidator $validator;
    public array $errors = [];

    public function __construct() {
        $this->userModel = new User();
        $this->validator = new InputValidator();
    }

    public function validateUser(array $data): bool {
        if (!$this->validator->validateEmail($data['email'])) {
            $this->errors['email'] = "Invalid email.";
        }
        if (!$this->validator->validatePassword($data['password'], $data['confirm_password'])) {
            $this->errors['password'] = "Passwords do not match or are invalid.";
        }

        if (!empty($errors)) {
            return false;
        }
        return true;
    }

    public function createUser(array $data): bool {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->userModel->create($data);
    }
}