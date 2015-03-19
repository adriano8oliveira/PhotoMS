<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autentica extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('crud_model','',TRUE);
  }

  function index()
  {
    //para validar os campos do formulario
    $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required'); //com |xss_clean não funciona
    $this->form_validation->set_rules('senha', 'Senha', 'trim|required|callback_check_database');
	  
	
    if($this->form_validation->run() == FALSE)
    {
      //se falhar a validação de campo ou o checkdatabase que consulta o metodo autentica do banco manda o cara para tela de login 
      $this->load->view('login');
    }
    else
    {
	//se não falhar acima verifica se existe a sessão abaixo se existir a sessão manda para home passando o dado Usuario da sassão para o array para view	
	if($this->session->userdata('logado'))
    {
      $session_data = $this->session->userdata('logado');
      
      $data = array(
      		'titulo'=> 'PhotoMS',
      		'tela'=> 'home',
      		'usuario' => $session_data['Usuario']
      );
      $this->load->view('telas', $data); 
    }
    else
    {
      //If no session, redirect to login page
      $this->load->view('login'); 
	
	}

		
    }
    
  }
  

  function check_database($senha)
  {
    //ao passar a validação de campo, valida no banco
    $usuario = $this->input->post('usuario');
   
    //chama função para validar no usuario e senha no banco de dados
    $result = $this->crud_model->autentica($usuario, $senha);
     
    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'ID_Usuario' => $row->ID_Usuario,
          'Usuario' => $row->Usuario
        );
        $this->session->set_userdata('logado', $sess_array);
      }
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Dados Invalidos');
      return false;
    }
  }
	
	
	function logout()
	  {
		$this->session->unset_userdata('logado');
		session_destroy();
		$this->load->view('login'); 
	  }
	
	
	
}
?>