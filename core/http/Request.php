<?php
namespace Core\Http;

class Request {
    
	/**
	 * Http method in request
	 * 
	 * @access public
	 * @var string
	 */
	public $method = 'GET';

	/**
	 * Set http method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		if ($_SERVER['REQUEST_METHOD']) $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
	}

	/**
	 * The method get body request
	 * 
	 * @access public
	 * @return array
	 */
	public function all(): array
	{
		return $this->body();
	}

	/**
     * The method gets values of fields from body requset
	 * 
	 * @param string $key
	 * @access public
	 * @return int|string|array|bool
	 */
	public function field(string $key): int|string|array|bool
	{
		$body = $this->body();

		return isset($body[$key]) ? $body[$key] : false;
	}

	/**
	 * The method get cookies
	 * 
	 * @param string $name
	 * @access public
	 * @return string|false
	 */
	public function cookie_http($name): string|false
	{
		$name = str_replace('.', '_', $name);

		return ($_COOKIE[$name]) ? $_COOKIE[$name] : false;
	}


	/**
	 * The method gets all headers
	 * 
	 * @access public
	 * @return string
	 */
	public function headers(): string
	{
		return apache_request_headers();
	}

	/**
	 * The method get certain header
	 * 
	 * @param string $name
	 * @access public
	 * @return string
	 */
	public function header($name): string
	{
		$data = $this->headers();

		return $data[$name];
	}

	// Privates functions

	/**
	 * The method handling and gets body request
	 * 
	 * @access private
	 * @return array
	 */
	private function body(): array
	{
		if (sizeof($_POST) || sizeof($_GET)) {
			if ($this->method === 'GET') return $_GET;
			if ($this->method === 'POST') return $_POST;
		} else {
			$reqData = file_get_contents('php://input');

			if ($this->is_json($reqData)) {
				return json_decode($reqData, true);
			} else {
				$data = [];
				$expl = explode('&', file_get_contents('php://input'));

				foreach ($expl as $pair) {
					$item = explode('=', $pair);

					if (count($item) === 2) $data[urldecode($item[0])] = urldecode($item[1]);
				}

				return $data;
			}
		}
	}

	/**
	 * The method check valid the json format
	 * 
	 * @param string $str
	 * @access private
	 * @return boolean
	 */
	private function is_json($str): bool
    {
		json_decode($str, true);

		return (json_last_error() == JSON_ERROR_NONE);
	}
}