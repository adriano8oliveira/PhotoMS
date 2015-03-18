<?php 
echo form_open('crud/create');
echo validation_errors('<p>','</p>');//imprime os erros do formulario
if($this->session->flashdata('cadastrook')): 
	echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
endif;
echo form_label('Usuario');
echo form_input(array('name'=>'Usuario'),set_value('Usuario'),'autofocus');
echo form_label('Senha');
echo form_password(array('name'=>'Senha'),set_value('Senha'));
echo form_label('Tipo Usuario');
echo form_input(array('name'=>'Tipo_Usuario'),set_value('Tipo_Usuario'));
echo form_label('Status');
echo form_input(array('name'=>'Status'),set_value('Status'));
echo form_submit(array('name'=>'cadastrar', 'class' => 'btn'), 'Cadastrar');
echo form_close(); 
?>
