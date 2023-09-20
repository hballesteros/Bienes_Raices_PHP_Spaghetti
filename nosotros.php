<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="imagen/webp">
                    <source srcset="build/img/nosotros.jpg" type="imagen/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Esse, ea quae commodi aliquam, ipsa obcaecati nulla autem neque consequuntur praesentium veniam harum voluptatum eius quod omnis hic id repellat tempore!. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum eum vel exercitationem soluta recusandae id, odit fugiat beatae quae, quidem ducimus repellendus pariatur, eligendi quis facilis voluptatem sed sapiente asperiores?</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere libero ducimus placeat! Earum et adipisci itaque aperiam vitae, voluptas numquam sunt voluptate cupiditate libero quidem amet necessitatibus quasi esse a. Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Nulla, nemo, numquam reprehenderit aut accusamus beatae minima consectetur atque provident velit iste totam, dolore dignissimos fuga modi dolores ad excepturi eius!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Nulla, nemo, numquam reprehenderit aut accusamus beatae minima consectetur atque provident velit iste totam, dolore dignissimos fuga modi dolores ad excepturi eius!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Nulla, nemo, numquam reprehenderit aut accusamus beatae minima consectetur atque provident velit iste totam, dolore dignissimos fuga modi dolores ad excepturi eius!</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>