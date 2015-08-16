<?php

use My\App\Helpers\StrongAccessor;

class ProviderTestClass extends StrongAccessor
{
    protected $testField = null;
}

class StrongAccessorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException RuntimeException
     */
    public function testAccessNonExistsOption()
    {
        $test = new ProviderTestClass();
        $test->hi;
    }

    /**
     * @expectedException RuntimeException
     */
    public function testAccessNonSetupedOption()
    {
        $test = new ProviderTestClass();
        $test->testField;
    }

    public function testSafeAccess()
    {
        $test = new ProviderTestClass();
        $this->assertEquals(
            100,
            $test->getVar('testField', 'int', 100)
        );

        $test->testField = 200;
        $this->assertEquals(
            200,
            $test->getVar('testField', 'int', 50)
        );

        $this->assertEquals(
            200,
            $test->testField
        );
    }
}