<?php

namespace AndreDeBrito\PHPViaCep\Test;

require '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use AndreDeBrito\PHPViaCep\Validators\LengthValidator;

class LengthValidatorTest extends TestCase {

    /**
     * @dataProvider equalsValueProvider 
     */
    public function testEquals($value, $length, $expectedResult) {
        $isValid = LengthValidator::equals($value, $length);

        $this->assertEquals($expectedResult, $isValid);
    }

    /**
     * @dataProvider aboveOrEqualsValueProvider 
     */
    public function testAboveOrEquals($value, $length, $expectedResult) {
        $isValid = LengthValidator::aboveOrEqual($value, $length);

        $this->assertEquals($expectedResult, $isValid);
    }

    public function equalsValueProvider() {
        return [
            "shouldBeValidWhenValueIsEqualsToLength" => ['value' => 'foo', 'length' => 3, "expectedResult" => true],
            "shouldNotBeValidWhenValueIsNotEqualsToLength" => ['value' => 'fo', 'length' => 3, "expectedResult" => false]
        ];
    }

    public function aboveOrEqualsValueProvider() {
        return [
            "shouldBeValidWhenValueIsEqualsToMinimum" => ['value' => 'foo', 'length' => 3, "expectedResult" => true],
            "shouldBeValidWhenValueIsAboveMinimum" => ['value' => 'foo', 'length' => 2, "expectedResult" => true],
            "shouldNoBeValidWhenValueIsBelowMinimum" => ['value' => 'f', 'length' => 3, "expectedResult" => false]
        ];
    }

}
