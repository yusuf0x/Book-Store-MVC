 <?php 

	class Home extends Controller
	{
		
		public function __construct()
		{
			$this->userModel = $this->model('Book');
		} 
		public function index(){
			$books = $this->userModel->getNumberOfBooks(4);
			$data = [
            'title' => 'Home page',
            'books' => $books
        	];

       		$this->view('Home/index',$data);
		}
		public function about(){
			$this->view("Home/about");
		}

	}