<?php

App::uses('Component', 'Controller');
App::uses('Controller', 'Controller');

class CallShell extends Shell {

	public function main() {
		if (!isset($this->CloudFlareApi)) {
			App::import('Component', 'CloudFlareApi.CloudFlareApi');
			$collection = new ComponentCollection();
			$Controller = & new Controller();
			$this->CloudFlareApi = new CloudFlareApiComponent($collection);
			$this->CloudFlareApi->initialize($Controller);
		}
		if (empty($this->args[0])) {
			echo "Please provide a command to run as an argument";
			return false;
		}
		$cmd = $this->args[0];
		$args = array_slice($this->args, 1);
		debug(call_user_func_array([$this->CloudFlareApi, $cmd], $args));
	}
}
