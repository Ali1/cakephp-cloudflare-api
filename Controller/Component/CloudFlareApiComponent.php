<?php


/**
 * CloudFlareApiComponent
 *
 * Provides an entry point into the CloudFlare API.
 */
class CloudFlareApiComponent extends Component {

  /**
   * Initialization method. Triggered before the controller's `beforeFilfer`
   * method but after the model instantiation.
   *
   * @param Controller $controller
   * @param array $settings
   * @return null
   * @access public
   */
  public function initialize(Controller $controller) {
    // Handle loading our library firstly...
	App::build(array('Vendor' => array(APP . 'Vendor' . DS . 'vexxhost' . DS . 'cloud-flare-api')));
	App::import('Vendor', 'cloudflare_api', array('file' => 'vexxhost' . DS . 'cloud-flare-api' . DS . 'class_cloudflare.php'));
	$this->Cf = new cloudflare_api(Configure::read('CloudFlareApi.email'), Configure::read('CloudFlareApi.apiKey'));
  }

  /**
   * PHP magic method for satisfying requests for undefined variables. We
   * will attempt to determine the service that the user is requesting and
   * start it up for them.
   *
   * @var string $variable
   * @return mixed
   * @access public
   */
	public function __call($name, $arguments) {
		return call_user_func_array(array($this->Cf, $name), $arguments);
	}
}