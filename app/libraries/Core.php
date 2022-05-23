<?php 

	//Core app Class
	/**
	 * 
	 */
	class Core
	{
		protected $currentController = "Home";
		protected $currentMethod = "index";
		protected $params = [];
		public function __construct()
		{
			// print_r($this->getUrl());
			$url = $this->getUrl();
			// print_r($url);
			// look for controllers
			if (file_exists("../app/controllers/".ucwords($url[0]).".php")) {
				//we set  new Controller
				$this->currentController = ucwords($url[0]);
				unset($url[0]);
			}
			// print($this->currentController)." ";
			require_once "../app/controllers/".$this->currentController.".php";

			$this->currentController = new $this->currentController;
				// echo "here";
			// // check for second part of the url 
			if (isset($url[1])){
				if (method_exists($this->currentController,$url[1])) {
					$this->currentMethod = $url[1];
					unset($url[1]);
				}
			}

			// print($this->currentMethod)."  ";
			// }
			// // GEt parametres
			$this->params = $url ? array_values($url) : [];
			// 
			// print($this->currentMethod);
			// print($this->params);
			// var_dump($this->params);

			// // Call a CallBack with array of params
			call_user_func_array([$this->currentController,$this->currentMethod],$this->params);

		}
		// shop/glasses/men

		public function getUrl(){
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'],'/');
				$url = filter_var($url,FILTER_SANITIZE_URL);
				//breaking into an array 
				$url = explode('/',$url);
				return $url;
			} 
		}
	}