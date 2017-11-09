<?php

//verifica se foi passado o formulário como parametro
if (is_null($form)){
    echo 'parametro de formulario incorreto.';
    exit();
}
?>

<ul class="buttons-doc">
    <li>
        <button type="button" name="nvDoc" onclick="novoDoc('<?php echo $form;?>')">Novo</button>
    </li>
    <li>
        <button type="button" name="saveDoc" onclick="salvaDoc('<?php echo $form;?>')">Salvar</button>
    </li>
    <li>
        <button type="button" name="cancelDoc" onclick="cancelaDoc('<?php echo $form;?>')">Cancelar</button>
    </li>
    <li>
        <button type="button" name="excDoc" onclick="excluiDoc('<?php echo $form;?>')">Excluir</button>
    </li>
</ul>