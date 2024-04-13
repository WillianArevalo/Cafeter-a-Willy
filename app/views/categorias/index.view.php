<main class="main-admin">
    <section class="categorias-container">
        <div class="categorias-container__title">
            <h1>Categorías</h1>
            <a href="<?php echo url("/categorias/nueva") ?>" class="btn btn-info">
                <?php echo icon("add-01") ?>
                Agregar nueva categoría
            </a>
        </div>

        <div class="container-search">
            <div class="col form-group icon">
                <span>
                    <?php echo icon("search") ?>
                </span>
                <input type="text" id="search" class="form-control" placeholder="Buscar categoría">
            </div>
            <div class="col btn-group">
                <button class="btn btn-info button-search" id="search-category" data-filter="all" data-url="<?php echo url("/categorias/filtrar") ?>">
                    Todas
                </button>
                <button class="btn btn-info button-search" id="all-categories" data-filter="categorys" data-url="<?php echo url("/categorias/filtrar") ?>">
                    Principales
                </button>
                <button class="btn btn-info button-search" id="all-categories" data-filter="subcategorys" data-url="<?php echo url("/categorias/filtrar") ?>">
                    Subcategorias
                </button>
            </div>
        </div>

        <div class="table">
            <table id="tabla-categorias">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Subcategorias</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="tbody-categorias">
                    <?php
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
                                        <button data-id="<?php echo $categoria["id"] ?>" class="btn btn-info get-subcategories" data-url="<?php echo url("/categorias/subcategorias") ?>">
                                            Ver subcategorias
                                            <?php echo icon("arrow-right") ?>
                                        </button>
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