<?php
use Illuminate\Support;  // https://laravel.com/docs/5.8/collections - provides the collect methods & collections class
use LSS\Array2Xml;
require_once('classes/Exporter.php');

class Controller {
	public function __construct($args) {
		$this->args = $args;
	}

	public function export($type, $format) {
		$exporter = new Exporter();

		switch ($type) {
			case 'playerstats':
				return $exporter->format($exporter->getPlayerStats($this->filter()), $format);
			case 'players':
				return $exporter->format($exporter->getPlayers($this->filter()), $format);
		}

		exit("Error: No data found!");
	}

	private function filter() {
		$query = ['player', 'playerId', 'team', 'position', 'country'];
		return $this->args->filter(function($value, $key) use ($query) {
				return in_array($key, $query);
		});
	}
}