<?php 

echo'<h2>Lista de Usuarios</h2>';

if($this->session->flashdata('excluirok')):
echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

if($this->session->flashdata('cadastrook')):
echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
endif;

$this->table->set_heading('ID', 'Usuario', 'Tipo Usuario'); 

foreach ($usuarios as $linha):
	$this->table->add_row($linha->ID_Usuario, $linha->Usuario, $linha->Tipo_Usuario, anchor("crud/update/$linha->ID_Usuario", 'Editar '). ' | ' . anchor("crud/delete/$linha->ID_Usuario", ' Excluir'));
endforeach;

echo $this->table->generate();