<?php

namespace AndreDeBrito\PHPViaCep\Test;

require '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use AndreDeBrito\PHPViaCep\Validators\EmptyValidator;

class EmptyValidatorTest extends TestCase {

    /**
     * @dataProvider valueProvider 
     */
    public function testIsValid($value, $expectedResult) {
        $isValid = EmptyValidator::isValid($value);
        
        $this->assertEquals($expectedResult, $isValid);
    }

    public function valueProvider() {
        return [
            "shouldBeValidWhenValueIsNotEmpty" => ['value' => 'foo', "expectedResult" => true],
            "shouldNotBeValidWhenValueIsEmpty" => ['value' => '', "expectedResult" => false]
        ];
    }

}
