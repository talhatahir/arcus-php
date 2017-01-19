<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {


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
    public function home()
    {
    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('dashboardhome');
    	$this->load->view('footer');
    }

    public function login($msg=null)
    {
    	if($this->session->userdata('validated')){
    		redirect('users/home');
    	}

    	$data['msg'] = $msg;
    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('dashboard',$data);
    	$this->load->view('footer');
    }

    public function index($msg=null)
    {
    	if($this->session->userdata('validated')){
    		redirect('users/home');
    	}
    	else{

    		redirect('users/login');        	
    	}
    }


    public function auth()
    {
    	if($_POST){

    		$this->load->model("Users_model");
    		$result= $this->Users_model->validate();

    		if(! $result){
	            // If user did not validate, then show them login page again
    			$msg = '<div class="alert alert-danger" role="alert">Invalid username and/or password.</div>';
    			$this->login($msg);
    		}else{
	            // If user did validate, 
	            // Send them to members area
    			redirect('users/home');
    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function addguest()
    {

    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('addguest');
    	$this->load->view('footer');
    }

    public function thanks()
    {
    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('thankspopup');
    	$this->load->view('footer');
    }


    public function insertguestinfo()
    {
    	if($_POST){

    		$this->load->model("Users_model");
    		$result= $this->Users_model->insertguestinfo();		


    		if(! $result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";
    		}else{
	            // If user did validate, 
	            // Send them to members area
    			$str='users/roomday?guest_id='.$result;


    			redirect($str);
    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function updateguestinfo($gid=null)
    {
    	if($_POST){

    		$this->load->model("Users_model");
    		$result= $this->Users_model->updateguestinfo();		


    		if(! $result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";
    		}else{
	            // If user did validate, 
	            // Send them to members area
    			$str='users/viewguest?guest_id='.$result;

    			redirect($str,'refresh');
    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function roomday($errormsg=null,$gid=null)
    {
    	if (isset($_GET['guest_id'])) {
    		$guest_id =$_GET['guest_id'];
    	}else{
    		$guest_id =$gid;
    	}	

    	if (isset($_GET['popup'])) {
    		$frompopup=$_GET['popup'];
    	}else{
    		$frompopup=0;
    	}


    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$data['guest_id'] = $guest_id;
    	$data['frompopup'] = $frompopup;
    	$data['errormsg'] = $errormsg;
    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('roomday',$data);
    	$this->load->view('footer');
    }



    public function addroomday()
    {

    	if($_POST){

    		$this->load->model("Users_model");
    		$result= $this->Users_model->insertroomday();

    		if(!$result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";

    		}else{

    			if ((strpos($result['msg_error'],'Error') || strpos($result['msg_error'],'booked')) !== false) {

    				$this->roomday($result['msg_error'],$result['guest_id']);

    			}
    			else{

    				if (isset($_GET['popup'])) {

    					$popupVal=$_GET['popup'];
    					if ($popupVal==1) {
    						redirect('users/thanks');
    					}else{
    						redirect('users/home');	
    					}


    				}else{
    					redirect('users/home');	
    				}


    			}

    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function insertguest_account()
    {
    	if($_POST){
    		$guest_id = $this->security->xss_clean($this->input->post('guest_id'));
    		$this->load->model("Users_model");
    		$result= $this->Users_model->addguest_accountinfo();

    		if(! $result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";
    		}else{
    			$str1=strval($guest_id);

    			$str='users/viewguest?guest_id='.$str1;

    			redirect($str,'refresh');
    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function viewguest()
    {

    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$prop_id =$_GET['guest_id'];


    	$this->load->model("Users_model");
    	$result= $this->Users_model->viewguest($prop_id);


    	$result1= $this->Users_model->guest_room_date($prop_id);


    	$result2= $this->Users_model->guest_get_accountinfo($prop_id);

    	$data['guest_result']=$result;
    	$data['guest_room_time']=$result1;
    	$data['guest_accountinfo']=$result2;


    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('profile',$data);
    	$this->load->view('accountinfo',$data);
    	$this->load->view('footer');
    }

    public function accountsmg()
    {

    	$id=1;
    	$this->load->model("Users_model");
    	$result= $this->Users_model->addcompany_accountinfo($id);


    	$id=1;
    	$this->load->model("Users_model");
    	$result1= $this->Users_model->company_get_accountinfo_test($id);
    	$data['company_accountinfo']=$result1;

    }

    public function accounts()
    {

    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$is_page=0;
    	$total_rowcount=0;
    	$id=1;

    	try{


    		$this->load->model("Users_model");
    		$result_count= $this->Users_model->company_get_accountinfo_count($id);

    		if($result_count > 20){
    			$is_page=1;
    			$total_rowcount=$result_count;
    		}

    	}

    	catch (Exception $e) {
  			//alert the user then kill the process
    		var_dump($e->getMessage());
    	}


    	if ($is_page) {

    		$this->load->library('pagination');
    		$config['base_url'] = base_url().'index.php/users/accounts';
    		$config['total_rows'] = $total_rowcount;
    		$config['per_page'] = 20;
    		$config["uri_segment"] = 3;
    		$choice = $config["total_rows"] / $config["per_page"];
    		$config["num_links"] = round($choice);
    		$config['use_page_numbers'] = TRUE;
    		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    		$config['full_tag_close'] = '</ul>';
    		$config['num_tag_open'] = '<li>';
    		$config['num_tag_close'] = '</li>';
    		$config['cur_tag_open'] = '<li class="active"><span>';
    		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    		$config['prev_tag_open'] = '<li>';
    		$config['prev_tag_close'] = '</li>';
    		$config['next_tag_open'] = '<li>';
    		$config['next_tag_close'] = '</li>';
    		$config['first_link'] = '&laquo;';
    		$config['prev_link'] = '&lsaquo;';
    		$config['last_link'] = '&raquo;';
    		$config['next_link'] = '&rsaquo;';
    		$config['first_tag_open'] = '<li>';
    		$config['first_tag_close'] = '</li>';
    		$config['last_tag_open'] = '<li>';
    		$config['last_tag_close'] = '</li>';

    		$this->pagination->initialize($config); 		

    		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 1;


    		try{
    			$id=1;
    			$this->load->model("Users_model");
    			$result1= $this->Users_model->company_get_accountinfo_pagination($id,$config['per_page'],$page);
    			$data['company_accountinfo']=$result1;
    			$data["links"] = $this->pagination->create_links();
    		}
    		catch (Exception $e) {
	  			//alert the user then kill the process
    			var_dump($e->getMessage());
    		}

    	}else{

    		try{
    			$id=1;
    			$this->load->model("Users_model");
    			$result1= $this->Users_model->company_get_accountinfo($id);
    			$data['company_accountinfo']=$result1;
    		}
    		catch (Exception $e) {
	  			//alert the user then kill the process
    			var_dump($e->getMessage());
    		}

    	}


    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('companyprofile');
    	$this->load->view('companyaccounts',$data);
    	$this->load->view('footer');
    }


    public function chequeaccounts(){


    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$prop_id =$_GET['cheque_status'];
    	
    	$is_page=0;
    	$total_rowcount=0;
    	$id=1;

    	try{


    		$this->load->model("Users_model");
    		$result_count= ($prop_id==1) ? $this->Users_model->company_get_cheque_paid_count($id) : $this->Users_model->company_get_cheque_unpaid_count($id);
    		
    		
    		if($result_count > 20){
    			$is_page=1;
    			$total_rowcount=$result_count;
    		}

    	}

    	catch (Exception $e) {
  			//alert the user then kill the process
    		var_dump($e->getMessage());
    	}


    	if ($is_page) {

    		$this->load->library('pagination');
    		$config['base_url'] = base_url().'index.php/users/chequeaccounts';
    		$config['total_rows'] = $total_rowcount;
    		$config['per_page'] = 20;
    		$config["uri_segment"] = 3;
    		$choice = $config["total_rows"] / $config["per_page"];
    		$config["num_links"] = round($choice);
    		$config['use_page_numbers'] = TRUE;
    		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    		$config['full_tag_close'] = '</ul>';
    		$config['num_tag_open'] = '<li>';
    		$config['num_tag_close'] = '</li>';
    		$config['cur_tag_open'] = '<li class="active"><span>';
    		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    		$config['prev_tag_open'] = '<li>';
    		$config['prev_tag_close'] = '</li>';
    		$config['next_tag_open'] = '<li>';
    		$config['next_tag_close'] = '</li>';
    		$config['first_link'] = '&laquo;';
    		$config['prev_link'] = '&lsaquo;';
    		$config['last_link'] = '&raquo;';
    		$config['next_link'] = '&rsaquo;';
    		$config['first_tag_open'] = '<li>';
    		$config['first_tag_close'] = '</li>';
    		$config['last_tag_open'] = '<li>';
    		$config['last_tag_close'] = '</li>';

    		$this->pagination->initialize($config); 		

    		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 1;


    		try{
    			$id=1;
    			$this->load->model("Users_model");
    			$result1= ($prop_id==1) ? $this->Users_model->company_get_cheque_paid_pagination($id,$config['per_page'],$page) : $this->Users_model->company_get_cheque_unpaid_pagination($id,$config['per_page'],$page);
    			$data['company_cheque_data']=$result1;
    			$data["links"] = $this->pagination->create_links();
    		}
    		catch (Exception $e) {
	  			//alert the user then kill the process
    			var_dump($e->getMessage());
    		}

    	}else{

    		try{
    			$id=1;
    			$this->load->model("Users_model");
    			$result1= ($prop_id==1) ? $this->Users_model->company_get_cheque_paid($id) : $this->Users_model->company_get_cheque_unpaid($id) ;
    			$data['company_cheque_data']=$result1;
    			$data["links"] = "";
    		}
    		catch (Exception $e) {
	  			//alert the user then kill the process
    			var_dump($e->getMessage());
    		}

    	}

    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('chequeprofile');
    	if ($prop_id==1) {
    		$this->load->view('chequebook_paid',$data);
    	} else {
    		$this->load->view('chequebook_unpaid',$data);
    	}    	
    	$this->load->view('footer');


    }

    public function rooms()
    {

    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	try{

    		$this->load->model("Users_model");
    		$result= $this->Users_model->view_rooms();
    		$data['booked_rooms']=$result;		        	
    	}

    	catch (Exception $e) {
  		//alert the user then kill the process
    		var_dump($e->getMessage());
    	}

    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('viewrooms',$data);
    	$this->load->view('footer');
    }



    public function insertcompany_account()
    {
    	if($_POST){

    		$id=1;
    		$this->load->model("Users_model");
    		$result= $this->Users_model->addcompany_accountinfo($id);

    		if(! $result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";
    		}else{

    			$str='users/accounts';

    			redirect($str,'refresh');
    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function insertcheque_account()
    {
    	if($_POST){

    		$prop_id =$_GET['cheque_status'];

    		$id=1;
    		$this->load->model("Users_model");
    		$result= $this->Users_model->addcompany_chequeinfo($id,"");

    		if(! $result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";
    		}else{

    			$str='users/chequeaccounts?cheque_status='.$prop_id;
    			redirect($str,'refresh');
    		}

    	}else{

    		redirect('users/login');
    	}

    }

    public function updatestatus_unpaidtopaid(){

    	if($_POST){

    		$prop_id =$_GET['cheque_status'];

    		$id=1;
    		$this->load->model("Users_model");
    		
    		$result= $this->Users_model->updatestatus_unpaidtopaid($id);

    		if(! $result){
	            // If user did not validate, then show them login page again
	           // $msg = '<font color=red>Invalid username and/or password.</font><br />';
	            //$this->login($msg);
    			echo "failed";
    		}else{

    			$str='users/chequeaccounts?cheque_status='.$prop_id;
    			redirect($str,'refresh');
    		}

    	}else{

    		redirect('users/login');
    	}



    }

    public function search($searchdata=null)
    {
    	if(! $this->session->userdata('validated')){
    		redirect('users/login');
    	}

    	$data['searchdata']=$searchdata;

    	$this->load->helper('url');
    	$this->load->view('header');
    	$this->load->view('search',$data);
    	$this->load->view('footer');
    }

    public function searchguestinfo()
    {

    	try{

    		if($_POST){

    			$this->load->model("Users_model");
    			$result= $this->Users_model->search();
    			$data['search_results']=$result;

    			$this->search($result);       	
    		}else{

    			redirect('users/login');
    		}

    	}

    	catch (Exception $e) {
  		//alert the user then kill the process
    		var_dump($e->getMessage());
    	}


    }

    public function getAllRoomsAvailableToday()
    {

      if(! $this->session->userdata('validated')){
            redirect('users/login');
        }

        try{

            $this->load->model("Users_model");
            $result= $this->Users_model->getcurrentlyavailable_rooms();
            
            $currRooms=array("R-001","R-002","R-101","R-103","R-104","R-105","R-106","R-107","R-108","R-109");
            if ($result=='no_result') {
                $result=$currRooms;
            }else{
                $arrayName = array();
                foreach ($result as $value) {
                   array_push($arrayName, $value['guest_room']);
                }

                $result=array_diff($currRooms,$arrayName);

            }
            

            $data['current_rooms']=$result;                  
        }

        catch (Exception $e) {
        //alert the user then kill the process
            var_dump($e->getMessage());
        }

        
        $this->load->view('getcurrentrooms',$data);
        

    }

/*
move this logic to a new project
	public function admin_mainpage()
	{
		if(! $this->session->userdata('validated')){
            redirect('users/login');
        }


        if ($this->session->userdata('role')!=3) {
        	redirect('users/login');
        }



        //$data['searchdata']=$searchdata;

		$this->load->helper('url');
		$this->load->view('header');
		$this->load->view('expiry');
		$this->load->view('footer');
	}
*/
	
}

