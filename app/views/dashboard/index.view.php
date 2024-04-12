<main class="main-admin">
    <section class="welcome">
        <div class="welcome__container">
            <div class="welcome__container-text">
                <h1 class="welcome__container-text-title">Bienvenido,<?php echo $user["username"] ?></h1>
                <p class="welcome__container-text-paragraph">
                    Administra los usuarios, productos, categorías y más desde aquí.
                </p>
            </div>
            <div class="welcome__container-links-account">
                <a href="#">
                    <?php echo icon("user-circle-02") ?>
                    Cuenta
                </a>
                <a href="#">
                    <?php echo icon("user-edit") ?>
                    Editar cuenta
                </a>
                <a href="#">
                    <?php echo icon("user-remove") ?>
                    Eliminar cuenta
                </a>
            </div>
        </div>
    </section>
    <section class="dashboard">
        <div class="dashboard__container">
            <div class="dashboard-col-1">
                <div class="counts">
                    <div class="counts__item">
                        <h4 class="counts__item-title">Usuarios</h4>
                        <p class="counts__item-number">10</p>
                    </div>
                    <div class="counts__item">
                        <h4 class="counts__item-title">Productos</h4>
                        <p class="counts__item-number">20</p>
                    </div>
                    <div class="counts__item">
                        <h4 class="counts__item-title">Categorías</h4>
                        <p class="counts__item-number">5</p>
                    </div>
                </div>
                <div class="recent-orders">
                    <div class="recent-orders__title">
                        <h4 class="recent-orders__title-text">Pedidos recientes</h4>
                        <button>Ver todas</button>
                    </div>
                    <div class="table__container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Número orden</th>
                                    <th>Pagado</th>
                                    <th>Estatus</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>$100</td>
                                    <td>
                                        <span class="success">
                                            Entregado
                                        </span>
                                    </td>
                                    <td>
                                        <button>Detalles</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$200</td>
                                    <td>
                                        <span class="declined">
                                            Cancelado
                                        </span>
                                    </td>
                                    <td>
                                        <button>Detalles</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$300</td>
                                    <td>
                                        <span class="pending">
                                            Pendiente
                                        </span>
                                    </td>
                                    <td>
                                        <button>Detalles</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="dashboard-col-2">
                <div class="reminder">
                    <div class="reminder__header">
                        <h4 class="reminder__header-title">Recordatorios</h4>
                        <span>
                            <?php echo icon("notification") ?>
                        </span>
                    </div>
                    <div class="reminder__item">
                        <div class="reminder__item-icon">
                            <?php echo icon("check") ?>
                        </div>
                        <div class="reminder__item-content">
                            <div class="content-text">
                                <p class="content-text-title">Revisar productos</p>
                                <p class="content-text-time">
                                    <span>10:00 AM</span>
                                    <span>hace 5 minutos</span>
                                </p>
                            </div>
                            <button class="button-more">
                                <?php echo icon("more-vertical-circle") ?>
                            </button>
                        </div>
                        <div class="reminder__dropdown">
                            <button>
                                <?php echo icon("check") ?>
                                Finalizar
                            </button>
                            <button>
                                <?php echo icon("pencil-edit-02") ?>
                                Editar
                            </button>
                            <button>
                                <?php echo icon("delete-02") ?>
                                Eliminar
                            </button>
                        </div>
                    </div>
                    <div class="reminder__item">
                        <div class="reminder__item-icon">
                            <?php echo icon("check") ?>
                        </div>
                        <div class="reminder__item-content">
                            <div class="content-text">
                                <p class="content-text-title">Revisar productos</p>
                                <p class="content-text-time">
                                    <span>10:00 AM</span>
                                    <span>hace 5 minutos</span>
                                </p>
                            </div>
                            <button class="button-more">
                                <?php echo icon("more-vertical-circle") ?>
                            </button>
                        </div>
                        <div class="reminder__dropdown">
                            <button>
                                <?php echo icon("check") ?>
                                Finalizar
                            </button>
                            <button>
                                <?php echo icon("pencil-edit-02") ?>
                                Editar
                            </button>
                            <button>
                                <?php echo icon("delete-02") ?>
                                Eliminar
                            </button>
                        </div>
                    </div>
                    <button class="redminder__button-add" id="button-add-redminder">
                        <?php echo icon("add-01") ?>
                        Agregar recordatorio
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>