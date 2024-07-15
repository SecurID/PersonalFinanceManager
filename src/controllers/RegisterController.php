<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;
use App\Services\UserService;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class RegisterController {
    private Environment $twig;
    private UserService $userService;

    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
        $this->userService = new UserService();
    }

    public function showForm(): void
    {
        echo $this->twig->render('register.twig', ['errors' => [], 'data' => []]);
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!$this->userService->validateUser($_POST)) {
                echo $this->twig->render('register.twig', ['errors' => $this->userService->errors, 'data' => $_POST]);
                return;
            }

            if(!$this->userService->createUser($_POST)) {
                echo $this->twig->render('register.twig', ['errors' => $this->userService->errors, 'data' => $_POST]);
            } else {
                echo $this->twig->render('register.twig', ['success' => 'Registration successful.']);
            }
        }
    }
}
