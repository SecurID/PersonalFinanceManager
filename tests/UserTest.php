<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase {
    private $user;
    private $dbMock;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(PDO::class);
        $this->user = new User();
    }

    public function testCreateUserSuccess() {
        $data = [
            'email' => 'test@example.com',
            'password' => password_hash('password123', PASSWORD_BCRYPT)
        ];

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->dbMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        $result = $this->user->create($data);
        $this->assertTrue($result);
    }

    public function testCreateUserFailure() {
        $data = [
            'email' => 'test@example.com',
            'password' => password_hash('password123', PASSWORD_BCRYPT)
        ];

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        $this->dbMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        $result = $this->user->create($data);
        $this->assertFalse($result);
    }
}
