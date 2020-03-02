<?php


namespace execut\javascriptHandler;


use PHPUnit\Framework\TestCase;

class SkipCheckerTest extends TestCase
{
    public function testCheckSimple() {
        $checker = new SkipChecker([
            [
                'message' => 'Out of stack space',
            ],
        ]);
        $this->assertFalse($checker->check([
            'message' => '123'
        ]));

        $this->assertTrue($checker->check([
            'message' => 'Out of stack space'
        ]));
    }

    public function testCheckWithoutMessage() {

        $checker = new SkipChecker([
            [
                'errorUrl' => 'http://test',
            ],
        ]);
        $this->assertTrue($checker->check([
            'errorUrl' => 'http://test',
        ]));
    }
}