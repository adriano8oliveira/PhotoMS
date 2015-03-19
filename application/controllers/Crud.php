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
			'titulo'=> 'PhotoMS',
			'tela'=>'',
		);
		$this->load->view('telas', $dados);
	}
	
	
	public function create(){
		//Valida Formulario
		$this->form_validation->set_rules('usuario','CAMPO USUARIO','trim|required|max_length[25]|strtolower|is_unique[USUARIO.Usuario]');
		$this->form_validation->set_rules('senha','CAMPO SENHA','trim|required|strtolower');
		$this->form_validation->set_message('is_unique','JA ESTA CADASTRADO'); //cria mensagem de erro se nao for unico
		$this->form_validation->set_rules('tipo_usuario','TIPO USUARIO','trim|required|max_length[1]|numeric');
		//status não esta passando pela validação porque não quiz colocar
		if ($this->form_validation->run()==TRUE): 
			$dados = elements(array('usuario', 'senha', 'tipo_usuario', 'status'), $this->input->post());
			$dados['senha'] = md5($dados['senha']);
			$this->crud_model->do_insert($dados);
		endif;
		
		$dados = array(
				'titulo'=> 'Cadastrar',
				'tela'=>'create',
		);
		$this->load->view('telas', $dados);
	}
	
	
	public function retrieve(){
		$dados = array(
				'titulo'=> 'Visualizar',
				'tela'=>'retrieve',
				'usuarios' => $this->crud_model->get_all()->result(),
		);
		$this->load->view('telas', $dados);
	}
	
	/**********************************************************************/
	public function update(){
		//valida磯 do form
		$this->form_validation->set_rules('tipo_usuario','TIPO_USUARIO','trim|required|max_length[1]|numeric');
		
		if ($this->form_validation->run()==TRUE):
		$dados = elements(array('usuario', 'senha', 'tipo_usuario'), $this->input->post());
		$dados['senha'] = md5($dados['senha']);
		$this->crud_model->do_update($dados, array('ID_Usuario'=>$this->input->post('idusuario')));
		endif;
		
		$dados = array(
				'titulo'=> 'Alterar',
				'tela'=>'update',
		);
		$this->load->view('telas', $dados);
	}
	/*********************************************************************************/
	
	public function delete(){
		
		if ($this->input->post('idusuario')>0) :
			$this->crud_model->do_delete(array('ID_Usuario'=>$this->input->post('idusuario')));
		endif;
		
		$dados = array(
				'titulo'=> 'Deletar',
				'tela'=>'delete',
		);
		$this->load->view('telas', $dados);
	}
}