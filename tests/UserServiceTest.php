<?php
use PHPUnit\Framework\TestCase;
use App\Services\UserService;
use App\Models\User;
use App\Helpers\InputValidator;

class UserServiceTest extends TestCase {
    private UserService $userService;
    private $userMock;

    protected function setUp(): void {
        $this->userMock = $this->createMock(User::class);
        $this->userService = new UserService($this->userMock, new InputValidator());
    }

    public function testValidateAndCreateUserSuccess() {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password123',
            'confirm_password' => 'password123'
        ];

        $this->userMock->expects($this->once())
            ->method('create')
            ->willReturn(true);

        $result = $this->userService->createUser($data);
        $this->assertArrayHasKey('success', $result);
    }

    public function testValidateAndCreateUserInvalidEmail() {
        $data = [
            'email' => 'invalid-email',
            'password' => 'password123',
            'confirm_password' => 'password123'
        ];

        $result = $this->userService->createUser($data);
        $this->assertArrayHasKey('errors', $result);
        $this->assertArrayHasKey('email', $result['errors']);
    }

    public function testValidateAndCreateUserPasswordMismatch() {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password123',
            'confirm_password' => 'differentPassword'
        ];

        $result = $this->userService->createUser($data);
        $this->assertArrayHasKey('errors', $result);
        $this->assertArrayHasKey('password', $result['errors']);
    }
}
