<?php

class Users_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    
    public function insertguestinfo(){

        $this->load->helper('date');
        // grab user input
        $name = $this->security->xss_clean($this->input->post('guest-name'));
        $city = $this->security->xss_clean($this->input->post('city-name'));
        $cnic = $this->security->xss_clean($this->input->post('cnic-no'));
        $phone = $this->security->xss_clean($this->input->post('phone-no'));
        $purpose = $this->security->xss_clean($this->input->post('visit-purpose'));
        $company = $this->security->xss_clean($this->input->post('company-name'));
        $country = $this->security->xss_clean($this->input->post('country-name'));
        $personal = $this->security->xss_clean($this->input->post('personal-info'));       
        $address = $this->security->xss_clean($this->input->post('address-no'));
        $time=time();        

        $data = array(
            'guest_name' => $name ,
            'guest_city' => $city ,
            'guest_cnic' => $cnic ,
            'guest_address' => $address ,
            'guest_phone' => $phone ,
            'guest_purpose' => $purpose ,
            'guest_company' => $company ,
            'guest_country' => $country ,
            'guest_info' => $personal ,
            'guest_timestamp' => $time
            );

        
        $this->db->trans_start();
        $this->db->insert('guests', $data); 
        $table1_id = $this->db->insert_id();

        
        $this->db->trans_complete(); 

        if ($this->db->trans_status() === TRUE)
        {
            return $table1_id;
        }
        
        
        return false;
    }

    public function updateguestinfo(){


        $this->load->helper('date');
        // grab user input
        
        $guest_id = $this->security->xss_clean($this->input->post('up-guest-id'));
        $name = $this->security->xss_clean($this->input->post('up-guest-name'));
        $city = $this->security->xss_clean($this->input->post('up-city-name'));
        $cnic = $this->security->xss_clean($this->input->post('up-cnic-no'));
        $phone = $this->security->xss_clean($this->input->post('up-phone-no'));
        $purpose = $this->security->xss_clean($this->input->post('up-visit-purpose'));
        $company = $this->security->xss_clean($this->input->post('up-company-name'));
        $country = $this->security->xss_clean($this->input->post('up-country-name'));
        $personal = $this->security->xss_clean($this->input->post('up-personal-info'));       
        $address = $this->security->xss_clean($this->input->post('up-address-no'));
        $time=time();        

        $data = array(
            'guest_name' => $name ,
            'guest_city' => $city ,
            'guest_cnic' => $cnic ,
            'guest_address' => $address ,
            'guest_phone' => $phone ,
            'guest_purpose' => $purpose ,
            'guest_company' => $company ,
            'guest_country' => $country ,
            'guest_info' => $personal ,
            'guest_timestamp' => $time
            );

        
        $this->db->trans_start();
        $this->db->where('guest_id', $guest_id);
        $this->db->update('guests', $data);        

        
        $this->db->trans_complete(); 

        if ($this->db->trans_status() === TRUE)
        {
            return $guest_id;
        }
        
        
        return false;
    }

    public function insertroomday(){

        $this->load->helper('date');
        // grab user input
        $arrival = $this->security->xss_clean($this->input->post('arrival'));
        $departure = $this->security->xss_clean($this->input->post('dept'));
        $room = $this->security->xss_clean($this->input->post('room-no'));
        $gid = $this->security->xss_clean($this->input->post('g_id'));
        
        $msg_error='';

        if ($arrival==null || $arrival=="") {
            $msg = '<div class="alert alert-danger" role="alert">Invalid username and/or password.</div>';
            $msg_error='<div class="alert alert-danger" role="alert">Error! Enter Arrival Date</div>';
            $data['msg_error']=$msg_error;
            $data['guest_id']=$gid;
            return $data;
        }
        
        if ($departure==null || $departure=="") {
            $msg_error='<div class="alert alert-danger" role="alert">Error! Enter Departure Date</div>';
            $data['msg_error']=$msg_error;
            $data['guest_id']=$gid;
            return $data;
        }

        if ($room==null || $room=="") {
            $msg_error='<div class="alert alert-danger" role="alert">Error! Select Room(s)</div>';
            $data['msg_error']=$msg_error;
            $data['guest_id']=$gid;
            return $data;
        }
        
        $this->db->trans_start();  

        $exp_room = explode(",",$room);   

        $this->db->where('arrival_time <', $departure);
        $this->db->where('dept_time >', $arrival);
        $this->db->where_in('guest_room', $exp_room );
        $query = $this->db->get('guests_time_room');
        

        $count =  $query->row();         
        if ($count) {
            $msg_error= '<div class="alert alert-danger" role="alert">The room '.$count->guest_room.' is already booked</div>';
            $data['msg_error']=$msg_error;
            $data['guest_id']=$gid;
            return $data;
            
        }

//SELECT * FROM `guests_time_room` WHERE guest_room IN ('R-101','R-002')
//SELECT * FROM NATURAL JOIN(`guests_time_room`) WHERE `arrival_time` > 2014-09-12 AND `dept_time` > 2014-09-10 AND `guest_room` IN ('R-002','R-101')

        $this->db->where('guest_id', $gid);
        $this->db->delete('guests_time_room'); 

        foreach ($exp_room as $value) {

            $data1 = array(
                'guest_id' => $gid ,
                'arrival_time' => $arrival ,
                'dept_time' => $departure ,
                'guest_room' => $value
                );
            
            $this->db->insert('guests_time_room', $data1); 

        }

        $this->db->trans_complete(); 

        if ($this->db->trans_status() === TRUE)
        {
            return true;
        }
        
        
        return false;
    }

    public function view_rooms(){
        // grab user input
       $today = date('Y-m-d');


       $this->db->where('dept_time >', $today);        
        // Run the query
       $this->db->order_by('guest_room'); 
       $query = $this->db->get('guests_time_room');

        // Let's check if there are any results
       if($query->num_rows > 0)
       {
            //var_dump($query->result_array());
            //die();
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

  public function getcurrentlyavailable_rooms(){
        // grab user input
       $today = date('Y-m-d');


       $this->db->where('dept_time >', $today);        
        // Run the query
       $this->db->order_by('guest_room'); 
       $query = $this->db->get('guests_time_room');

        // Let's check if there are any results
       if($query->num_rows > 0)
       {
            //var_dump($query->result_array());
            //die();
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function search(){
        // grab user input
    $search_query = $this->security->xss_clean($this->input->post('search-info'));

        // Prep the query
    $this->db->like('guest_cnic', $search_query);
    $this->db->or_like('guest_name', $search_query); 
    $this->db->or_like('guest_phone', $search_query); 
    $this->db->or_like('guest_company', $search_query); 

        // Run the query
    $query = $this->db->get('guests');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }
        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function validate(){
        // grab user input
    $username = $this->security->xss_clean($this->input->post('email'));
    $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query
    $this->db->where('email', $username);
    $this->db->where('password', $password);

        // Run the query
    $query = $this->db->get('users');

        // Let's check if there are any results
    if($query->num_rows == 1)
    {
            // If there is a user, then create session data
        $row = $query->row();
        $data = array(
            'userid' => $row->user_id,
            'role' => $row->role,
            'email' => $row->email,
            'validated' => true
            );
        $this->session->set_userdata($data);
        return true;
    }
        // If the previous process did not validate
        // then return false.
    return false;
}


public function viewguest($id){
        // grab user input

    $this->db->where('guest_id', $id);

        // Run the query
    $query = $this->db->get('guests');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function guest_room_date($id){
        // grab user input

    $this->db->where('guest_id', $id);

        // Run the query
    $query = $this->db->get('guests_time_room');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}


public function guest_get_accountinfo($id){
        // grab user input

    $this->db->where('guest_id', $id);
    $this->db->order_by("guest_date", "asc"); 

        // Run the query
    $query = $this->db->get('guests_accounts');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_accountinfo_test($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 

        // Run the query
    $query = $this->db->get('company_accounts');



        // Let's check if there are any results
    if($query->num_rows > 0)
    {

        $res=$query->result_array();
            //var_dump($res);
        $balance=0;



        foreach ($res as $r) {

                //echo ($r['account_index']);
            $cred= $r['company_credit'];
            $debt= $r['company_debit'];
            $cal=$cred-$debt;

            $balance=$balance+$cal;

            $q='UPDATE company_accounts SET company_balance ='.$balance.' WHERE account_index='.$r['account_index'];
            $this->db->query($q);

            echo $q;

                //echo $balance;
                //echo '<br/>';

                //die();
        }



    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_accountinfo($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 

        // Run the query
    $query = $this->db->get('company_accounts');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_cheque_paid($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 

        // Run the query
    $query = $this->db->get('company_cheque_paid');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_cheque_unpaid($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 
    
        // Run the query
    $query = $this->db->get('company_cheque_unpaid');
    
        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }
    
        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_accountinfo_pagination($id,$per_page,$page){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("account_index", "asc"); 
    $this->db->limit($per_page, ($page-1)*$per_page);

        // Run the query
    $query = $this->db->get('company_accounts');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_cheque_paid_pagination($id,$per_page,$page){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("cheque_index", "asc"); 
    $this->db->limit($per_page, ($page-1)*$per_page);

        // Run the query
    $query = $this->db->get('company_cheque_paid');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_cheque_unpaid_pagination($id,$per_page,$page){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("cheque_index", "asc"); 
    $this->db->limit($per_page, ($page-1)*$per_page);

        // Run the query
    $query = $this->db->get('company_cheque_unpaid');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->result_array();
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result='no_result';
    return $no_result;
}

public function company_get_accountinfo_count($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 

        // Run the query
    $query = $this->db->get('company_accounts');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->num_rows;
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result=0;
    return $no_result;
}

public function company_get_cheque_paid_count($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 

        // Run the query
    $query = $this->db->get('company_cheque_paid');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->num_rows;
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result=0;
    return $no_result;
}

public function company_get_cheque_unpaid_count($id){
        // grab user input

    $this->db->where('company_id', $id);
    $this->db->order_by("company_date", "asc"); 

        // Run the query
    $query = $this->db->get('company_cheque_unpaid');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        return $query->num_rows;
    }

        //If the output query has no result then send a string to show that no data is found.
    $no_result=0;
    return $no_result;
}

public function addcompany_accountinfo($id){
        // grab user input

    $company_id = $id;
    $currDate = $this->security->xss_clean($this->input->post('curr'));
    $remarks = $this->security->xss_clean($this->input->post('remarks'));
    $amount_type = $this->security->xss_clean($this->input->post('amount'));
    $price = $this->security->xss_clean($this->input->post('price'));


    $creditamount=0.00;
    $debitamount=0.00;
    $balance=0.00;

        //get latest balance
    $this->db->order_by("account_index", "desc"); 
    $this->db->limit(1);        
        // Run the query
    $query = $this->db->get('company_accounts');

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        $r=$query->result_array();
        $balance=$r[0]['company_balance'];
    }else{

        $balance=0.00;
    }

    $balance=$balance+0.00;

    if ($amount_type=="Credit") {
        $creditamount=$price;
        $debitamount=0.00;
        $balance=$balance+$creditamount;

    }else{
        $creditamount=0.00;
        $debitamount=$price;
        $balance=$balance-$debitamount;
    }


    $data = array(
        'company_id' => $company_id ,
        'company_credit' => $creditamount ,
        'company_debit' => $debitamount ,
        'company_date' => $currDate ,
        'company_remarks' => $remarks,
        'company_balance'=>$balance         
        );


    $this->db->trans_start();

    $this->db->insert('company_accounts', $data); 

    $this->db->trans_complete(); 

    if ($this->db->trans_status() === TRUE)
    {
        return true;
    }

    return false;

}



public function addcompany_chequeinfo($id,$dataArray){
        // grab user input
    //var_dump($dataArray);

    $company_id = $id;
    $amount_type="";

    $from = ($dataArray=="") ? $this->security->xss_clean($this->input->post('from')) : $dataArray[0]['cheque_from'];
    $currDate = $this->security->xss_clean($this->input->post('curr'));
    $cheque_no =($dataArray=="") ?  $this->security->xss_clean($this->input->post('cheque-no')): $dataArray[0]['cheque_number'];
    $cheque_date =($dataArray=="") ?  $this->security->xss_clean($this->input->post('cheque-date')): $dataArray[0]['cheque_date'];
    $bank_name = ($dataArray=="") ? $this->security->xss_clean($this->input->post('bank')): $dataArray[0]['cheque_bank'];
    if ($dataArray=="") {
        $amount_type =$this->security->xss_clean($this->input->post('amount'));
    }else{
        if($dataArray[0]['cheque_credit'] == 0){
            $amount_type= "Debit";
        }else{
            $amount_type="Credit";
        }
    }
    $status = ($dataArray=="") ? $this->security->xss_clean($this->input->post('status')): $dataArray[0]['cheque_status'];
    $price = ($dataArray=="") ? $this->security->xss_clean($this->input->post('price')): ($dataArray[0]['cheque_credit'] + $dataArray[0]['cheque_debit']);

    $creditamount=0.00;
    $debitamount=0.00;
    $balance=0.00;

        //get latest balance
    $this->db->order_by("cheque_index", "desc"); 
    $this->db->limit(1);        
        // Run the query

    if($status=="Paid"){
        $status=1;
        $query = $this->db->get('company_cheque_paid');
    }else{
        $status=0;
        $query = $this->db->get('company_cheque_unpaid');
    }        

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        $r=$query->result_array();
        $balance=$r[0]['cheque_balance'];
    }else{

        $balance=0.00;
    }

    $balance=$balance+0.00;

    if ($amount_type=="Credit") {
        $creditamount=$price;
        $debitamount=0.00;
        $balance=$balance+$creditamount;

    }else{
        $creditamount=0.00;
        $debitamount=$price;
        $balance=$balance-$debitamount;
    }


    $data = array(
        'company_id' => $company_id ,
        'cheque_from' => $from ,
        'cheque_number' => $cheque_no ,
        'company_date' => $currDate ,
        'cheque_date' => $cheque_date ,
        'cheque_credit' => $creditamount ,
        'cheque_debit' => $debitamount ,
        'company_date' => $currDate ,
        'cheque_balance'=>$balance,
        'cheque_bank'=>$bank_name,
        'cheque_status'=>$status
        );


    $this->db->trans_start();

    if($status==1){
        $this->db->insert('company_cheque_paid', $data); 
    }else{
        $this->db->insert('company_cheque_unpaid', $data);             
    }     



    $this->db->trans_complete(); 

    if ($this->db->trans_status() === TRUE)
    {
        return true;
    }

    return false;

}


public function updatestatus_unpaidtopaid($id){
        // grab user input

    $company_id = $id;
    $chq_index = $this->security->xss_clean($this->input->post('chq_index_val'));
    

    $this->db->trans_start();

    $this->db->where('cheque_index', $chq_index);
    // Run the query
    $query = $this->db->get('company_cheque_unpaid'); 

        // Let's check if there are any results
    if($query->num_rows > 0)
    {
        $r=$query->result_array();
        $r[0]['cheque_status']="Paid";
        $this->Users_model->addcompany_chequeinfo($id,$r);

        $this->db->where('cheque_index', $chq_index);
        $this->db->delete('company_cheque_unpaid'); 
        
    }

    $this->db->trans_complete(); 

    if ($this->db->trans_status() === TRUE)
    {
        return true;
    }

    return false;

}


public function addguest_accountinfo(){
        // grab user input

    $guest_id = $this->security->xss_clean($this->input->post('guest_id'));
    $currDate = $this->security->xss_clean($this->input->post('curr'));
    $remarks = $this->security->xss_clean($this->input->post('remarks'));
    $amount_type = $this->security->xss_clean($this->input->post('amount'));
    $price = $this->security->xss_clean($this->input->post('price'));


    $creditamount=0.00;
    $debitamount=0.00;
    if ($amount_type=="Credit") {
        $creditamount=$price;
        $debitamount=0.00;
    }else{
        $creditamount=0.00;
        $debitamount=$price;
    }


    $info_date = getdate();

    $data = array(
        'guest_id' => $guest_id ,
        'guest_credit' => $creditamount ,
        'guest_debit' => $debitamount ,
        'guest_date' => $currDate ,
        'guest_remarks' => $remarks         
        );


    $this->db->trans_start();

    $this->db->insert('guests_accounts', $data); 

    $this->db->trans_complete(); 

    if ($this->db->trans_status() === TRUE)
    {
        return true;
    }

    return false;

}

public function verify_macid($mac){


    $this->db->where('mac_address', $mac);
        //$this->db->where('is_activated', true);

        // Run the query
    $query = $this->db->get('user_macaddress');


        // Let's check if there are any results
    if($query->num_rows > 0)
    {
     $this->db->where('is_activated', true);
     $query3 = $this->db->get('user_macaddress');

     if($query3->num_rows > 0)
     {
        return "exists";
    }

    $today = date('Y-m-d');           
    $this->db->where('date_expiry <', $today); 

            // Run the query
    $query1 = $this->db->get('user_macaddress');

    if($query1->num_rows > 0)
    {
        return "expired";
    }
    else{
        return "exists";
    }

}


else{
    $no_result='false';

    return $no_result;
}

        //If the output query has no result then send a string to show that no data is found.

}



}
?>