<header>
    <nav class="navbar">
        <div class="navbar__logo">
            <img src="<?php echo asset("img", "logo.webp") ?>" alt="Logo Coffe Willy">
        </div>
        <ul class="navbar__links">
            <li class="navbar__links-link">
                <a href="#">
                    <?php echo icon("home") ?>
                    Inicio
                </a>
            </li>
            <li class="navbar__links-link">
                <a href="#">
                    <?php echo icon("coffee") ?>
                    Cafetería
                </a>
            </li>
            <li class="navbar__links-link">
                <a href="#">
                    <?php echo icon("about") ?>
                    Sobre Nosotros</a>
            </li>
            <li class="navbar__links-link">
                <a href="#">
                    <?php echo icon("contact") ?>
                    Contáctanos
                </a>
            </li>
        </ul>
        <div class="navbar__cart">
            <a href="#" class="navbar__cart-link">
                <?php echo icon("cart") ?>
            </a>
            <span>1</span>
        </div>
        <div class="navbar__user">
            <?php
            if (getSession("user") != null) :
            ?>
                <img src="<?php echo asset("img", "perfil.jpg") ?>" alt="Imagen de perfil del usuario">
                <div class="navbar__user-dropdown">
                    <ul class="navbar__user-dropdown-links">
                        <li class="navbar__user-dropdown-links-link"><a href="#">Perfil</a></li>
                        <li class="navbar__user-dropdown-links-link"><a href="#">Configuración</a></li>
                        <li class="navbar__user-dropdown-links-link"><a href="#">Cerrar Sesión</a></li>
                    </ul>
                </div>
            <?php
            else :
            ?>
                <a href="<?php echo url("/login") ?>" class="navbar__user-link">
                    <?php echo icon("user-circle") ?>
                    <small>Inicia sesión</small>
                </a>
            <?php
            endif;
            ?>
        </div>
    </nav>
</header>