<?php

namespace AndreDeBrito\PHPViaCep;

use AndreDeBrito\PHPViaCep\ViaCepApi;
use AndreDeBrito\PHPViaCep\Validators\EmptyValidator;
use AndreDeBrito\PHPViaCep\Validators\LengthValidator;
use AndreDeBrito\PHPViaCep\Exceptions\InvalidCepException;
use AndreDeBrito\PHPViaCep\Exceptions\InvalidUfException;
use AndreDeBrito\PHPViaCep\Exceptions\InvalidCityException;
use AndreDeBrito\PHPViaCep\Exceptions\InvalidAddressException;

/**
 * Class PhpViaCep 
 *
 * @author André de Brito <https://github.com/andredebrito>
 * @package AndredeBrito\PHPViaCep
 */
class PhpViaCep extends ViaCepApi {

    /** @var string */
    private $cep;

    /** @var string */
    private $uf;

    /** @var string */
    private $city;

    /** @var sring */
    private $address;

    /**
     * PhpViaCep constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param string $cep
     * @return \AndreDeBrito\PHPViaCep\PhpViaCep|null
     */
    public function findByCep(string $cep): ?PhpViaCep {
        $this->cep = trim($cep);
        $this->validateCep();

        $this->setEndpoint("/{$this->cep}/");
        return $this;
    }

    /**
     * 
     * @param string $uf
     * @param string $city
     * @param string $address
     * @return \AndreDeBrito\PHPViaCep\PhpViaCep|null
     */
    public function findByAddress(string $uf, string $city, string $address): ?PhpViaCep {
        $this->uf = trim($uf);
        $this->city = trim($city);
        $this->address = trim($address);

        $this->validateUf();
        $this->validateCity();
        $this->validateAddress();

        $this->setEndpoint("/{$this->uf}/{$this->city}/{$this->address}/");
        return $this;
    }

    /**
     * 
     * @return void
     * @throws InvalidCepException
     */
    private function validateCep(): void {
        if (!EmptyValidator::isValid($this->cep)) {
            throw new InvalidCepException("Informe o CEP!");
        }

        if (!is_numeric($this->cep)) {
            throw new InvalidCepException("O CEP só deve ser somente números!");
        }

        if (!LengthValidator::equals($this->cep, 8)) {
            throw new InvalidCepException("O CEP deve ter 8 digitos");
        }
    }

    /**
     * 
     * @return void
     * @throws InvalidUfException
     */
    private function validateUf(): void {
        if (!EmptyValidator::isValid($this->uf)) {
            throw new InvalidUfException("Informe o UF!");
        }

        if (!LengthValidator::equals($this->uf, 2)) {
            throw new InvalidUfException("O UF deve ter somente 2 caracteres");
        }
    }

    /**
     * 
     * @return void
     * @throws InvalidCityException
     */
    private function validateCity(): void {
        if (!EmptyValidator::isValid($this->city)) {
            throw new InvalidCityException("Informe a cidade!");
        }

        if (!LengthValidator::aboveOrEqual($this->city, 3)) {
            throw new InvalidCityException("A cidade deve ter no mínimo 3 caracteres!");
        }
    }

    /**
     * 
     * @throws InvalidAddressException
     */
    private function validateAddress() {
        if (!EmptyValidator::isValid($this->address)) {
            throw new InvalidAddressException("Informe o logradouro!");
        }

        if (!LengthValidator::aboveOrEqual($this->address, 3)) {
            throw new InvalidAddressException("O logradouro deve ter no mínimo 3 caracteres!");
        }
    }

}
