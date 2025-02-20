<?php

/**
 * Part of Dear package.
 *
 * @package Dear
 * @version 1.0
 * @author Umair Mahmood
 * @license MIT
 * @copyright Copyright (c) 2019 Umair Mahmood
 *
 */

namespace Scout\Dear\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Scout\Dear\Api\Contracts\DeleteMethodAllowed;
use Scout\Dear\Api\Contracts\PostMethodAllowed;
use Scout\Dear\Api\Contracts\PutMethodAllowed;
use Scout\Dear\Config;
use Scout\Dear\Exception\BadRequestException;
use Scout\Dear\Exception\DearApiException;
use Scout\Dear\Exception\ForbiddenRequestException;
use Scout\Dear\Exception\InternalServerErrorException;
use Scout\Dear\Exception\MethodNotAllowedException;
use Scout\Dear\Exception\NotFoundException;
use Scout\Dear\Exception\ServiceUnavailableException;
use Scout\Dear\Helper;
use Scout\Dear\RESTApi;

abstract class BaseApi implements RESTApi
{
    /**
     * Default limit
     */
    const LIMIT = 100;
    /**
     * Default page
     */
    const PAGE = 1;

    /**
     * HTTP request content type
     */
    const CONTENT_TYPE = 'application/json';

    /**
     * @var Config
     */
    protected $config;

    /**
     * BaseApi constructor.
     * @param $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Provide endpoint's action name
     * @return string
     */
    abstract protected function getAction();

    /**
     * Represents the GUID column name
     * @var string
     */
    abstract protected function getGUID();

    /**
     * GUID column name for delete action
     * @return string
     */
    protected function deleteGUID()
    {
        return 'ID';
    }

    /**
     * Returns required headers
     * @return array
     */
    protected function getHeaders()
    {
        return [
            'Content-Type' => self::CONTENT_TYPE,
            'api-auth-accountid' => $this->config->getAccountId(),
            'api-auth-applicationkey' => $this->config->getApplicationKey()
        ];
    }

    /**
     * @return Client
     */
    protected function getClient()
    {
        $client = new Client([
            'base_uri' => $this->getBaseUrl()
        ]);

        return $client;
    }

    /**
     * @return string
     */
    final protected function getBaseUrl()
    {
        return 'https://inventory.dearsystems.com/ExternalApi/v2/';
    }

    final public function get($parameters = [])
    {
        return $this->execute('GET', Helper::prepareParameters($parameters));
    }

    final public function find($guid, $parameters = [])
    {
        $parameters[$this->getGUID()] = $guid;
        return $this->execute('GET', Helper::prepareParameters($parameters));
    }

    final public function create($parameters = [])
    {
        if (!$this instanceof PostMethodAllowed) {
            throw new MethodNotAllowedException('Method not allowed.');
        }

        return $this->execute('POST', $parameters);
    }

    final public function update($guid, $parameters = [])
    {
        if (!$this instanceof PutMethodAllowed) {
            throw new MethodNotAllowedException('Method not allowed.');
        }

        $parameters[$this->getGUID()] = $guid;
        return $this->execute('PUT', $parameters);
    }

    final public function delete($guid, $parameters = [])
    {
        if (!$this instanceof DeleteMethodAllowed) {
            throw new MethodNotAllowedException('Method not allowed.');
        }

        $parameters[$this->deleteGUID()] = $guid;
        return $this->execute('DELETE', Helper::prepareParameters($parameters));
    }

    /**
     * @param $httpMethod
     * @param array $parameters
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute($httpMethod, array $parameters)
    {
        try {
            $requestParams = [
                'headers' => $this->getHeaders()
            ];

            if ($httpMethod == 'POST' || $httpMethod == 'PUT') {
                $requestParams['body'] = json_encode($parameters);
            } else {
                $requestParams['query'] = $parameters;
            }

            $response = $this->getClient()->request($httpMethod, $this->getAction(), $requestParams);
            return \GuzzleHttp\json_decode((string)$response->getBody(), true);

        } catch (ClientException $clientException) {
            return $this->handleClientException($clientException);

        } catch (ServerException $serverException) {
            if ($serverException->getResponse()->getStatusCode() === 503) {
                // API limit exceeded
                sleep(5);

                return $this->execute($httpMethod, $parameters);
            }

            return $this->handleServerException($serverException);
        }
    }

    /**
     * @param ClientException $e
     */
    protected function handleClientException(ClientException $e)
    {
        $response = $e->getResponse();
        switch ($response->getStatusCode()) {
            case 400:
                $exceptionClass = BadRequestException::class;
                break;

            case 403:
                $exceptionClass = ForbiddenRequestException::class;
                break;

            case 404:
                $exceptionClass = NotFoundException::class;
                break;

            case 405:
                $exceptionClass = MethodNotAllowedException::class;
                break;

            default:
                $exceptionClass = DearApiException::class;
                break;
        }

        $exceptionInstance = new $exceptionClass($e->getMessage());
        $exceptionInstance->setStatusCode($response->getStatusCode());

        throw $exceptionInstance;
    }

    /**
     * @param ServerException $e
     */
    protected function handleServerException(ServerException $e)
    {
        $response = $e->getResponse();
        switch ($response->getStatusCode()) {


            case 500:
                $exceptionClass = InternalServerErrorException::class;
                break;

            case 503:
                $exceptionClass = ServiceUnavailableException::class;
                break;

            default:
                $exceptionClass = DearApiException::class;
                break;
        }

        $exceptionInstance = new $exceptionClass($e->getMessage());
        $exceptionInstance->setStatusCode($response->getStatusCode());

        throw $exceptionInstance;
    }
}