<?php

namespace libphonenumber\Tests\Issues;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class ErrorMetadataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var PhoneNumberUtil
     */
    public $phoneNumberUtil;

    public function setUp()
    {
        PhoneNumberUtil::resetInstance();
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    public function testParseEcuadorNumberWithNewAcceptedPrefix()
    {
        $number = $this->phoneNumberUtil->parse('593962600575', 'EC');

        $this->assertEquals("+593962600575", $this->phoneNumberUtil->format($number, PhoneNumberFormat::E164));
    }
}
