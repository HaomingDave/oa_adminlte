<?php

abstract class Model {
	protected $registry;
	public function Model($registry) {
		$this->registry = $registry;
	}
	
	public function get($key) {

		return $this->registry->get($key);
	}
	
	public function set($key, $value) {
		$this->registry->set($key, $value);
	}
}
?>