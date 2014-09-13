<?php
class UrlShortenerComponent extends Component {
	public $name = 'UrlShortenerComponent';
 
	public function get_bitly_short_url($url) {
		$connectURL = 'http://api.bit.ly/v3/shorten?login=bbhclloydj&apiKey='.Configure::read('bitlyAPIkey').'&uri='.$url.'&format=txt';
		return $this->curl_get_contents($connectURL);
	}
 
	private function curl_get_contents($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}
?>