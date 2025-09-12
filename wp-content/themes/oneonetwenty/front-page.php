<?php
/**
 * Template: Home (Landing EMS)
 * Requiere ACF y el grupo "Home (Landing EMS)"
 */

// 1) Traer grupos ACF como variables
$tob_bar        = get_field('tob_bar') ?: [];
$hero           = get_field('hero') ?: [];
$datos          = get_field('datos') ?: [];
$servicios      = get_field('servicios') ?: [];
$historia       = get_field('historia') ?: [];
$areas_legales  = get_field('areas_legales') ?: [];
$equipo         = get_field('equipo') ?: [];
$contacto       = get_field('contacto') ?: [];

get_header();
?>

<!-- Hero -->
<?php
$hero_bg = !empty($hero['fondo']) && !empty($hero['fondo']['url'])
  ? ' style="background-image:url(\'' . esc_url($hero['fondo']['url']) . '\'); background-size:cover; background-position:center;"'
  : '';
?>
<section class="-mt-[71px] py-[120px] h-[1030px] bg-red-700 p-4"<?php echo $hero_bg; ?>>
  <div class="max-w-[1120px] mx-auto">
    <div>
      <div class="max-w-[850px]">
        <?php if (!empty($hero['titulo'])): ?>
          <h1 class="text-white leading-[110%] my-4 text-[90px] font-semibold">
            <?php echo esc_html(strip_tags($hero['titulo'])); ?>
          </h1>
        <?php endif; ?>

        <?php if (!empty($hero['bajada'])): ?>
          <div class="text-white max-w-[590px]">
            <?php echo $hero['bajada']; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($hero['boton']) && !empty($hero['boton']['url'])): ?>
          <a
            class="bg-gradient-to-b py-6 px-12 rounded-lg block w-fit text-white font-black uppercase mt-4 from-[#132148] to-[#2E50AE]"
            href="<?php echo esc_url($hero['boton']['url']); ?>"
            <?php echo !empty($hero['boton']['target']) ? ' target="'.esc_attr($hero['boton']['target']).'" rel="noopener"' : ''; ?>
          >
            <?php echo !empty($hero['boton']['title']) ? esc_html($hero['boton']['title']) : 'Ver más'; ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Datos -->
<?php
$datos_img = (!empty($datos['imagen']) && !empty($datos['imagen']['url'])) ? esc_url($datos['imagen']['url']) : '';
$datos_num = isset($datos['cantidad']) ? esc_html($datos['cantidad']) : '';
$datos_de  = !empty($datos['de']) ? esc_html($datos['de']) : '';
?>
<section class="z-50 relative">
  <div class="bg-green-400 -mt-[200px] mx-auto overflow-clip rounded-[5px] max-w-[1000px]">
    <div class="flex px-[95px] gap-8 py-[22px]">
      <div>
        <span class="text-[200px] font-black -tracking-[1%]"><?php echo $datos_num ? $datos_num . ' ' : ''; ?></span>
        <span class="text-[50px] font-medium text-[#C2996B]"><?php echo $datos_de; ?></span>        
      </div>
      <?php if ($datos_img): ?>
        <img class="max-w-full w-full object-cover" src="<?php echo $datos_img; ?>" alt="">
      <?php endif; ?>
    </div>
    <?php if ($datos_num || $datos_de): ?>
      <div class="bg-gradient-to-r py-2 from-[#C2996B] to-[#5C4933]">
        <p class="text-white leading-[110%] font-semibold text-[32px] text-center">
        </p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Nuestros Servicios -->
