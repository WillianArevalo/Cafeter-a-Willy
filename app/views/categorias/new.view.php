<main class="main-admin">
    <div class="categorias-nueva">
        <h1>Nueva categoría</h1>
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
                            foreach ($categorias as $categoria) :
                        ?>
                                <div data-id="<?php echo $categoria["id"] ?>"><?php echo $categoria["nombre"] ?></div>
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
            <form action="<?php echo url("/categorias/crear") ?>" method="POST" enctype="multipart/form-data" id="form-categoria">
                <div class="form">
                    <div class="form__col-1">
                        <input type="hidden" value="<?php echo getToken() ?>" name="_token">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" />
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Ingrese la descripción del categoría"></textarea>
                        </div>
                    </div>
                    <div class="form__col-2">
                        <div class="form-group-image">
                            <label for="imagen">Imagen</label>
                            <button type="button" onclick="document.getElementById('imagen-categoria').click()">
                                <?php echo icon("image-add-01") ?>
                                Seleccionar imagen
                            </button>
                            <input type="file" name="imagen" id="imagen-categoria" accept=".jpg, .png, .jpeg, .webp" />
                        </div>
                        <div class="form-group-image">
                            <label for="preview-image">Previsualización de la imagen: </label>
                            <div class="image-preview">
                                <img src="" alt="Imagen categoría" id="imagen-preview-categoria">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit">
                    <?php echo icon("add-circle") ?>
                    Agregar
                </button>
            </form>
        </div>
        <div class="categoria-nueva__sub"></div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $("#imagen-preview-categoria").attr("src", "<?php echo asset("img", "sin-imagen.jpg") ?>");
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
    });
</script>