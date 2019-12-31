# Introduction

laminas-uri aids in manipulating and validating [Uniform 
Resource Identifiers](http://www.w3.org/Addressing/)
([URIs](http://www.ietf.org/rfc/rfc3986.txt)). laminas-uri exists primarily
to assist other components, such as
[laminas-http](https://docs.laminas.dev/laminas-http/), but is also useful as a
standalone utility.

URIs always begin with a scheme, followed by a colon. The construction of the
many different schemes varies significantly. The laminas-uri component provides the
`Laminas\Uri\UriFactory` that returns an instance of the appropriate class
implementing `Laminas\Uri\UriInterface` for the given scheme (assuming the factory
can locate one).
