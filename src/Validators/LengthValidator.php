<?php

namespace AndreDeBrito\PHPViaCep\Validators;

/**
 * Class LengthValidator [Validator]
 *
 * @author André de Brito <https://github.com/andredebrito>
 * @package AndredeBrito\PHPViaCep\Validators
 */
class LengthValidator {

    public static function equals($value, int $length): bool {
        if (mb_strlen(str_replace(" ", "",($value))) == $length) {
            return true;
        }

        return false;
    }

    public static function aboveOrEqual($value, int $minimum): bool {
        if (mb_strlen(str_replace(" ", "", ($value))) >= $minimum) {
            return true;
        }

        return false;
    }
 

}
