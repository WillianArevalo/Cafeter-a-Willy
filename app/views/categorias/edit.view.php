<main class="main-admin">
    <div class="categorias-nueva">
        <h1>Editar categoría</h1>
        <div class="categoria-nueva__form">
            <div class="categoria-nueva__tipo">
                <label for="tipo categoria">Tipo de categoría</label>
                <div class="custom-select">
                    <div class="custom-select__content">
                        <div class="select-selected">Categoría principal</div>
                        <div class="icon-select">
                            <?php echo icon("arrow-down") ?>
                        </div>
                    </div>
                    <div class="select-items select-hide">
                        <div>Categoría principal</div>
                        <div>Subcategoría</div>
                    </div>
                </div>
                <div class="custom-select select-padre">
                    <div class="custom-select__content">
                        <div class="select-selected categoria">Selecciona una categoría</div>
                        <div class="icon-select">
                            <?php echo icon("arrow-down") ?>
                        </div>
                    </div>
                    <div class="select-items select-hide">
                        <?php
                        if ($categorias != null) :
                            foreach ($categorias as $categ) :
                        ?>
                                <div><?php echo $categ["nombre"] ?></div>
                            <?php
                            endforeach;
                        else : ?>
                            <div>Sin categorías</div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <form action="<?php echo url("/categorias/actualizar") ?>" method="POST" enctype="multipart/form-data" id="form-categoria" class="form">
                <div class="row">
                    <div class="col form">
                        <input type="hidden" value="<?php echo getToken() ?>" name="_token">
                        <input type="hidden" value="<?php echo $categoria["id"] ?>" name="id">
                        <div class="form-group label">
                            <label for="nombre">Editar nombre</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" value="<?php echo $categoria["nombre"] ?>" />
                        </div>
                        <div class="form-group label">
                            <label for="descripcion">Editar descripción</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Ingrese la descripción del categoría"><?php echo $categoria["descripcion"] ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col form">
                        <div class="form-group label">
                            <label for="imagen">Editar imagen</label>
                            <button type="button" onclick="document.getElementById('imagen-categoria').click()" class="btn btn-info">
                                <?php echo icon("image-add-01") ?>
                                Seleccionar imagen
                            </button>
                            <input type="file" class="hidden" name="imagen" id="imagen-categoria" accept=".jpg, .png, .jpeg, .webp" />
                        </div>
                        <div class="form-group label">
                            <label for="preview-image">Imagen: </label>
                            <div class="image-preview">
                                <img src="<?php echo asset("img/categorias", $categoria["imagen"]) ?>" alt="Imagen categoría" id="imagen-preview-categoria">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-edit">
                    <?php echo icon("pencil-edit-02") ?>
                    Editar
                </button>
            </form>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        document.getElementById('imagen-categoria').addEventListener('change', function() {
            var archivo = this.files[0];
            if (archivo) {
                var lector = new FileReader();
                lector.onload = function(e) {
                    var vistaPrevia = document.getElementById('imagen-preview-categoria');
                    vistaPrevia.src = e.target.result;
                }
                lector.readAsDataURL(archivo);
            }
        });

        var selectParent = document.querySelector(".custom-select.select-padre");
        <?php if ($categoria["id_categoria_padre"] != null) : ?>
            selectParent.classList.add("active");
        <?php
        else : ?>
            selectParent.classList.remove("active");
        <?php
        endif; ?>
    });
</script>