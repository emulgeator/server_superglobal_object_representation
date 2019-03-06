<?php
declare(strict_types=1);

namespace Emu\Server\Test;


use Emul\Server\Exception;
use PHPUnit\Framework\TestCase;
use Emul\Server\ServerData;

class ServerDataTest extends TestCase
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

    public function arrayAccessHasProvider()
    {
        $server = ['exists' => 'value'];
        return [
            'key exists'         => [$server, 'exists', true],
            'key does not exist' => [$server, 'does not exist', false],
        ];
    }

    public function testArrayAccessGet_shouldReturnValuesByGivenKey()
    {
        $key   = 'key';
        $value = 'value';

        $server = new ServerData([$key => $value]);

        $this->assertSame($value, $server[$key]);
    }

    /**
     * @dataProvider arrayAccessHasProvider
     */
    public function testArrayAccessHas_shouldReturnTrueIfKeyExists(array $server, string $key, bool $expectedResult)
    {
        $server = new ServerData($server);

        $this->assertSame($expectedResult, isset($server[$key]));
    }

    public function testArrayAccessSet_shouldThrowException()
    {
        $server = new ServerData([]);
        $this->expectException(Exception::class);
        $server['test'] = 'value';
    }

    public function testArrayAccessUnSet_shouldThrowException()
    {
        $server = new ServerData([]);
        $this->expectException(Exception::class);
        unset($server['test']);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPhpSelf_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['PHP_SELF' => $value]);
        $result = $server->getPhpSelf();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider arrayProvider
     */
    public function testGetArguments_shouldAlwaysReturnArray($value, array $expectedResult)
    {
        $server = new ServerData(['argv' => $value]);
        $result = $server->getArguments();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider intProvider
     */
    public function testGetArgumentCount_shouldReturnIntOrNull($value, ?int $expectedResult)
    {
        $server = new ServerData(['argc' => $value]);
        $result = $server->getArgumentCount();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetGatewayInterface_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['GATEWAY_INTERFACE' => $value]);
        $result = $server->getGatewayInterface();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerAddress_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_ADDR' => $value]);
        $result = $server->getServerAddress();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerName_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_NAME' => $value]);
        $result = $server->getServerName();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerSoftware_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_SOFTWARE' => $value]);
        $result = $server->getServerSoftware();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerProtocol_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_PROTOCOL' => $value]);
        $result = $server->getServerProtocol();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRequestMethod_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REQUEST_METHOD' => $value]);
        $result = $server->getRequestMethod();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider intProvider
     */
    public function testGetRequestTime_shouldReturnIntOrNull($value, ?int $expectedResult)
    {
        $server = new ServerData(['REQUEST_TIME' => $value]);
        $result = $server->getRequestTime();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider floatProvider
     */
    public function testGetRequestTimeMs_shouldReturnFloatOrNull($value, ?float $expectedResult)
    {
        $server = new ServerData(['REQUEST_TIME_FLOAT' => $value]);
        $result = $server->getRequestTimeMs();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetQueryString_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['QUERY_STRING' => $value]);
        $result = $server->getQueryString();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetDocumentRoot_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['DOCUMENT_ROOT' => $value]);
        $result = $server->getDocumentRoot();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_ACCEPT' => $value]);
        $result = $server->getHttpAcceptHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptCharsetHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_ACCEPT_CHARSET' => $value]);
        $result = $server->getHttpAcceptCharsetHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptEncodingHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_ACCEPT_ENCODING' => $value]);
        $result = $server->getHttpAcceptEncodingHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpAcceptLanguageHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_ACCEPT_LANGUAGE' => $value]);
        $result = $server->getHttpAcceptLanguageHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpConnectionHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_CONNECTION' => $value]);
        $result = $server->getHttpConnectionHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpHostHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_HOST' => $value]);
        $result = $server->getHttpHostHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpRefererHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_REFERER' => $value]);
        $result = $server->getHttpRefererHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetHttpUserAgentHeader_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['HTTP_USER_AGENT' => $value]);
        $result = $server->getHttpUserAgentHeader();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider boolProvider
     */
    public function testIsHttps_shouldReturnBool($value, bool $expectedResult)
    {
        $server = new ServerData(['HTTPS' => $value]);
        $result = $server->isHttps();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemoteAddress_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REMOTE_ADDR' => $value]);
        $result = $server->getRemoteAddress();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemoteHost_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REMOTE_HOST' => $value]);
        $result = $server->getRemoteHost();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemotePort_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REMOTE_PORT' => $value]);
        $result = $server->getRemotePort();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRemoteUser_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REMOTE_USER' => $value]);
        $result = $server->getRemoteUser();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRedirectRemoteUser_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REDIRECT_REMOTE_USER' => $value]);
        $result = $server->getRedirectRemoteUser();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetScriptFilename_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SCRIPT_FILENAME' => $value]);
        $result = $server->getScriptFilename();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerAdmin_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_ADMIN' => $value]);
        $result = $server->getServerAdmin();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerPort_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_PORT' => $value]);
        $result = $server->getServerPort();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetServerSignature_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SERVER_SIGNATURE' => $value]);
        $result = $server->getServerSignature();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPathTranslated_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['PATH_TRANSLATED' => $value]);
        $result = $server->getPathTranslated();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetScriptName_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['SCRIPT_NAME' => $value]);
        $result = $server->getScriptName();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetRequestUri_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['REQUEST_URI' => $value]);
        $result = $server->getRequestUri();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationDigest_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['PHP_AUTH_DIGEST' => $value]);
        $result = $server->getAuthenticationDigest();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationUser_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['PHP_AUTH_USER' => $value]);
        $result = $server->getAuthenticationUser();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationPassword_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['PHP_AUTH_PW' => $value]);
        $result = $server->getAuthenticationPassword();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetAuthenticationType_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['AUTH_TYPE' => $value]);
        $result = $server->getAuthenticationType();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPathInfo_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['PATH_INFO' => $value]);
        $result = $server->getPathInfo();

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @dataProvider stringProvider
     */
    public function testGetPathInfoOriginal_shouldReturnStringOrNull($value, ?string $expectedResult)
    {
        $server = new ServerData(['ORIG_PATH_INFO' => $value]);
        $result = $server->getPathInfoOriginal();

        $this->assertSame($expectedResult, $result);
    }
}
