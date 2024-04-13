<main class="container-error">
    <section class="error">
        <h1 class="error__title"><?php echo $title ?></h1>
        <p class="error__description"><?php echo $message ?></p>
        <a href="<?php echo ($user != null) ? (($user["rol"] == "admin") ? url("/dashboard") : url("/inicio")) : url("/inicio")  ?>"
            class="btn btn-danger">
            <?php echo ($user != null) ? (($user["rol"] == "admin") ?  icon("dashboard") . "Volver al dashboard" : icon("home") . "Volver al inicio") :  icon("home") .  "Volver al inicio"  ?>
        </a>
    </section>
</main>