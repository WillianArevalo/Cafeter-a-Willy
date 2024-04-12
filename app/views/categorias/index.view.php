<main class="main-admin">
    <section class="categorias-container">
        <div class="categorias-container__title">
            <h1>Categorías</h1>
            <a href="<?php echo url("/categorias/nueva") ?>">
                <?php echo icon("add-01") ?>
                Agregar nueva categoría
            </a>
        </div>
        <div class="categorias__table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($categorias != null) :
                        foreach ($categorias as $categoria) :
                    ?>
                    <tr>
                        <td><?php echo $categoria["id"] ?></td>
                        <td>
                            <img src="<?php echo asset("img/categorias", $categoria["imagen"]) ?>"
                                alt="<?php echo $categoria["nombre"] ?>" class="main-image">
                        </td>
                        <td><?php echo $categoria["nombre"] ?></td>
                        <td><?php echo $categoria["descripcion"] ?></td>
                        <td>
                            <div class="buttons-table">
                                <a href="<?php echo url("/categorias/editar/" . $categoria["id"]) ?>" class="edit">
                                    Editar
                                    <?php echo icon("pencil-edit-02") ?>
                                </a>
                                <button data-id="<?php echo $categoria["id"] ?>" class="delete delete-category"
                                    data-url="<?php echo url("/categorias/eliminar") ?>">
                                    Eliminar
                                    <?php echo icon("delete-02") ?>
                                </button>
                                <?php
                                        if ($categoria["id_categoria_padre"] == null) :
                                        ?>
                                <a href="<?php echo url("/categorias/subcategorias/" . $categoria["id"]) ?>"
                                    class="edit">
                                    Subcategorías
                                    <?php echo icon("arrow-right") ?>
                                </a>
                                <?php
                                        endif;
                                        ?>
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
                    ?>
                </tbody>
            </table>
        </div>
    </section>


    <div id="modal-image" class="modal">
        <span class="close" id="close-modal">
            <?php echo icon("cancel") ?>
        </span>
        <div class="image-container-modal" id="container-modal-image">
            <img class="modal-contenido" id="image-modal" />
        </div>
    </div>
</main>