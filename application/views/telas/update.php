<?php

$idUser = $this->uri->segment(3);

if ($idUser == NULL) redirect('crud/retrieve');

$query = $this->crud_model->get_byid($idUser)->row();

echo form_open("crud/update/$idUser");
echo validation_errors('<p>','</p>');//imprime os erros do formulario

if($this->session->flashdata('edicaook')):
echo '<p>'.$this->session_flashdata('edicaook').'</p>';
endif;

echo form_label('Usuario');
echo form_input(array('name'=>'usuario'),set_value('USU', $query->Usuario));
echo form_label('Senha');
echo form_password(array('name'=>'senha'),set_value('SEN'));
echo form_label('Tipo Usuario');
echo form_input(array('name'=>'Tipo_Usuario'),set_value('Tipo_Usuario', $query->Tipo_Usuario));
echo form_hidden('idusuario', $query->ID_Usuario);
echo form_submit(array('name'=>'cadastrar'), 'Atualizar Dados');
echo form_close();