<?php
$srv_titulo = !empty($servicios['titulo']) ? esc_html($servicios['titulo']) : '';
$srv_items  = (!empty($servicios['items']) && is_array($servicios['items'])) ? $servicios['items'] : [];
?>
<section class="py-[126px] bg-gradient-to-t from-[#2E50AE] to-[#132148] -mt-[30px]">
  <div class="max-w-[1120px] mx-auto">
    <div class="grid grid-cols-3 gap-8">
      <div>
        <?php if ($srv_titulo): ?>
          <h2 class="text-white text-[48px] uppercase leading-[120%] font-medium">
            <?php
            $partes = explode(' ', $srv_titulo, 2);
            if (count($partes) === 2) {
              echo esc_html($partes[0]) . ' <strong class="font-black">' . esc_html($partes[1]) . '</strong>';
            } else {
              echo $srv_titulo;
            }
            ?>
          </h2>
        <?php endif; ?>
      </div>
      <div class="col-span-2 md:ps-[150px]">
        <?php if ($srv_items): ?>
          <div class="grid grid-cols-2 gap-4">
            <?php foreach ($srv_items as $item): ?>
              <div class="bg-white p-8 rounded-[5px]">
                <?php if (!empty($item['titulo'])): ?>
                  <h3 class="text-[#132148] text-[24px] font-bold mb-3">
                    <?php echo esc_html($item['titulo']); ?>
                  </h3>
                <?php endif; ?>
                <?php if (!empty($item['descripcion'])): ?>
                  <div class="text-[#132148] opacity-80 leading-[140%]">
                    <?php echo $item['descripcion']; ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Divider :) -->
<div class="h-[23px] flex">
  <div class="w-[20%] h-full bg-gradient-to-r from-[#2E50AE] to-[#132148]"></div>
  <div class="w-[55%] h-full bg-gradient-to-r from-[#C4C4C4] to-[#5E5E5E]"></div>
  <div class="w-[25%] h-full bg-white"></div>
</div>

<!-- Nuestra Historia -->
<?php
$his_titulo = !empty($historia['titulo']) ? esc_html($historia['titulo']) : '';
$his_texto  = !empty($historia['texto']) ? $historia['texto'] : '';
$his_img1   = (!empty($historia['imagen_1']) && !empty($historia['imagen_1']['url'])) ? esc_url($historia['imagen_1']['url']) : '';
$his_img2   = (!empty($historia['imagen_2']) && !empty($historia['imagen_2']['url'])) ? esc_url($historia['imagen_2']['url']) : '';
$his_img3   = (!empty($historia['imagen_3']) && !empty($historia['imagen_3']['url'])) ? esc_url($historia['imagen_3']['url']) : '';
?>
<section class="py-[45px] bg-gradient-to-t from-[#5C4933] to-[#C2996B]">
  <div class="max-w-[1120px] mx-auto px-4">
    <?php if ($his_titulo): ?>
      <h2 class="text-white text-[64px] text-center uppercase leading-[120%] font-medium">
        <?php
        $partes = explode(' ', $his_titulo, 2);
        if (count($partes) === 2) {
          echo esc_html($partes[0]) . ' <strong class="font-black">' . esc_html($partes[1]) . '</strong>';
        } else {
          echo $his_titulo;
        }
        ?>
      </h2>
    <?php endif; ?>

    <?php if ($his_texto): ?>
      <div class="max-w-[670px] leading-[120%] columns-2 gap-4 mx-auto text-[16px] mt-4 text-white">
        <?php echo $his_texto; ?>
      </div>
    <?php endif; ?>

    <?php if ($his_img1 || $his_img2 || $his_img3): ?>
      <div class="max-w-[1000px] mt-8 mx-auto rounded-lg overflow-clip">
        <?php if ($his_img1): ?>
          <img class="w-full h-[250px] object-cover" src="<?php echo $his_img1; ?>" alt="">
        <?php endif; ?>
        <div class="grid grid-cols-5 mt-8 gap-8 h-[500px]">
          <?php if ($his_img2): ?>
            <img class="h-full col-span-3 w-full object-cover" src="<?php echo $his_img2; ?>" alt="">
          <?php endif; ?>
          <?php if ($his_img3): ?>
            <img class="h-full col-span-2 w-full object-cover" src="<?php echo $his_img3; ?>" alt="">
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Áreas Legales -->
<?php
$al_titulo = !empty($areas_legales['titulo']) ? esc_html($areas_legales['titulo']) : '';
$al_bajada = !empty($areas_legales['bajada']) ? esc_html($areas_legales['bajada']) : '';
$al_items  = (!empty($areas_legales['items']) && is_array($areas_legales['items'])) ? $areas_legales['items'] : [];
?>
<section class="py-[80px] bg-gradient-to-t from-[#555555] to-[#BBBBBB]">
  <div class="max-w-[900px] mx-auto px-4">
    <?php if ($al_titulo): ?>
      <h2 class="text-white text-[64px] text-center uppercase leading-[120%] font-medium">
        <strong class="font-black"><?php echo $al_titulo; ?></strong>
      </h2>
    <?php endif; ?>

    <?php if ($al_bajada): ?>
      <p class="text-white/90 text-center mt-4"><?php echo $al_bajada; ?></p>
    <?php endif; ?>

    <?php if ($al_items): ?>
      <?php foreach ($al_items as $item): ?>
        <div class="text-white grid grid-cols-3 mt-8 border-b border-white py-8">
          <div class="md:w-[240px]">
            <?php if (!empty($item['area'])): ?>
              <h3 class="text-[48px] font-medium leading-[100%]"><?php echo esc_html($item['area']); ?></h3>
            <?php endif; ?>
          </div>
          <div class="col-span-2">
            <?php if (!empty($item['texto'])): ?>
              <div class="leading-[110%] text-[18px]">
                <?php echo $item['texto']; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- Nuestro Equipo -->
