<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	/**
	* 
	*/


	
	function index()
	{

		function __construct()
	{
		parent::__construct();
		$this->load->library('zend','zend/Feed');
		$this->load->library('zend','zend/Search');
		$this->load->library('Zend');
		$this->zend->load('zend/Feed');
		$this->zend->load('zend/Search');
	}
		  
	$index=new Zend_Search_Lucene('e:\rss');
		$index=array(
			'http://rss.detik.com',
			'http://rss.vivanews.com/get/all'
			);

		foreach ($feeds as $feed) {
			# index masing-masing item
			$channel=Zend_Feed::import($feed);
			echo $channel->title().'<br/>';

			foreach ($channel->items as $item) {
				if($item->link() && $item->title() &&  $item->description()){
				#create an index doc
				$doc= new Zend_Search_Lucene_Document();
				$doc->addField(Zend_Search_Lucene_Field::Keyword('link'.$this->sanitize($item->link())));
				$doc->addField(Zend_Search_Lucene_Field::Text('title'.$this->sanitize($item->title())));
				$doc->addField(Zend_Search_Lucene_Field::Unstored('contents'.$this->sanitize($item->description())));
				echo "\tAdding: ".$item->title().'<br/>';
				$index->addDocument($doc);
			}
		}
	}

	$index->commit();
	echo $index->count().'Documents indexed'.'<br/>';
	$this->load->view('index');
}

 function sanitize($input)
    {
        return htmlentities(strip_tags($input));
    }
 
function search() 
    { 
        // if ($this->input->post('submit') )
        // {
        //      $index = new Zend_Search_Lucene('c:\xampp\htdocs\lucene\tmp\feeds_index');  
        //      $hits = $index->find($this->input->post('query'));  
        //      $theme['query'] = $this->input->post('query');
        //      $theme['count'] = $index->count();
        //      $theme['hits_count'] = count($hits);
        //      $theme['hits'] = $hits;
        //      $this->load->view('index');
        // 	}
    $this->load->library('zend', 'zend/Search');   
    $this->load->library('zend');   
    $this->zend->load('zend/Search');      

    $index = new Zend_Search_Lucene('e:\rss');      

    $query = 'politik';      
    $hits = $index->find($query);      

    echo 'Index contains '. $index->count() .
        ' documents.<br /><br />';   
    echo 'Search for "'. $query .'" returned '. count($hits) .
        ' hits<br /><br />';      

    foreach($hits as $hit)   
    {    
        echo $hit->title .'<br />';    
        echo 'Score: '. sprintf('%.2f', $hit->score) .'<br />';    
        echo $hit->link .'<br /><br />';   
    }    

    	}
	}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */