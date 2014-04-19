# CloudFlare API plugin for CakePHP 2.0+

This plugin is a (*very*) thin veil over vexxhost's [CloudFlare-API](https://github.com/vexxhost/CloudFlare-API) for use in CakePHP controllers.
Please use composer to install so that the required dependencies are installed

## Composer Installation

* Add to composer, this will also install the Amazon SDK for PHP as a dependency

        "ali1/cakephp-cloudflare-api": "dev-master"

## Non-composer Installation

* Place the contents of this repo in Plugin/CloudFlareApi
* Download the contents of https://github.com/vexxhost/CloudFlare-API into Plugin/CloudFlareApi/Vendor/vexxhost/cloud-flare-api

## Configuration

* You must add configuration to bootstrap.php.

		Configure::write('CloudFlareApi.email', 'CLOUDFLARE EMAIL');
		Configure::write('CloudFlareApi.apiKey', 'CLOUDFLARE API KEY');

  *  Don't forget to replace the placeholder text with your actual keys!

* Add the component to a controller

		public $components = array('CloudFlareApi.CloudFlareApi');## Example

* Remove a file from the cache

		$this->CloudFlareApi->zone_file_purge('mydomain.com', 'http://forum.mydomain.com/images/logo.png');

* From a model or shell

		if (!isset($this->CloudFlareApi)) {
			App::import('Component', 'CloudFlareApi.CloudFlareApi');
			$collection = new ComponentCollection();
			$Controller =& new Controller();
			$this->CloudFlareApi = new CloudFlareApiComponent($collection);
			$this->CloudFlareApi->initialize($Controller);
		}
		$this->CloudFlareApi->zone_file_purge('mydomain.com', 'http://forum.mydomain.com/images/logo.png');

* From a console

	Console/cake CloudFlareApi.call fpurge_ts mydomain.com
	Console/cake CloudFlareApi.call zone_file_purge mydomain.com http://forum.mydomain.com/images/logo.png

## Notes

You can find the method definitions here: https://github.com/vexxhost/CloudFlare-API/blob/master/class_cloudflare.php