<?php
$eq_titulo   = !empty($equipo['titulo']) ? esc_html($equipo['titulo']) : '';
$eq_bajada   = !empty($equipo['bajada']) ? esc_html($equipo['bajada']) : '';
$eq_miembros = (!empty($equipo['miembros']) && is_array($equipo['miembros'])) ? $equipo['miembros'] : [];
?>
<section class="py-[80px]">
  <div class="max-w-[900px] mx-auto px-4">
    <?php if ($eq_titulo): ?>
      <h2 class="text-[#132148] text-[64px] text-center uppercase leading-[120%] font-medium">
        <?php
        $partes = explode(' ', $eq_titulo, 2);
        if (count($partes) === 2) {
          echo esc_html($partes[0]) . ' <strong class="font-black">' . esc_html($partes[1]) . '</strong>';
        } else {
          echo $eq_titulo;
        }
        ?>
      </h2>
    <?php endif; ?>

    <?php if ($eq_bajada): ?>
      <p class="text-[#132148] leading-[120%] mt-4 text-center md:text-left">
        <?php echo $eq_bajada; ?>
      </p>
    <?php endif; ?>

    <?php if ($eq_miembros): ?>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-[98px] mt-12">
        <?php foreach ($eq_miembros as $m): ?>
          <?php
          $foto = (!empty($m['Foto']) && !empty($m['Foto']['url'])) ? esc_url($m['Foto']['url']) : '';
          ?>
          <div class="overflow-clip rounded-[12px]">
            <?php if ($foto): ?>
              <img class="h-[430px] w-full object-cover" src="<?php echo $foto; ?>" alt="">
            <?php endif; ?>
            <div class="bg-[#132148] p-8">
              <?php if (!empty($m['nombre'])): ?>
                <h3 class="text-[20px] font-black text-white text-center"><?php echo esc_html($m['nombre']); ?></h3>
              <?php endif; ?>
              <?php if (!empty($m['cargo'])): ?>
                <p class="text-white text-[14px] text-center"><?php echo esc_html($m['cargo']); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Divider :) -->
<div class="h-[23px] flex">
  <div class="w-[20%] h-full bg-gradient-to-r from-[#2E50AE] to-[#132148]"></div>
  <div class="w-[55%] h-full bg-gradient-to-r from-[#C4C4C4] to-[#5E5E5E]"></div>
  <div class="w-[25%] h-full bg-white"></div>
</div>

<!-- Contacto -->
<?php
$ct_titulo   = !empty($contacto['titulo']) ? esc_html($contacto['titulo']) : '';
$ct_maps_src = !empty($contacto['direccion']) ? esc_url($contacto['direccion']) : ''; // en tu JSON es el SRC del iframe
?>
<section>
  <div class="grid grid-cols-6">
    <div class="py-[70px] col-span-6 md:col-span-2 px-10 bg-gradient-to-t from-[#5C4933] to-[#C2996B]">
      <?php if ($ct_titulo): ?>
        <h2 class="text-white font-black text-[48px] md:text-[64px]"><?php echo $ct_titulo; ?></h2>
      <?php endif; ?>
    </div>
    <div class="col-span-6 md:col-span-4">
      <?php if ($ct_maps_src): ?>
        <iframe class="w-full" src="<?php echo $ct_maps_src; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
