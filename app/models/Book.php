<?php 
	/**
	 * 
	 */
	class Book
	{
		private $db;
		private $limit = 8;
		private $total_rows;
		private $total_pages=0;
		private $initial_page=0;
		private $page_number;
		private $result;
	    public function __construct() {
	        $this->db = new Database;
	    }
	    public function getNumberOfBooks($number){
	    	$this->db->query('SELECT * FROM book LIMIT :number');
	    	$this->db->bind(':number',$number);
	    	return $this->db->resultSet() ? $this->db->resultSet() : [];
	    }
	    public function getById($id){
	    	$this->db->query('SELECT * FROM book WHERE book.book_id =:id');
	    	$this->db->bind(':id',$id);
	    	return $this->db->single();
	    }
	    public function getAllBooks(){
	    	if (isset($_GET['book_name']) || isset($_GET['type']) || isset($_GET['author'])) {
	    		// for pagination
	    		// $this->db->query("SELECT * FROM book WHERE book_title=:book_name or type=:type or author=:author LIMIT :initial_page,:limit");
	    		// $this->db->bind(':book_name',$_GET['book_name']);
	    		// $this->db->bind(':type',$_GET['type']);
	    		// $this->db->bind(':author',$_GET['author']);
	    		// $this->db->bind(':initial_page',(int)$initial_page);
	    		// $this->db->bind(':limit',(int)$limit);

	    		$this->db->query("SELECT * FROM book WHERE book_title=:book_name or type=:type or author=:author");
	    		$this->db->bind(':book_name',$_GET['book_name']);
	    		$this->db->bind(':type',$_GET['type']);
	    		$this->db->bind(':author',$_GET['author']);
	    		$this->result = $this->db->resultSet();

	    	}
	    	else{
	    		// for pagination
	    		// $this->db->query("SELECT * FROM book LIMIT :initial_page,:limit");
	    		// $this->db->bind(':initial_page',(int)$initial_page);
	    		// $this->db->bind(':limit',(int)$limit);

	    		$this->db->query("SELECT * FROM book");
				$this->result = $this->db->resultSet();
				// print_r($this->result);

            }
            return $this->result;

	    }
	    public function getByTypes(){
	    	$this->db->query("SELECT DISTINCT type FROM book");
	    	return $this->db->resultSet();

	    }
	    public function getByAuthors(){
	    	$this->db->query("SELECT DISTINCT author FROM book");
	    	return $this->db->resultSet();
	    }
	    public function getTotalPages(){
	    	return $this->total_pages;
	    }

	}

	