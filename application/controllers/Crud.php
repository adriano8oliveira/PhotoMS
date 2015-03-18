<?php if ( ! defined('BASEPATH')) exit('No Direct script acess allowed');

class Crud extends CI_Controller{
	
	//carrega o helper url
	public function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('array');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('table');
		$this->load->model('crud_model');
	}
	
	//primeiro metodo a carregar
	public function index(){
		$dados = array(
			'titulo'=> 'CRUD com CodIgniter',
			'tela'=>'',
		);
		$this->load->view('crud_view', $dados);
	}
	
	
	public function create(){
		//valida磯 do form
		$this->form_validation->set_rules('Usuario','USU','trim|required|max_length[25]|strtolower|is_unique[USUARIO.Usuario]');
		$this->form_validation->set_rules('Senha','SENHA','trim|required|strtolower');
		$this->form_validation->set_message('is_unique','Ja Esta cadastrado'); //cria mensagem de erro se nao for unico
		$this->form_validation->set_rules('Tipo_Usuario','TIPO_USUARIO','trim|required|max_length[1]|numeric');
		//status não esta passando pela validação porque não quiz colocar
		if ($this->form_validation->run()==TRUE): 
			$dados = elements(array('Usuario', 'Senha', 'Tipo_Usuario', 'Status'), $this->input->post());
			$dados['Senha'] = md5($dados['Senha']);
			$this->crud_model->do_insert($dados);
		endif;
		
		$dados = array(
				'titulo'=> 'CRUD &raquo; Create',
				'tela'=>'create',
		);
		$this->load->view('crud_view', $dados);
	}
	
	
	public function retrieve(){
		$dados = array(
				'titulo'=> 'CRUD &raquo; Retrieve',
				'tela'=>'retrieve',
				'usuarios' => $this->crud_model->get_all()->result(),
		);
		$this->load->view('crud_view', $dados);
	}
	
	/**********************************************************************/
	public function update(){
		//valida磯 do form
		$this->form_validation->set_rules('Tipo_Usuario','TIPO_USUARIO','trim|required|max_length[1]|numeric');
		
		if ($this->form_validation->run()==TRUE):
		$dados = elements(array('Usuario', 'Senha', 'Tipo_Usuario'), $this->input->post());
		$dados['Senha'] = md5($dados['Senha']);
		$this->crud_model->do_update($dados, array('ID_Usuario'=>$this->input->post('idusuario')));
		endif;
		
		$dados = array(
				'titulo'=> 'CRUD &raquo; Update',
				'tela'=>'update',
		);
		$this->load->view('crud_view', $dados);
	}
	/*********************************************************************************/
	
	public function delete(){
		
		if ($this->input->post('idusuario')>0) :
			$this->crud_model->do_delete(array('ID_Usuario'=>$this->input->post('idusuario')));
		endif;
		
		$dados = array(
				'titulo'=> 'CRUD &raquo; Delete',
				'tela'=>'delete',
		);
		$this->load->view('crud_view', $dados);
	}
}