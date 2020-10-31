<?php

/**
 * @see       https://github.com/laminas/laminas-uri for the canonical source repository
 * @copyright https://github.com/laminas/laminas-uri/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-uri/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Uri;

use Laminas\Uri\Exception\InvalidUriPartException;
use Laminas\Uri\File as FileUri;
use PHPUnit\Framework\TestCase;

use function var_export;

/**
 * @group      Laminas_Uri
 * @group      Laminas_Uri_Http
 * @group      Laminas_Http
 */
class FileTest extends TestCase
{
    /**
     * Data Providers
     */

    /**
     * @return array<int,array<int,string>>
     */
    public static function validSchemeProvider()
    {
        return [
            ['file'],
            ['FILE'],
            ['File'],
        ];
    }

    /**
     * @return array<int,array<int,string>>
     */
    public static function invalidSchemeProvider()
    {
        return [
            ['mailto'],
            ['http'],
            ['g'],
            ['file:'],
        ];
    }

    /**
     * @return array<int,array<int,string>>
     */
    public static function invalidUris()
    {
        return [
            ['file:foo.bar/baz?bat=boo'],
            ['file://foo.bar:80/baz?bat=boo'],
            ['file://user:pass@foo.bar:80/baz?bat=boo'],
            ['file:///baz?bat=boo'],
        ];
    }

    /**
     * @return array<int,array<int,string>>
     */
    public static function validUris()
    {
        return [
            ['file:///baz'],
            ['file://example.com/baz'],
            ['file://example.com:2132/baz'],
            ['file://example.com:2132/baz#fragment'],
            ['file://user:info@example.com:2132/baz'],
            ['file://C:/foo bar/baz'],
        ];
    }

    /**
     * @return array<int,array<int,string>>
     */
    public static function unixUris()
    {
        return [
            ['/foo/bar/baz.bat', '/foo/bar/baz.bat'],
            ['/foo/bar/../baz.bat', '/foo/baz.bat'],
            ['/foo/bar/../../baz.bat', '/baz.bat'],
            ['/foo/bar baz.bat', '/foo/bar%20baz.bat'],
        ];
    }

    /**
     * @return array<int,array<int,string>>
     */
    public static function windowsUris()
    {
        return [
            ['C:\Program Files\Laminas\README', 'C:/Program%20Files/Laminas/README'],
        ];
    }

    /**
     * Tests
     */

    /**
     * Test that specific schemes are valid for this class
     *
     * @param string $scheme
     * @dataProvider validSchemeProvider
     */
    public function testValidScheme($scheme)
    {
        $uri = new FileUri();
        $uri->setScheme($scheme);
        $this->assertEquals($scheme, $uri->getScheme());
    }

    /**
     * Test that specific schemes are invalid for this class
     *
     * @param string $scheme
     * @dataProvider invalidSchemeProvider
     */
    public function testInvalidScheme($scheme)
    {
        $uri = new FileUri();
        $this->expectException(InvalidUriPartException::class);
        $uri->setScheme($scheme);
    }

    /**
     * Test that validateScheme returns false for schemes not valid for use
     * with the File class
     *
     * @param string $scheme
     * @dataProvider invalidSchemeProvider
     */
    public function testValidateSchemeInvalid($scheme)
    {
        $this->assertFalse(FileUri::validateScheme($scheme));
    }

    /**
     * @param string $uri
     * @dataProvider invalidUris
     */
    public function testInvalidFileUris($uri)
    {
        $uri   = new FileUri($uri);
        $parts = [
            'scheme'    => $uri->getScheme(),
            'user_info' => $uri->getUserInfo(),
            'host'      => $uri->getHost(),
            'port'      => $uri->getPort(),
            'path'      => $uri->getPath(),
            'query'     => $uri->getQueryAsArray(),
            'fragment'  => $uri->getFragment(),
        ];
        $this->assertFalse($uri->isValid(), var_export($parts, 1));
    }

    /**
     * @param string $uri
     * @dataProvider validUris
     */
    public function testValidFileUris($uri)
    {
        $uri   = new FileUri($uri);
        $parts = [
            'scheme'    => $uri->getScheme(),
            'user_info' => $uri->getUserInfo(),
            'host'      => $uri->getHost(),
            'port'      => $uri->getPort(),
            'path'      => $uri->getPath(),
            'query'     => $uri->getQueryAsArray(),
            'fragment'  => $uri->getFragment(),
        ];
        $this->assertTrue($uri->isValid(), var_export($parts, 1));
    }

    public function testUserInfoIsAlwaysNull()
    {
        $uri = new FileUri('file://user:pass@host/foo/bar');
        $this->assertNull($uri->getUserInfo());
    }

    public function testFragmentIsAlwaysNull()
    {
        $uri = new FileUri('file:///foo/bar#fragment');
        $this->assertNull($uri->getFragment());
    }

    /**
     * @param string $path
     * @param string $expected
     * @dataProvider unixUris
     */
    public function testCanCreateUriObjectFromUnixPath($path, $expected)
    {
        $uri = FileUri::fromUnixPath($path);
        $uri->normalize();
        $this->assertEquals($expected, $uri->getPath());
    }

    /**
     * @param string $path
     * @param string $expected
     * @dataProvider windowsUris
     */
    public function testCanCreateUriObjectFromWindowsPath($path, $expected)
    {
        $uri = FileUri::fromWindowsPath($path);
        $uri->normalize();
        $this->assertEquals($expected, $uri->getPath());
    }
}
