<?php if ( ! defined('BASEPATH')) exit('No Direct script acess allowed');
class Crud_model extends CI_Model{
	
	/*****************************************************AUTENTICA PARA LOGIN***********************************************/
	function autentica($usuario, $senha){
		$this -> db -> select('ID_Usuario, Usuario, Senha');
		$this -> db -> from('USUARIO');
		$this -> db -> where('Usuario = ' . "'" . $usuario . "'");
		$this -> db -> where('Senha = ' . "'" . MD5($senha) . "'");
		$this -> db -> limit(1);
	
		$query = $this -> db -> get();
	
		if($query -> num_rows() == 1) :
		return $query->result();
	
		else : return false;
		endif;
	}
	
	
	/*****************************************************INSERT***********************************************/
	public function do_insert($dados=NULL){
		
		if($dados != NULL):
			$this->db->insert('USUARIO', $dados);
			$this->session->set_flashdata('cadastrook', 'Cadastro efetuado com sucesso');
			redirect('crud/retrieve');
		endif;
	}
	
	
	/*****************************************************UPDATE***********************************************/
	public function do_update($dados=NULL, $condicao=NULL){
		if($dados != NULL && $condicao != NULL):
		$this->db->update('USUARIO', $dados, $condicao);
		$this->session->set_flashdata('edicaook', 'Altera磯 efetuada com sucesso');
		redirect(current_url());
		endif;
	}
	

	/*****************************************************DELETE***********************************************/
	public function do_delete($condicao=NULL){
		if($condicao != NULL) :
			$this->db->delete('USUARIO', $condicao);
			$this->session->set_flashdata('excluirok','excluido com sucesso');
			redirect('crud/retrieve');
		endif;
	}
	
	
	/*****************************************************MOSTRAR TUDO***********************************************/
	public function get_all(){
		return $this->db->get('USUARIO');
	}
	
	/*****************************************************PEGAR POR ID***********************************************/
	public function get_byid($id=NULL){
		if ($id!=NULL) :
			$this->db->where('ID_Usuario', $id);
			$this->db->limit(1);
			return $this->db->get('USUARIO');
		else :
			return FALSE;
		endif;
	}	
	
	
	
}