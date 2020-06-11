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

    /** @var string */
    protected $responseType;

    /** @var sring */
    protected $error;

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
        return $this->response = $this->checkNullResponse();         
    }

    /**
     * 
     * @return string
     */
    public function getError(): ?string {
        return $this->error;
    }

    /**
     * Set API return type to JSON
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function json(): ?ViaCepApi {
        $this->endpoint .= "json/";
        $this->responseType = "json";
        return $this;
    }

    /**
     * Set API return type do JSON Unicode
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function jsonUnicode(): ?ViaCepApi {
        $this->endpoint .= "json/unicode/";
        $this->responseType = "json";
        return $this;
    }

    /**
     * Set API return type to XML
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function xml(): ?ViaCepApi {
        $this->endpoint .= "xml/";
        $this->responseType = "xml";
        return $this;
    }

    /**
     * Set API return type to PIPED
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function piped(): ?ViaCepApi {
        $this->endpoint .= "piped/";
        $this->responseType = "pided";
        return $this;
    }

    /**
     * Set API return type to QUERTY
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function querty(): ?ViaCepApi {
        $this->endpoint .= "querty/";
        $this->responseType = "querty";
        return $this;
    }

    /**
     * <b>API JSON return only</b>
     * Set JSON response to Object
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function jsonToObject(): ?ViaCepApi {
      if ($this->responseType == "json" && $this->response != "[]") {
            $this->responseType = "object";
            $this->response = (object) json_decode($this->response);
        }
       
       return $this;       
    }

    /**
     * Fetch the request
     * 
     * @return \AndreDeBrito\PHPViaCep\ViaCepApi|null
     */
    public function fetch(): ?ViaCepApi {
        if (!$this->error) {
            $this->request("GET", $this->endpoint);
            return $this;
        }

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

    private function checkNullResponse() {
        switch ($this->responseType) {

            case "object":
                return (!empty($this->response->erro) ? null : $this->response);

            case "json":
                return ($this->response && in_array("erro", json_decode($this->response)) || ($this->response == "[]") ? null : $this->response);

            case "xml":
                return (!empty(simplexml_load_string($this->response)->erro) || empty(simplexml_load_string($this->response)->enderecos) ? null : $this->response);

            case "pided":
                return ($this->response == "erro:true" ? null : $this->response);

            case "querty":
                return ($this->response == "erro=true" ? null : $this->response);
        }
    }

}
