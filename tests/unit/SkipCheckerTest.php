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

    public function testCheckByErrorUrlWithoutMessage() {

        $checker = new SkipChecker([
            [
                'errorUrl' => 'http://test',
            ],
            [
                'message' => 'test2',
            ],
        ]);
        $this->assertTrue($checker->check([
            'message' => 'test3',
            'errorUrl' => 'http://test',
        ]));
        $this->assertFalse($checker->check([
            'errorUrl' => 'http://tes1',
            'message' => 'test1',
        ]));
        $this->assertTrue($checker->check([
            'errorUrl' => 'http://tes2',
            'message' => 'test2',
        ]));
    }

    public function testWrongKey() {
        $this->expectExceptionMessage('Wrong configuration parameter \'wrongKey\'');

        new SkipChecker([
            [
                'wrongKey' => 'test',
            ],
        ]);
    }

    public function testSkipByUserAgent() {
        $checker = new SkipChecker([
            [
                'userAgent' => 'googleweblight',
            ],
        ]);
        $this->assertTrue($checker->check([
            'userAgent' => 'Mozilla/5.0 (Linux; Android 4.2.1; en-us;
 Nexus 5 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko;
 googleweblight) Chrome/38.0.1025.166 Mobile Safari/535.19',
        ]));
        $this->assertFalse($checker->check([
            'userAgent' => 'Mozilla/5.0 (Linux; Android 4.2.1; en-us;
 Nexus 5 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko;
 ) Chrome/38.0.1025.166 Mobile Safari/535.19',
        ]));
    }
}