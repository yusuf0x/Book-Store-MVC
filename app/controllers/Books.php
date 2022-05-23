<?php 

	

	class Books extends Controller
	{
		
		public function __construct()
		{
			// echo "Loaded";
			$this->userModel = $this->model('Book');
		} 
		public function index(){
			$result = $this->userModel->getAllBooks();
			$types = $this->userModel->getByTypes();
			$authors = $this->userModel->getByAuthors();
			$total_pages = $this->userModel->getTotalPages();
			$data = [
            'title' => 'Books page',
            'types' => $types,
            'authors' => $authors,
            'total_pages' => $total_pages,
            'result' => $result,
        	];

       		$this->view('Books/index', $data);
		}
		public function about(){
			$this->view("Books/about");
		}

	}