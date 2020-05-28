<?php

namespace AndreDeBrito\PHPViaCep\Validators;

/**
 * Class EmptyValidator [Validator]
 *
 * @author André de Brito <https://github.com/andredebrito>
 * @package AndredeBrito\PHPViaCep\Validators
 */
class EmptyValidator {

    public static function isValid($value): bool {
        if (empty($value)) {
            return false;
        }

        return true;
    }

}
