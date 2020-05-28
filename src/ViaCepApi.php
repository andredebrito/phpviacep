<?php

namespace AndreDeBrito\PHPViaCep;

/**
 * Class ViaCepApi 
 *
 * @author André de Brito <https://github.com/andredebrito>
 * @package AndredeBrito\PHPViaCep
 */
abstract class ViaCepApi {

    /** @var string */
    private $apiUrl;

    /** @var string */
    private $endpoint;

    /** @var string */
    private $method;

    /** @var mixed */
    protected $response;

    /**
     * ViaCepAPi constructor
     */
    public function __construct() {
        $this->apiUrl = "https://viacep.com.br/ws";
    }

    /**
     * Set endpoint
     * 
     * @param string $endpoint
     * @return void
     */
    public function setEndpoint(string $endpoint): void {
        $this->endpoint = $endpoint;
    }

    /**
     * Return response
     * 
     * @return mixed
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Set API return type to JSON
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function json(): ?ViaCepApi {
        $this->endpoint .= "json/";
        return $this;
    }

    /**
     * Set API return type do JSON Unicode
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function jsonUnicode(): ?ViaCepApi {
        $this->endpoint .= "json/unicode/";
        return $this;
    }

    /**
     * Set API return type to XML
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function xml(): ?ViaCepApi {
        $this->endpoint .= "xml/";
        return $this;
    }

    /**
     * Set API return type to PIPED
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function piped(): ?ViaCepApi {
        $this->endpoint .= "piped/";
        return $this;
    }

    /**
     * Set API return type to QUERTY
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function querty(): ?ViaCepApi {
        $this->endpoint .= "querty/";
        return $this;
    }

    /**
     * <b>API JSON return only</b>
     * Set JSON response to Object
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function jsonToObject(): ?ViaCepApi {
        $decodedObject = (object) json_decode($this->response);

        if (count((array) $decodedObject) > 0) {
            $this->response = $decodedObject;
        }
        return $this;
    }

    /**
     * Fetch the request
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function fetch(): ?ViaCepApi {
        $this->request("GET", $this->endpoint);
        return $this;
    }

    /**
     * Call the request
     * 
     * @param string $method
     * @param string $endpoint
     * @return void
     */
    protected function request(string $method, string $endpoint): void {
        $this->method = $method;
        $this->endpoint = $endpoint;

        $this->dispatch();
    }

    /**
     * Execute the request via CURL
     * @return void
     */
    private function dispatch(): void {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$this->apiUrl}/{$this->endpoint}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => "CURL_HTTP_VERSION_1_1",
            CURLOPT_CUSTOMREQUEST => $this->method
        ));

        $this->response = curl_exec($curl);
        curl_close($curl);
    }

}
