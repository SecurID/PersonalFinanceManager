<?php
use PHPUnit\Framework\TestCase;
use App\Helpers\InputValidator;

class InputValidatorTest extends TestCase {
    private InputValidator $validator;

    protected function setUp(): void {
        $this->validator = new InputValidator();
    }

    public function testValidateEmail() {
        $this->assertTrue($this->validator->validateEmail('test@example.com'));
        $this->assertFalse($this->validator->validateEmail('invalid-email'));
    }

    public function testValidatePassword() {
        $this->assertTrue($this->validator->validatePassword('password123', 'password123'));
        $this->assertFalse($this->validator->validatePassword('password123', 'differentPassword'));
        $this->assertFalse($this->validator->validatePassword('short', 'short'));
    }
}
