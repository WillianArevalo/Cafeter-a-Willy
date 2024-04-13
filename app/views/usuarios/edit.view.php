<main class="main-admin">
    <div class="container-nuevo-usuario">
        <h1>Editar usuario</h1>
        <form action="<?php echo url("/usuarios/actualizar") ?>" method="POST" class="form" id="form-usuario"
            enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo getToken(); ?>">
            <input type="hidden" name="id" value="<?php echo $usuario["id"] ?> ">
            <div class="row">
                <div class="col">
                    <div class="form-group label">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" value="<?php echo $usuario["username"] ?>" name="username" id="username"
                            placeholder="Ingrese el nombre de usuario" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group label">
                        <label for="email">Correo</label>
                        <input type="email" value="<?php echo $usuario["email"] ?>" name="email" id="email"
                            placeholder="Ingrese el correo" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group label">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Ingrese la contraseña" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group label">
                        <label for="password">Dirección</label>
                        <input type="text" value="<?php echo $usuario["direccion"] ?>" name="direccion" id="direccion"
                            placeholder="Ingrese la dirección del usuario" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group label">
                        <label for="password">Dirección</label>
                        <select name="rol" id="rol">
                            <option value="admin" <?php echo ($usuario["rol"] == "admin") ? "selected" : "" ?>>
                                Administrador</option>
                            <option value="usuario" <?php echo ($usuario["rol"] == "usuario") ? "selected" : "" ?>>
                                Usuario</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group label">
                        <label for="password">Imagen</label>
                        <button type="button" class="btn btn-info"
                            onclick="document.getElementById('imagen-usuario').click()">
                            <?php echo icon("image-add-01") ?>
                            Seleccionar imagen
                        </button>
                        <input type="file" id="imagen-usuario" name="imagen" class="hidden" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group label">
                        <label for="preview-image">Previsualización de la imagen: </label>
                        <div class="image-preview">
                            <img src="<?php echo ($usuario["imagen"] == null) ? asset("img", "sin-imagen.jpg") : asset("img/usuarios", $usuario["imagen"]) ?>"
                                alt="Imagen usuario" id="imagen-preview-usuario">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-edit m-auto mt-10">
                        <?php echo icon("pencil-edit-02") ?>
                        Editar usuario
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>


<script>
$(document).ready(function() {
    document.getElementById('imagen-usuario').addEventListener('change', function() {
        var archivo = this.files[0];
        if (archivo) {
            var lector = new FileReader();
            lector.onload = function(e) {
                var vistaPrevia = document.getElementById('imagen-preview-usuario');
                vistaPrevia.src = e.target.result;
            }
            lector.readAsDataURL(archivo);
        }
    });
});
</script>