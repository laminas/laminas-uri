# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 2.8.0 - 2020-10-31

### Added

- [#12](https://github.com/laminas/laminas-uri/pull/12) Adds PHP 8.0 support


-----

### Release Notes for [2.8.0](https://github.com/laminas/laminas-uri/milestone/1)



### 2.8.0

- Total issues resolved: **0**
- Total pull requests resolved: **2**
- Total contributors: **2**

#### Enhancement

 - [13: Introducing laminas-coding-standard v2](https://github.com/laminas/laminas-uri/pull/13) thanks to @boesing

#### Awaiting Author Updates,Enhancement,hacktoberfest-accepted

 - [12: Added support for PHP 8.0](https://github.com/laminas/laminas-uri/pull/12) thanks to @vpn

## 2.7.1 - 2019-10-07

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-uri#34](https://github.com/zendframework/zend-uri/pull/34) fixes hostname recognition
  when port number is not provided. Additional colon is stripped out.

## 2.7.0 - 2019-02-27

### Added

- Nothing.

### Changed

- [zendframework/zend-uri#29](https://github.com/zendframework/zend-uri/pull/29) changes the behavior of `getHost()`:
  it will now always return a lowercase representation. This is in accord with
  [IETF 3986 Section 3.2.2](https://tools.ietf.org/html/rfc3986#section-3.2.2).

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 2.6.2 - 2019-02-26

### Added

- [zendframework/zend-uri#28](https://github.com/zendframework/zend-uri/pull/28) adds support for PHP 7.3.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 2.6.1 - 2018-04-30

### Added

- Nothing.

### Changed

- [zendframework/zend-uri#23](https://github.com/zendframework/zend-uri/pull/23) updates the laminas-validator dependency to the 2.10 series, in order to ensure that
  this package can run under PHP 7.2.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 2.6.0 - 2018-04-10

### Added

- [zendframework/zend-uri#4](https://github.com/zendframework/zend-uri/pull/4) adds and publishes the
  documentation to https://docs.laminas.dev/laminas-uri/

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-uri#16](https://github.com/zendframework/zend-uri/pull/16) removes support for
  PHP 5.5.

- [zendframework/zend-uri#16](https://github.com/zendframework/zend-uri/pull/16) removes support for
  HHVM.

### Fixed

- [zendframework/zend-uri#17](https://github.com/zendframework/zend-uri/pull/17) updates the path
  encoding algorithm to allow `(` and `)` characters as path characters (per
  the RFC-3986, these are valid sub-delimiters allowed within a path).

## 2.5.2 - 2016-02-17

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-uri#3](https://github.com/zendframework/zend-uri/pull/3) updates dependencies to
  allow the component to work with both PHP 5 and PHP 7 versions, as well as
  all 2.X versions of required Laminas components.
