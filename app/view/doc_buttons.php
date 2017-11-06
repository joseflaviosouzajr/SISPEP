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
        <button type="button" name="saveDoc">Salvar</button>
    </li>
    <li>
        <button type="button" name="cancelDoc">Cancelar</button>
    </li>
    <li>
        <button type="button" name="excDoc">Excluir</button>
    </li>
</ul>