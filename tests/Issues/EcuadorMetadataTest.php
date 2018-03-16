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

    function testParseNewEcuadorNumbers()
    {
        $testNumbers = array(
            "593962600575" => "+593962600575",
            "+593962600575" => "+593962600575",
            "962600575" => "+593962600575",
            "0962600575" => "+593962600575",
        );

        foreach($testNumbers as $rawNumber => $e164) {
            $normalizedNumber = $this->whenParseRawNumber($rawNumber);
            $this->thenNormalizedNumberIsValidWithExpectedE164($normalizedNumber, $e164);
        }
    }

    /**
     * @param $rawNumber
     * @return \libphonenumber\PhoneNumber
     */
    private function whenParseRawNumber($rawNumber)
    {
        return $this->phoneNumberUtil->parse($rawNumber, "EC");
    }

    /**
     * @param $normalizedNumber
     * @param $e164
     */
    private function thenNormalizedNumberIsValidWithExpectedE164($normalizedNumber, $e164)
    {
        $this->assertEquals($e164, $this->phoneNumberUtil->format($normalizedNumber, PhoneNumberFormat::E164));
        $this->assertEquals(true, $this->phoneNumberUtil->isValidNumber($normalizedNumber));
    }
}
