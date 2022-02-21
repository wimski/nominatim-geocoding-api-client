[![Latest Stable Version](http://poser.pugx.org/wimski/nominatim-geocoding-api-client/v)](https://packagist.org/packages/wimski/nominatim-geocoding-api-client)
[![Coverage Status](https://coveralls.io/repos/github/wimski/nominatim-geocoding-api-client/badge.svg?branch=master)](https://coveralls.io/github/wimski/nominatim-geocoding-api-client?branch=master)
[![PHPUnit](https://github.com/wimski/nominatim-geocoding-api-client/actions/workflows/phpunit.yml/badge.svg)](https://github.com/wimski/nominatim-geocoding-api-client/actions/workflows/phpunit.yml)
[![PHPStan](https://github.com/wimski/nominatim-geocoding-api-client/actions/workflows/phpstan.yml/badge.svg)](https://github.com/wimski/nominatim-geocoding-api-client/actions/workflows/phpstan.yml)

# Nominatim Geocoding API Client

## Changelog

[View the changelog.](./CHANGELOG.md)

## Usage

### Install package

```bash
composer require wimski/nominatim-geocoding-api-client
```

### Example

```php
use Wimski\Nominatim\Client;
use Wimski\Nominatim\Config\NominatimConfig;
use Wimski\Nominatim\GeocoderServices\NominatimGeocoderService;
use Wimski\Nominatim\RequestParameters\ForwardGeocodingQueryRequestParameters;
use Wimski\Nominatim\Transformers\GeocodingResponseTransformer;

$config = new NominatimConfig(
    'my-custom-user-agent',
    'email@provider.net',
);

$service = new NominatimGeocoderService(
    new Client(),
    new GeocodingResponseTransformer(),
    $config,
);

$requestParameters = ForwardGeocodingQueryRequestParameters::make('some query')
    ->addCountryCode('nl')
    ->includeAddressDetails();

$response = $service->requestForwardGeocoding($requestParameters);

// Get data from the response
$latitude = $response->getItems()[0]->getCoordinate()->getLatitude();
```

### PSR HTTP

The `Client` class uses [Discovery](https://docs.php-http.org/en/latest/discovery.html) by default to get instances of the following contracts:
 
* `Psr\Http\Client\ClientInterface`
* `Psr\Http\Message\RequestFactoryInterface`
* `Psr\Http\Message\UriFactoryInterface`

This means that you need to include (a) PSR compatible package(s) [in your project](https://docs.php-http.org/en/latest/httplug/users.html).

If you already have setup a specific HTTP client configuration in your project,
which you would also like to use for Nominatim requests,
you can pass that as a constructor argument to the `Client`:

```php
$service = new NominatimGeocoderService(
    new Client($myCustomPsrHttpClient),
    new GeocodingResponseTransformer(),
    new NominatimConfig('user-agent', 'email@provider.net'),
);
```

### Services

Services for the following providers are currently available:
* [Nominatim](https://nominatim.org/release-docs/latest/api/Overview/)
* [LocationIQ](https://locationiq.com/docs)

Custom services can easily be created by extending the `AbstractGeocoderService`
as long as the provider implements the Nominatim spec correctly.

## PHPUnit

```bash
composer run phpunit
```

## PHPStan

```bash
composer run phpstan
```

## Credits

- [wimski](https://github.com/wimski)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
