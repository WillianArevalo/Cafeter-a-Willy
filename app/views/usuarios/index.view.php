<main class="main-admin">
    <div class="usuarios-container">
        <div class="usuarios-container__title">
            <h1>Usuarios</h1>
            <a href="<?php echo url("/usuarios/nuevo") ?>" class="btn btn-info add-user">
                <?php echo icon("add-01") ?>
                Agregar nuevo usuario
            </a>
        </div>
        <div class="container-search">
            <div class="col form-group icon">
                <span>
                    <?php echo icon("search") ?>
                </span>
                <input type="text" class="form-control search-input" data-id-table="tabla-usuarios"
                    placeholder="Buscar categoría">
            </div>
        </div>
        <div class="table">
            <table id="tabla-usuarios">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Nombre de usuario</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="tbody-usuarios">
                    <?php
                    if ($usuarios != null) :
                        foreach ($usuarios as $usuario) :
                    ?>
                    <tr>
                        <td><?php echo $usuario["id"] ?></td>
                        <td>
                            <img src="<?php echo ($usuario["imagen"] == null) ? asset("img", "sin-imagen.jpg") : asset("img/usuarios", $usuario["imagen"]) ?>"
                                alt="Imagen perfil" class="main-image">
                        </td>
                        <td><?php echo $usuario["username"] ?></td>
                        <td><?php echo $usuario["email"] ?></td>
                        <td><?php echo $usuario["direccion"] ?></td>
                        <td><?php echo ($usuario["rol"] == "admin") ? "Administrador" : "Usuario" ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo url("/usuarios/editar/" . $usuario["id"]) ?>"
                                    data-id="<?php echo $usuario["id"] ?>" class="btn btn-edit edit-user">
                                    Editar
                                    <?php echo icon("pencil-edit-02") ?>
                                </a>
                                <button data-id="<?php echo $usuario["id"] ?>" class="btn btn-danger delete-user"
                                    data-url="<?php echo url("/usuarios/eliminar") ?>">
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
                        <td colspan="5">No hay usuarios registradas</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div id="modal-image" class="modal">
        <span class="close" id="close-modal">
            <?php echo icon("cancel") ?>
        </span>
        <div class="image-container-modal" id="container-modal-image">
            <img class="modal-contenido" id="image-modal" />
        </div>
    </div>
</main>