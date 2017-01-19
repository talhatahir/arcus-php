<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
/*
	function __construct(){
        parent::__construct();
        $this->check_isvalidated();
    }

    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('users/login');
        }
    }

*/
	public function index()
	{
		redirect('users/login');
	}


	public function verify_mac(){

		$prop_id =$_GET['macname'];        

        $this->load->model("Users_model");
		$result= $this->Users_model->verify_macid($prop_id);
		echo $result;
		
	}

  	

	public function do_logout(){
        $this->session->sess_destroy();
        redirect('users/login');
    }

	

}

