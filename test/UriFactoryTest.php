<?php

/**
 * @see       https://github.com/laminas/laminas-uri for the canonical source repository
 * @copyright https://github.com/laminas/laminas-uri/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-uri/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Uri;

use Laminas\Uri\UriFactory;

/**
 * @group      Laminas_Uri
 */
class UriFactoryTest extends \PHPUnit_Framework_TestCase
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
        $this->assertAttributeNotContains($class, 'schemeClasses', '\Laminas\Uri\UriFactory');
        UriFactory::registerScheme($scheme, $class);
        $this->assertAttributeContains($class, 'schemeClasses', '\Laminas\Uri\UriFactory');
        UriFactory::unregisterScheme($scheme);
        $this->assertAttributeNotContains($class, 'schemeClasses', '\Laminas\Uri\UriFactory');
    }

    /**
     * Provide the data for the RegisterNewScheme-test
     */
    public function registeringNewSchemeProvider()
    {
        return array(
            array('ssh', 'Foo\Bar\Class'),
            array('ntp', 'No real class at all!!!'),
        );
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
        return array(
            array('http://example.com', 'Laminas\Uri\Http'),
            array('https://example.com', 'Laminas\Uri\Http'),
            array('mailto://example.com', 'Laminas\Uri\Mailto'),
            array('file://example.com', 'Laminas\Uri\File'),
        );
    }

    /**
     * Test, that unknown Schemes will result in an exception
     *
     * @param string $uri an uri with an unknown scheme
     * @expectedException Laminas\Uri\Exception\InvalidArgumentException
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
        return array(
            array('foo://bar'),
            array('ssh://bar'),
        );
    }
}
