<?php 

	/**
	 * Load The model and the View
	 */
	class Controller
	{
		
		function __construct()
		{
			// code...
		}
		public function model($model){
			// if (file_exists('../app/models/'.$model.'.php')){
			require_once '../app/models/'.$model.'.php';
			//instantiate model
			return new $model();
			// }else{
			// 	die("HHHHHHHHHHHH");
			// 	return null;
			// }
		}
		public function view($view,$data=[]){
			if (file_exists('../app/views/'.$view.'.php')) {
				require_once '../app/views/'.$view.'.php';
			}
			else{
				die("View Does not exists");
			}
		}
	}