IP User Location
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
  "ipAddress" : "81.149.15.65",
  "countryCode" : "GB",
  "countryName" : "UNITED KINGDOM",
  "regionName" : "ENGLAND",
  "cityName" : "SALISBURY",
  "zipCode" : "SP1 1TP",
  "latitude" : "51.0693",
  "longitude" : "-1.79569",
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
  "ipAddress" : "81.149.15.65",
  "countryCode" : "GB",
  "countryName" : "UNITED KINGDOM"
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

#### Formats
`json`
`xml`
`json`