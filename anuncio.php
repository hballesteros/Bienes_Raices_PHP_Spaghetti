<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt aliquam sit nobis praesentium? Consectetur iusto nesciunt harum repellendus, at, fuga eos totam optio quis vitae aliquid error quisquam! Sint, ad?. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut ad voluptatibus tenetur error provident eveniet, ex maxime recusandae consectetur ut cumque. Maiores cupiditate cum corrupti quae! Quibusdam reiciendis ullam quae!. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi totam maiores porro necessitatibus consectetur recusandae at, dolorem provident cupiditate dolorum dolores ad labore incidunt doloribus ut quia quos nemo? Doloribus.</p>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. In dignissimos harum praesentium. Similique exercitationem vel veritatis aliquam asperiores iste ea aperiam ad fuga, eius iusto mollitia autem! Laborum, eos harum!. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi expedita sunt esse corporis soluta minus, quos laborum ea voluptate facilis hic laboriosam fuga aliquid quo perferendis, inventore error. Voluptatem, reprehenderit?</p>

        </div>
    </main>

<?php
    incluirTemplate('footer');
?>