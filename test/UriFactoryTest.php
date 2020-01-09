<?php

/**
 * @see       https://github.com/laminas/laminas-uri for the canonical source repository
 * @copyright https://github.com/laminas/laminas-uri/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-uri/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Uri;

use Laminas\Uri\UriFactory;
use PHPUnit\Framework\TestCase;

/**
 * @group      Laminas_Uri
 */
class UriFactoryTest extends TestCase
{
    /**
     * General composing / parsing tests
     */

    /**
     * Test registering a new Scheme
     *
     * @param        string $scheme
     * @param        string $class
     * @dataProvider registeringNewSchemeProvider
     */
    public function testRegisteringNewScheme($scheme, $class)
    {
        $this->assertNull(UriFactory::getRegisteredSchemeClass($scheme));
        UriFactory::registerScheme($scheme, $class);
        $this->assertEquals(UriFactory::getRegisteredSchemeClass($scheme), $class);
        UriFactory::unregisterScheme($scheme);
        $this->assertNull(UriFactory::getRegisteredSchemeClass($scheme));
    }

    /**
     * Provide the data for the RegisterNewScheme-test
     */
    public function registeringNewSchemeProvider()
    {
        return [
            ['ssh', 'Foo\Bar\Class'],
            ['ntp', 'No real class at all!!!'],
        ];
    }

    /**
     * Test creation of new URI with an existing scheme-classd
     *
     * @param string $uri           THe URI to create
     * @param string $expectedClass The class expected
     *
     * @dataProvider createUriWithFactoryProvider
     */
    public function testCreateUriWithFactory($uri, $expectedClass)
    {
        $class = UriFactory::factory($uri);
        $this->assertInstanceof($expectedClass, $class);
    }

    /**
     * Providethe data for the CreateUriWithFactory-test
     *
     * @return array
     */
    public function createUriWithFactoryProvider()
    {
        return [
            ['http://example.com', 'Laminas\Uri\Http'],
            ['https://example.com', 'Laminas\Uri\Http'],
            ['mailto://example.com', 'Laminas\Uri\Mailto'],
            ['file://example.com', 'Laminas\Uri\File'],
        ];
    }

    /**
     * Test, that unknown Schemes will result in an exception
     *
     * @param string $uri an uri with an unknown scheme
     * @expectedException \Laminas\Uri\Exception\InvalidArgumentException
     * @dataProvider unknownSchemeThrowsExceptionProvider
     */
    public function testUnknownSchemeThrowsException($uri)
    {
        $url = UriFactory::factory($uri);
    }

    /**
     * Provide data to the unknownSchemeThrowsException-TEst
     *
     * @return array
     */
    public function unknownSchemeThrowsExceptionProvider()
    {
        return [
            ['foo://bar'],
            ['ssh://bar'],
        ];
    }
}
