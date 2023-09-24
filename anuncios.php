<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <section class="seccion contenedor">
        <h2>Casas y Dptos en Venta</h2>
   
        <?php
            $limite = 10;
            include 'includes/templates/anuncios.php';
        ?>

    </section>

<?php
    incluirTemplate('footer');
?>