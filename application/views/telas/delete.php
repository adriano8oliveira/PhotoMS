<?php 

$idUser = $this->uri->segment(3);
if ($idUser == NULL) redirect('crud/retrieve');

$query = $this->crud_model->get_byid($idUser)->row();
echo form_open("crud/delete/$idUser");

echo form_label('Usuario');
echo form_input(array('name'=>'usaurio'),set_value('Usuario', $query->Usuario), 'disable="disable"');
echo form_label('Tipo Usuario');
echo form_input(array('name'=>'tipo_usuario'),set_value('Tipo_Usuario', $query->Tipo_Usuario), 'disable="disable"');
echo form_hidden('idusuario', $query->ID_Usuario);
echo form_submit(array('name'=>'excluir'), 'Excluir');
echo form_close();