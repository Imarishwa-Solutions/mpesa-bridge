<?php

namespace Imarishwa\MpesaBridge\Drivers\C2B;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Imarishwa\MpesaBridge\Drivers\BaseDriver;
use Imarishwa\MpesaBridge\Exceptions\InvalidMpesaApiCredentialsException;
use Imarishwa\MpesaBridge\Exceptions\MissingBaseApiDomainException;

class UrlRegistrar extends BaseDriver
{
    protected $shortCode;
    protected $validationUrl;
    protected $confirmationUrl;
    protected $responseType = 'Completed';

    public function using($shortCode)
    {
        if (is_null($shortCode) || !\is_numeric($shortCode)) {
            throw new \InvalidArgumentException('Short code should be numeric');
        }
        $this->shortCode = (int) $shortCode;

        return $this;
    }

    public function setValidationUrl($validationUrl)
    {
        //TODO: valiadate url
        if (is_null($validationUrl)) {
            throw new \InvalidArgumentException('Validation Url is required and should be a valid Url');
        }

        $this->validationUrl = $validationUrl;

        return $this;
    }

    public function setConfirmationUrl($confirmationUrl)
    {
        //TODO: valiadate url
        if (is_null($confirmationUrl)) {
            throw new \InvalidArgumentException('Confirmation Url is required and should be a valid Url');
        }

        $this->confirmationUrl = $confirmationUrl;

        return $this;
    }

    public function setResponseType($responseType = 'Completed')
    {
        if ($responseType === 'Completed' || $responseType === 'Cancelled') {
            $this->responseType = $responseType;

            return $this;
        }

        throw new \InvalidArgumentException('Invalid timeout argument. Use Completed or Cancelled');
    }

    public function paramsValid() : bool
    {
        if (is_null($this->shortCode) || is_null($this->validationUrl) || is_null($this->confirmationUrl) || is_null($this->responseType)) {
            return false;
        }

        return true;
    }

    public function register()
    {
        if (is_null($this->responseType)) {
            $this->setResponseType();
        }

        if (!$this->paramsValid()) {
            throw new \InvalidArgumentException('Invalid timeout argument. Use Completed or Cancelled');
        }

        try {
            $response = $this->buildRequest();

            return \json_decode($response->getBody(),true);
        } catch (RequestException $exception) {
            return $exception;
        }
    }

    private function buildRequest()
    {
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer '.$this->authenticate(),
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'ShortCode'       => $this->shortCode,
                'ResponseType'    => $this->responseType,
                'ConfirmationURL' => $this->confirmationUrl,
                'ValidationURL'   => $this->validationUrl,
            ],
        ]);



        try {
            $response = $client->send(new Request('POST', $this->getApiBaseUrl().MPESA_C2B_REGISTER_URL));
            dd(\json_decode($response->getBody(),true));

            return \json_decode($response->getBody(),true);
        } catch(\Exception $e) {
            dd(\json_decode($e->getResponse()->getBody()->getContents()));

            return \json_decode($e->getResponse()->getBody()->getContents());
        }

        return $response;
    }
}
