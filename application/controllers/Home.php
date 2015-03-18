<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      
      $data = array(
      		'titulo'=> 'PhotoMS',
      		'tela'=> 'home',
      		'usuario' => $session_data['Usuario']
      );
      $this->load->view('crud_view', $data); 
    }
    else
    {
      //If no session, redirect to login page
      redirect('login', 'refresh');
	
	}
  }
  
	
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('login', 'refresh');
  }
}
?>