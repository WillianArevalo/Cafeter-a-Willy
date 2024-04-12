<header class="header-admin">
    <nav class="navbar-admin">
        <div class="navbar-admin__logo">
            <img src="<?php echo asset("img", "logo.webp") ?>" alt="Logo">
            <h2>Coffe Willy</h2>
        </div>
        <ul class="navbar-admin__links">
            <li>
                <a href="<?php echo url("/dashboard") ?>" class="active">
                    <?php echo icon("dashboard") ?>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo url("/usuarios") ?>">
                    <?php echo icon("users") ?>
                    Usuarios
                </a>
            </li>
            <li>
                <a href="<?php echo url("/categorias") ?>">
                    <?php echo icon("bookmark") ?>
                    Categorías
                </a>
            </li>
            <li class="link-product">
                <a href="#">
                    <?php echo icon("product") ?>
                    Productos
                    <?php echo icon("arrow-down") ?>
                </a>
                <ul class="dropdown-menu-product">
                    <li>
                        <a href="#">
                            <?php echo icon("product") ?>
                            Productos
                        </a>
                    </li>
                    <li>
                        <a href="/admin/posts">
                            <?php echo icon("soft-drink") ?>
                            Bebidas
                        </a>
                    </li>
                    <li>
                        <a href="/admin/posts">
                            <?php echo icon("ice-cream") ?>
                            Acompañantes
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/admin/comments">
                    <?php echo icon("orders") ?>
                    Pedidos
                </a>
            </li>
            <li>
                <a href="/admin/categories">
                    <?php echo icon("sale") ?>
                    Ventas
                </a>
            </li>
            <li class="link-logout">
                <a href="/admin/logout">
                    <?php echo icon("logout") ?>
                    Cerrar sesión
                </a>
            </li>
        </ul>
    </nav>
    <div class="top-bar">
        <div class="top-bar__search">
            <input type="text" placeholder="Buscar">
            <button>
                <?php echo icon("search") ?>
            </button>
        </div>
        <div class="top-bar__user">
            <div class="top-bar__user-toggle-theme">
                <button id="sunButton">
                    <span id="icon-sun">
                        <?php echo icon("sun") ?>
                    </span>
                </button>
                <button class="active" id="moonButton">
                    <span id="icon-moon">
                        <?php echo icon("moon") ?>
                    </span>
                </button>
            </div>
            <img src="<?php echo asset("img", "perfil.jpg") ?>" alt="Imagen de perfil del usuario" id="image-perfil">
            <div class="top-bar__user-dropdown">
                <ul class="top-bar__user-dropdown-links">
                    <li>
                        <a href="#">
                            <?php echo icon("user-circle") ?>
                            Perfil
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php echo icon("settings") ?>
                            Configuración
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>