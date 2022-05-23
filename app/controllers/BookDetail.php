<?php 

	/**
	 * 
	 */
	class BookDetail extends Controller
	{
		private $currentId=1;
		function __construct()
		{
			$this->userModel = $this->model('Book');
		}
		public function index($id=1){
			$idd = (int)$id;
			if ($idd > 0) {
				$book = $this->userModel->getById($id);	
			}else{
				$book = $this->userModel->getById($this->currentId);	
			}
			$data = [
					'title' => "book detail",
					'book' => $book,
			];
			$this->view('BookDetail/index',$data);
		}	
	}