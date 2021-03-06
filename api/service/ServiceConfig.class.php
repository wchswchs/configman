<?php
namespace Configman\Api\Service;

use Configman\Api\BaseServiceConfig;

abstract class ServiceConfig extends BaseServiceConfig {
	
	public $file;
	
	public function setConfigKey($key) {
		if($key) {
			$this->file = $this->config_path.$this->service.'/'.$key.'.'.$this->service.'.ini';
		} else {
			$this->file = $this->config_path.$this->service.'.ini';
		}
	
		return $this;
	}
	
	public function add($config) {
		$config_arr = array();
	
		foreach($config as $k => $item) {
			$config_arr[] = $k.'='.$item;
		}

		file_put_contents($this->file, implode(' ', $config_arr)."\n", FILE_APPEND);
	}
	
	public function addLine($line) {
		file_put_contents($this->file, $line."\r\n", FILE_APPEND);
	}
	
	public function read() {
		$configure = file($this->file);
		$config = $this->parse($configure);

		return $config;
	}
	
	public function remove($line_num) {
		$line_num_arr = explode(', 	', $line_num);
		$configure = file($this->file);
		
		foreach($configure as $k => $line) {
			if(in_array($k + 1, $line_num_arr)) {
				unset($configure[$k]);
			}
		}
		
		unlink($this->file);
		
		$config_str = '';
		foreach($configure as $line) {
			$config_str .= $line . "\r";
		}
		
		return file_put_contents($this->file, $config_str);
	}
	
	public function show() {
		return file($this->file);
	}
	
	abstract public function parse($configure);
	
}