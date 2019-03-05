<?php
declare(strict_types=1);

namespace Server\Test;


use PHPUnit\Framework\TestCase;
use Server\Server;

class ServerTest extends TestCase
{
    public function stringProvider()
    {
        return [
            'string' => ['testValue', 'testValue'],
            'int'    => [1,           '1'],
            'null'   => [null,        null],
        ];
    }

    public function arrayProvider()
    {
        return [
            'array' => [['testValue'], ['testValue']],
            'int'    => [1,           [1]],
            'null'   => [null,        []],
        ];
    }

    public function intProvider()
    {
        return [
            'string' => ['',   0],
            'int'    => [1,    1],
            'null'   => [null, null],
        ];
    }

    public function floatProvider()
    {
        return [
            'string' => ['',   0.0],
            'int'    => [1,    1.0],
            'float'  => [1.1,  1.1],
            'null'   => [null, null],
        ];
    }

    public function boolProvider()
    {
        return [
            'empty string' => ['',      false],
            'string'       => ['HTTPS', true],
            'int'          => [0,       false],
            'null'         => [null,    false],
        ];
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPhpSelf_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['PHP_SELF' => $value]);
        $result = $server->getPhpSelf();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider arrayProvider
     */
    public function testGetArguments_shouldAlwaysReturnArray($value, array $expectedResult)
    {
        $server = new Server(['argv' => $value]);
        $result = $server->getArguments();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider intProvider
     */
    public function testGetArgumentCount_shouldReturnIntOrNull($value, ?int $expectedResult)
    {
        $server = new Server(['argc' => $value]);
        $result = $server->getArgumentCount();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetGatewayInterface_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['GATEWAY_INTERFACE' => $value]);
        $result = $server->getGatewayInterface();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerAddress_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_ADDR' => $value]);
        $result = $server->getServerAddress();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerName_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_NAME' => $value]);
        $result = $server->getServerName();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerSoftware_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_SOFTWARE' => $value]);
        $result = $server->getServerSoftware();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerProtocol_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_PROTOCOL' => $value]);
        $result = $server->getServerProtocol();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRequestMethod_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REQUEST_METHOD' => $value]);
        $result = $server->getRequestMethod();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider intProvider
     */
    public function testGetRequestTime_shouldReturnIntOrNull($value, ?int $expectedResult)
    {
        $server = new Server(['REQUEST_TIME' => $value]);
        $result = $server->getRequestTime();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider floatProvider
     */
    public function testGetRequestTimeMs_shouldReturnFloatOrNull($value, ?float $expectedResult)
    {
        $server = new Server(['REQUEST_TIME_FLOAT' => $value]);
        $result = $server->getRequestTimeMs();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetQueryString_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['QUERY_STRING' => $value]);
        $result = $server->getQueryString();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetDocumentRoot_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['DOCUMENT_ROOT' => $value]);
        $result = $server->getDocumentRoot();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_ACCEPT' => $value]);
        $result = $server->getHttpAcceptHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptCharsetHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_ACCEPT_CHARSET' => $value]);
        $result = $server->getHttpAcceptCharsetHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptEncodingHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_ACCEPT_ENCODING' => $value]);
        $result = $server->getHttpAcceptEncodingHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptLanguageHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_ACCEPT_LANGUAGE' => $value]);
        $result = $server->getHttpAcceptLanguageHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpConnectionHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_CONNECTION' => $value]);
        $result = $server->getHttpConnectionHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpHostHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_HOST' => $value]);
        $result = $server->getHttpHostHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpRefererHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_REFERER' => $value]);
        $result = $server->getHttpRefererHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpUserAgentHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['HTTP_USER_AGENT' => $value]);
        $result = $server->getHttpUserAgentHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider boolProvider
     */
    public function testIsHttps_shouldReturnBool($value, bool $expectedResult)
    {
        $server = new Server(['HTTPS' => $value]);
        $result = $server->isHttps();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemoteAddress_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REMOTE_ADDR' => $value]);
        $result = $server->getRemoteAddress();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemoteHost_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REMOTE_HOST' => $value]);
        $result = $server->getRemoteHost();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemotePort_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REMOTE_PORT' => $value]);
        $result = $server->getRemotePort();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemoteUser_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REMOTE_USER' => $value]);
        $result = $server->getRemoteUser();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRedirectRemoteUser_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REDIRECT_REMOTE_USER' => $value]);
        $result = $server->getRedirectRemoteUser();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetScriptFilename_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SCRIPT_FILENAME' => $value]);
        $result = $server->getScriptFilename();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerAdmin_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_ADMIN' => $value]);
        $result = $server->getServerAdmin();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerPort_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_PORT' => $value]);
        $result = $server->getServerPort();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerSignature_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SERVER_SIGNATURE' => $value]);
        $result = $server->getServerSignature();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPathTranslated_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['PATH_TRANSLATED' => $value]);
        $result = $server->getPathTranslated();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetScriptName_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['SCRIPT_NAME' => $value]);
        $result = $server->getScriptName();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRequestUri_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['REQUEST_URI' => $value]);
        $result = $server->getRequestUri();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationDigest_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['PHP_AUTH_DIGEST' => $value]);
        $result = $server->getAuthenticationDigest();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationUser_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['PHP_AUTH_USER' => $value]);
        $result = $server->getAuthenticationUser();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationPassword_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['PHP_AUTH_PW' => $value]);
        $result = $server->getAuthenticationPassword();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationType_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['AUTH_TYPE' => $value]);
        $result = $server->getAuthenticationType();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPathInfo_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['PATH_INFO' => $value]);
        $result = $server->getPathInfo();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPathInfoOriginal_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new Server(['ORIG_PATH_INFO' => $value]);
        $result = $server->getPathInfoOriginal();

        $this->assertSame($expectedResult, $result);
    }
}
