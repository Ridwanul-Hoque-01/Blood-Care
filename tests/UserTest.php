<?php
use PHPUnit\Framework\TestCase;
require_once 'C:/xampp/htdocs/Blood-Care/User.php';

class UserTest extends TestCase
{
    private $user;
    private $con;

    protected function setUp(): void
    {
        // Connect to database
        $this->con = new mysqli('localhost', 'root', '', 'blood_care');
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }

        $this->user = new User($this->con);

        // Insert a test user
        $this->con->query("INSERT INTO user (user_id, Password, Name) VALUES ('testuser', 'testpass', 'Test User')");
    }

    protected function tearDown(): void
    {
        // Delete test user after tests
        $this->con->query("DELETE FROM user WHERE user_id='testuser'");
        $this->con->close();
    }

    public function testAuthenticateRightIdRightPass()
    {
        $this->assertTrue(
            $this->user->authenticate('testuser', 'testpass'),
            "Authentication should succeed for correct ID and password"
        );
    }

    public function testAuthenticateWrongIdRightPass()
    {
        $this->assertFalse(
            $this->user->authenticate('wronguser', 'testpass'),
            "Authentication should fail for wrong ID and correct password"
        );
    }

    public function testAuthenticateRightIdWrongPass()
    {
        $this->assertFalse(
            $this->user->authenticate('testuser', 'wrongpass'),
            "Authentication should fail for correct ID and wrong password"
        );
    }

    public function testAuthenticateWrongIdWrongPass()
    {
        $this->assertFalse(
            $this->user->authenticate('wronguser', 'wrongpass'),
            "Authentication should fail for wrong ID and wrong password"
        );
    }
}
