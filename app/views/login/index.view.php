<main class="container-login">
    <div class="login">
        <div class="login__header">
            <img src="<?php echo asset("img", "logo.webp") ?>" alt="Logo login" class="login__header-logo">
            <h3 class="login__header-title">Inicia sesión</h3>
        </div>
        <form action="<?php echo url("/login/validate_user") ?>" method="POST" id="form-login" class="login__form">
            <input type="hidden" name="_token" value="<?php echo getToken() ?>">
            <div class="login__form-form-group">
                <input type="text" class="form-group__input" name="username" id="username" placeholder="Usuario">
                <span>
                    <?php echo icon("user-circle") ?>
                </span>
            </div>
            <small class="login__form-message"></small>
            <div class="login__form-form-group">
                <input type="password" class="form-group__input" name="password" id="password" placeholder="Contraseña" />
                <span>
                    <?php echo icon("security-password") ?>
                </span>
            </div>
            <small class="login__form-message"></small>
            <div class="login__form-remember">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Remember me</label>
            </div>
            <button type="submit" class="login__form-button">
                <?php echo icon("login") ?>
                Login
            </button>
        </form>
    </div>
</main>
<script type="module" src="<?php echo asset("js", "login.js") ?>"></script>