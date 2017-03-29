IPInfoDB PHP wrapper
=======

Basic PHP wrapper for the [IPInfoDB Geolocation API] (http://ipinfodb.com/)


### Installation

Download and include in your project.
Not listed on Composer.

### Methods

#### Get city precision GEO location
Use `->getCity($ip)` to retrieve city precision from specified IP address.

Return JSON response format:

```
{
	"statusCode" : "OK",
	"statusMessage" : "",
	"ipAddress" : "192.78.226.199",
	"countryCode" : "BE",
	"countryName" : "Belgium",
	"regionName" : "Brussels Hoofdstedelijk Gewest",
	"cityName" : "Brussels",
	"zipCode" : "1210",
	"latitude" : "50.8504",
	"longitude" : "4.34878",
	"timeZone" : "+01:00"
}
```

#### Get country precision GEO information
Use `->getCountry($ip)` to retrieve country precision from specified IP address. 
Faster then the `->getCity($ip)` method, due to decrease of accuracy.

Example json response:

```
{
  "statusCode" : "OK",
  "statusMessage" : "",
  "ipAddress" : "192.78.226.199",
  "countryCode" : "BE",
  "countryName" : "Belgium",
}
```

### API keys & query limits
You can get a (free) API key [here](http://ipinfodb.com/register.php), obviously this should be kept private.
While there are no strict query limits if you send more than 2 requests per second they will be queued. 

```php
// Create a new instance
$ipInfo = new IpInfoDB(APIKEY, 'format');
$location = json_decode($ipInfo->getCity('ip'));
$location = json_decode($ipInfo->getCountry('ip'));
var_dump($location);
```

#### Formats
`raw`
`xml`
`json`