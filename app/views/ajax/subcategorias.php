<?php

function getSubcategories($subcategorias)
{
    ob_start();
    if ($subcategorias != null) :
?>
<div class="subcategorias">
    <?php
            foreach ($subcategorias as $subcategoria) :
            ?>
    <div class="subcategoria">
        <div class="subcategoria__imagen">
            <img src="<?php echo asset("img/categorias", $subcategoria["imagen"]) ?>"
                alt="<?php echo $subcategoria["nombre"] ?>" class="main-image">
        </div>
        <div class="subcategoria__nombre"><?php echo $subcategoria["nombre"] ?></div>
        <div class="subcategoria__descripcion"><?php echo $subcategoria["descripcion"] ?>
        </div>
        <div class="btn-group">
            <a href="<?php echo url("/categorias/editar/" . $subcategoria["id"]) ?>" class="btn btn-edit">
                <?php echo icon("pencil-edit-02") ?>
            </a>
            <button data-id="<?php echo $subcategoria["id"] ?>" class="btn btn-danger delete-subcategory"
                data-url="<?php echo url("/categorias/eliminar") ?>">
                <?php echo icon("delete-02") ?>
            </button>
        </div>
    </div>
    <?php
            endforeach;
            ?>
</div>
<?php
    endif;
    $content = ob_get_clean();
    return $content;
}