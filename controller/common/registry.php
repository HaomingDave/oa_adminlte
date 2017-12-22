<?php

	class Registry{
		private $data = array();
		
		function set($key,$var)
		{
			if(!isset($this->data[$key]))
			{
				$this->data[$key] = $var;			
			}
			return true;
		}
		
		function get($key)
		{
			if(!isset($this->data[$key]))
			{
				return null;

			}
			return $this->data[$key];
		}
		
		function remove($key)
		{
			unset($this->data[$key]);
		}
	}
?>