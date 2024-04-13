<?php


function getAlls($categorias)
{
    ob_start();
    if ($categorias != null) :
        foreach ($categorias as $categoria) :
?>
            <tr>
                <td><?php echo $categoria["id"] ?></td>
                <td>
                    <img src="<?php echo asset("img/categorias", $categoria["imagen"]) ?>" alt="<?php echo $categoria["nombre"] ?>" class="main-image">
                </td>
                <td><?php echo $categoria["nombre"] ?></td>
                <td><?php echo $categoria["descripcion"] ?></td>
                <td>
                    <div class="btn-group">

                        <?php

                        if ($categoria["id_categoria_padre"] != null) :
                        ?>
                            <button class="btn btn-info">
                                No tiene subcategorias
                            </button>
                        <?php
                        else :
                        ?>
                            <button data-id="<?php echo $categoria["id"] ?>" class="btn btn-info get-subcategories" data-url="<?php echo url("/categorias/subcategorias") ?>">
                                Ver subcategorias
                                <?php echo icon("arrow-right") ?>
                            </button>
                        <?php
                        endif;

                        ?>


                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?php echo url("/categorias/editar/" . $categoria["id"]) ?>" class="btn btn-edit">
                            Editar
                            <?php echo icon("pencil-edit-02") ?>
                        </a>
                        <button data-id="<?php echo $categoria["id"] ?>" class="btn btn-danger delete-category" data-url="<?php echo url("/categorias/eliminar") ?>">
                            Eliminar
                            <?php echo icon("delete-02") ?>
                        </button>
                    </div>
                </td>
            </tr>
        <?php
        endforeach;

    else : ?>
        <tr>
            <td colspan="5">No hay categorías registradas</td>
        </tr>
<?php
    endif;
    $content = ob_get_clean();
    return $content;
}


?>

<?php

?>