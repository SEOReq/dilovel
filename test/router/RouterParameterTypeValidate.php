<?php


use App\Components\Router\Validators\ValidateRouter;
use PHPUnit\Framework\TestCase;

/**
 * Class RouterParameterTypeValidate
 */
class RouterParameterTypeValidate extends TestCase
{
    /**
     * @var ValidateRouter
     */
    private ValidateRouter $validator;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->validator = new ValidateRouter();
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     *
     */
    public function testIsInt()
    {
        $this->assertTrue($this->validator->validate(12, 'int'));
    }

    /**
     *
     */
    public function testIsString()
    {
        $this->assertTrue($this->validator->validate('hello', 'string'));
    }

    public function testIsDate()
    {
        $this->assertTrue($this->validator->validate('2012-12-12', 'date'));
    }
}
