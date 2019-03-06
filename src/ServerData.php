<?php
declare(strict_types=1);

namespace Emul\Server;

class ServerData
{
    /** @var array */
    protected $server = [];

    public function __construct(array $server)
    {
        $this->server = $server;
    }

    public function getPhpSelf(): ?string
    {
        return $this->getString('PHP_SELF');
    }

    public function getArguments(): array
    {
        return $this->getArray('argv');
    }

    public function getArgumentCount(): ?int
    {
        return $this->getInt('argc');
    }

    public function getGatewayInterface(): ?string
    {
        return $this->getString('GATEWAY_INTERFACE');
    }

    public function getServerAddress(): ?string
    {
        return $this->getString('SERVER_ADDR');
    }

    public function getServerName(): ?string
    {
        return $this->getString('SERVER_NAME');
    }

    public function getServerSoftware(): ?string
    {
        return $this->getString('SERVER_SOFTWARE');
    }

    public function getServerProtocol(): ?string
    {
        return $this->getString('SERVER_PROTOCOL');
    }

    public function getRequestMethod(): ?string
    {
        return $this->getString('REQUEST_METHOD');
    }

    public function getRequestTime(): ?int
    {
        return $this->getInt('REQUEST_TIME');
    }

    public function getRequestTimeMs(): ?float
    {
        return $this->getFloat('REQUEST_TIME_FLOAT');
    }

    public function getQueryString(): ?string
    {
        return $this->getString('QUERY_STRING');
    }

    public function getDocumentRoot(): ?string
    {
        return $this->getString('DOCUMENT_ROOT');
    }

    public function getHttpAcceptHeader(): ?string
    {
        return $this->getString('HTTP_ACCEPT');
    }

    public function getHttpAcceptCharsetHeader(): ?string
    {
        return $this->getString('HTTP_ACCEPT_CHARSET');
    }

    public function getHttpAcceptEncodingHeader(): ?string
    {
        return $this->getString('HTTP_ACCEPT_ENCODING');
    }

    public function getHttpAcceptLanguageHeader(): ?string
    {
        return $this->getString('HTTP_ACCEPT_LANGUAGE');
    }

    public function getHttpConnectionHeader(): ?string
    {
        return $this->getString('HTTP_CONNECTION');
    }

    public function getHttpHostHeader(): ?string
    {
        return $this->getString('HTTP_HOST');
    }

    public function getHttpRefererHeader(): ?string
    {
        return $this->getString('HTTP_REFERER');
    }

    public function getHttpUserAgentHeader(): ?string
    {
        return $this->getString('HTTP_USER_AGENT');
    }

    public function isHttps(): bool
    {
        return !empty($this->getString('HTTPS'));
    }

    public function getRemoteAddress(): ?string
    {
        return $this->getString('REMOTE_ADDR');
    }

    public function getRemoteHost(): ?string
    {
        return $this->getString('REMOTE_HOST');
    }

    public function getRemotePort(): ?string
    {
        return $this->getString('REMOTE_PORT');
    }

    public function getRemoteUser(): ?string
    {
        return $this->getString('REMOTE_USER');
    }

    public function getRedirectRemoteUser(): ?string
    {
        return $this->getString('REDIRECT_REMOTE_USER');
    }

    public function getScriptFilename(): ?string
    {
        return $this->getString('SCRIPT_FILENAME');
    }

    public function getServerAdmin(): ?string
    {
        return $this->getString('SERVER_ADMIN');
    }

    public function getServerPort(): ?string
    {
        return $this->getString('SERVER_PORT');
    }

    public function getServerSignature(): ?string
    {
        return $this->getString('SERVER_SIGNATURE');
    }

    public function getPathTranslated(): ?string
    {
        return $this->getString('PATH_TRANSLATED');
    }

    public function getScriptName(): ?string
    {
        return $this->getString('SCRIPT_NAME');
    }

    public function getRequestUri(): ?string
    {
        return $this->getString('REQUEST_URI');
    }

    public function getAuthenticationDigest(): ?string
    {
        return $this->getString('PHP_AUTH_DIGEST');
    }

    public function getAuthenticationUser(): ?string
    {
        return $this->getString('PHP_AUTH_USER');
    }

    public function getAuthenticationPassword(): ?string
    {
        return $this->getString('PHP_AUTH_PW');
    }

    public function getAuthenticationType(): ?string
    {
        return $this->getString('AUTH_TYPE');
    }

    public function getPathInfo(): ?string
    {
        return $this->getString('PATH_INFO');
    }

    public function getPathInfoOriginal(): ?string
    {
        return $this->getString('ORIG_PATH_INFO');
    }

    protected function getString(string $key): ?string
    {
        return isset($this->server[$key])
            ? (string)$this->server[$key]
            : null;
    }

    protected function getInt(string $key): ?int
    {
        return isset($this->server[$key])
            ? (int)$this->server[$key]
            : null;
    }

    protected function getFloat(string $key): ?float
    {
        return isset($this->server[$key])
            ? (float)$this->server[$key]
            : null;
    }

    protected function getArray(string $key): array
    {
        $result = isset($this->server[$key])
            ? $this->server[$key]
            : [];

        return is_array($result)
            ? $result
            : (array)$result;
    }
}
