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

<?php
  // Helpers para sanitizar
  $esc_wysiwyg = function($html) {
    // Permitir HTML básico de WP Editor
    return wp_kses_post($html);
  };
  $img_url = function($imgField, $size = 'full') {
    if (is_array($imgField) && !empty($imgField['ID'])) {
      return esc_url(wp_get_attachment_image_url($imgField['ID'], $size));
    }
    if (is_array($imgField) && !empty($imgField['url'])) {
      return esc_url($imgField['url']);
    }
    return '';
  };
  $link_a = function($link, $classes='') {
    if (!is_array($link) || empty($link['url'])) return '';
    $title  = !empty($link['title']) ? esc_html($link['title']) : __('Ver más','textdomain');
    $url    = esc_url($link['url']);
    $target = !empty($link['target']) ? ' target="'.esc_attr($link['target']).'" rel="noopener"' : '';
    $cls    = $classes ? ' class="'.esc_attr($classes).'"' : '';
    return '<a href="'.$url.'"'.$target.$cls.'>'.$title.'</a>';
  };
?>

<!-- Hero -->
<?php
  $hero_bg = !empty($hero['fondo']) ? ' style="background-image:url(\''.$img_url($hero['fondo']).'\'); background-size:cover; background-position:center;"' : '';
?>
<section class="-mt-[71px] py-[120px] h-[1030px] bg-red-700 p-4"<?php echo $hero_bg; ?>>
  <div class="max-w-[1120px] mx-auto">
    <div>
      <div class="max-w-[850px]">
        <!-- Si querés un badge, podrías agregarlo a ACF; por ahora lo oculto si no existe -->
        <?php /* <p class="bg-[#C2996B] text-white px-8 py-2 w-fit">Arriba del titulo</p> */ ?>
        <?php if(!empty($hero['titulo'])): ?>
          <h1 class="text-white leading-[110%] my-4 text-[90px] font-semibold">
            <?php echo $esc_wysiwyg($hero['titulo']); ?>
          </h1>
        <?php endif; ?>

        <?php if(!empty($hero['bajada'])): ?>
          <div class="text-white max-w-[590px]">
            <?php echo $esc_wysiwyg($hero['bajada']); ?>
          </div>
        <?php endif; ?>

        <?php if(!empty($hero['boton'])): ?>
          <?php echo $link_a(
            $hero['boton'],
            'bg-gradient-to-b py-6 px-12 rounded-lg block w-fit text-white font-black uppercase mt-4 from-[#132148] to-[#2E50AE]'
          ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Datos -->
<?php
  $datos_img = !empty($datos['imagen']) ? $img_url($datos['imagen'],'large') : '';
  $datos_num = isset($datos['cantidad']) ? esc_html($datos['cantidad']) : '';
  $datos_de  = !empty($datos['de']) ? esc_html($datos['de']) : '';
?>
<section class="z-50 relative">
  <div class="bg-green-400 -mt-[200px] mx-auto overflow-clip rounded-[5px] max-w-[1000px]">
    <?php if($datos_img): ?>
      <img class="min-h-[300px] w-full object-cover" src="<?php echo $datos_img; ?>" alt="">
    <?php endif; ?>
    <?php if($datos_num || $datos_de): ?>
      <div class="bg-gradient-to-r py-2 from-[#C2996B] to-[#5C4933]">
        <p class="text-white leading-[110%] font-semibold text-[32px] text-center">
          <?php echo $datos_num ? $datos_num.' ' : ''; ?>
          <?php echo $datos_de; ?>
        </p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Nuestros Servicios -->
<?php
  $srv_titulo = !empty($servicios['titulo']) ? esc_html($servicios['titulo']) : '';
  $srv_items  = !empty($servicios['items']) && is_array($servicios['items']) ? $servicios['items'] : [];
?>
<section class="py-[126px] bg-gradient-to-t from-[#2E50AE] to-[#132148] -mt-[30px]">
  <div class="max-w-[1120px] mx-auto">
    <div class="grid grid-cols-3 gap-8">
      <div>
        <?php if($srv_titulo): ?>
          <h2 class="text-white text-[48px] uppercase leading-[120%] font-medium">
            <?php
              // Mantener “Nuestros <strong>Servicios</strong>” si el título coincide
              $partes = explode(' ', $srv_titulo, 2);
              if(count($partes) === 2) {
                echo esc_html($partes[0]).' <strong class="font-black">'.esc_html($partes[1]).'</strong>';
              } else {
                echo esc_html($srv_titulo);
              }
            ?>
          </h2>
        <?php endif; ?>
        <!-- Si querés una bajada acá, podés añadir un campo en ACF; por ahora queda vacío -->
      </div>
      <div class="col-span-2 md:ps-[150px]">
        <?php if($srv_items): ?>
          <div class="grid grid-cols-2 gap-4">
            <?php foreach($srv_items as $item): ?>
              <div class="bg-white p-8 rounded-[5px]">
                <?php if(!empty($item['titulo'])): ?>
                  <h3 class="text-[#132148] text-[24px] font-bold mb-3">
                    <?php echo esc_html($item['titulo']); ?>
                  </h3>
                <?php endif; ?>
                <?php if(!empty($item['descripcion'])): ?>
                  <div class="text-[#132148] opacity-80 leading-[140%]">
                    <?php echo $esc_wysiwyg($item['descripcion']); ?>
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
  $his_img1   = !empty($historia['imagen_1']) ? $img_url($historia['imagen_1'],'large') : '';
  $his_img2   = !empty($historia['imagen_2']) ? $img_url($historia['imagen_2'],'large') : '';
  $his_img3   = !empty($historia['imagen_3']) ? $img_url($historia['imagen_3'],'large') : '';
?>
<section class="py-[45px] bg-gradient-to-t from-[#5C4933] to-[#C2996B]">
  <div class="max-w-[1120px] mx-auto px-4">
    <?php if($his_titulo): ?>
      <h2 class="text-white text-[64px] text-center uppercase leading-[120%] font-medium">
        <?php
          // “Nuestra <strong>Historia</strong>” si coincide
          $partes = explode(' ', $his_titulo, 2);
          if(count($partes) === 2) {
            echo esc_html($partes[0]).' <strong class="font-black">'.esc_html($partes[1]).'</strong>';
          } else {
            echo esc_html($his_titulo);
          }
        ?>
      </h2>
    <?php endif; ?>

    <?php if($his_texto): ?>
      <div class="max-w-[670px] leading-[120%] columns-2 gap-4 mx-auto text-[16px] mt-4 text-white">
        <?php echo $esc_wysiwyg($his_texto); ?>
      </div>
    <?php endif; ?>

    <?php if($his_img1 || $his_img2 || $his_img3): ?>
      <div class="max-w-[1000px] mt-8 mx-auto rounded-lg overflow-clip">
        <?php if($his_img1): ?>
          <img class="w-full h-[250px] object-cover" src="<?php echo $his_img1; ?>" alt="">
        <?php endif; ?>
        <div class="grid grid-cols-5 mt-8 gap-8 h-[500px]">
          <?php if($his_img2): ?>
            <img class="h-full col-span-3 w-full object-cover" src="<?php echo $his_img2; ?>" alt="">
          <?php endif; ?>
          <?php if($his_img3): ?>
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
  $al_items  = !empty($areas_legales['items']) && is_array($areas_legales['items']) ? $areas_legales['items'] : [];
?>
<section class="py-[80px] bg-gradient-to-t from-[#555555] to-[#BBBBBB]">
  <div class="max-w-[900px] mx-auto px-4">
    <?php if($al_titulo): ?>
      <h2 class="text-white text-[64px] text-center uppercase leading-[120%] font-medium">
        <strong class="font-black"><?php echo $al_titulo; ?></strong>
      </h2>
    <?php endif; ?>

    <?php if($al_bajada): ?>
      <p class="text-white/90 text-center mt-4"><?php echo $al_bajada; ?></p>
    <?php endif; ?>

    <?php if($al_items): ?>
      <?php foreach($al_items as $item): ?>
        <div class="text-white grid grid-cols-3 mt-8 border-b border-white py-8">
          <div class="md:w-[240px]">
            <?php if(!empty($item['area'])): ?>
              <h3 class="text-[48px] font-medium leading-[100%]"><?php echo esc_html($item['area']); ?></h3>
            <?php endif; ?>
          </div>
          <div class="col-span-2">
            <?php if(!empty($item['texto'])): ?>
              <div class="leading-[110%] text-[18px]">
                <?php echo $esc_wysiwyg($item['texto']); ?>
              </div>
            <?php endif; ?>
            <!-- No hay botón en ACF para esta sección; si lo querés, lo agregamos -->
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- Nuestro Equipo -->
<?php
  $eq_titulo  = !empty($equipo['titulo']) ? esc_html($equipo['titulo']) : '';
  $eq_bajada  = !empty($equipo['bajada']) ? esc_html($equipo['bajada']) : '';
  $eq_miembros = !empty($equipo['miembros']) && is_array($equipo['miembros']) ? $equipo['miembros'] : [];
?>
<section class="py-[80px]">
  <div class="max-w-[900px] mx-auto px-4">
    <?php if($eq_titulo): ?>
      <h2 class="text-[#132148] text-[64px] text-center uppercase leading-[120%] font-medium">
        <?php
          $partes = explode(' ', $eq_titulo, 2);
          if(count($partes) === 2) {
            echo esc_html($partes[0]).' <strong class="font-black">'.esc_html($partes[1]).'</strong>';
          } else {
            echo esc_html($eq_titulo);
          }
        ?>
      </h2>
    <?php endif; ?>

    <?php if($eq_bajada): ?>
      <p class="text-[#132148] leading-[120%] mt-4 text-center md:text-left">
        <?php echo $eq_bajada; ?>
      </p>
    <?php endif; ?>

    <?php if($eq_miembros): ?>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-[98px] mt-12">
        <?php foreach($eq_miembros as $m): ?>
          <?php
            $foto = !empty($m['Foto']) ? $img_url($m['Foto'],'large') : '';
          ?>
          <div class="overflow-clip rounded-[12px]">
            <?php if($foto): ?>
              <img class="h-[430px] w-full object-cover" src="<?php echo $foto; ?>" alt="">
            <?php endif; ?>
            <div class="bg-[#132148] p-8">
              <?php if(!empty($m['nombre'])): ?>
                <h3 class="text-[20px] font-black text-white text-center"><?php echo esc_html($m['nombre']); ?></h3>
              <?php endif; ?>
              <?php if(!empty($m['cargo'])): ?>
                <p class="text-white text-[14px] text-center"><?php echo esc_html($m['cargo']); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Bloques de cita/texto: si querés que sean ACF, añadimos campos; por ahora omitidos -->
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
  $ct_titulo = !empty($contacto['titulo']) ? esc_html($contacto['titulo']) : '';
  // En tu JSON, "direccion" guarda el SRC del iframe (URL de Google Maps)
  $ct_maps_src = !empty($contacto['direccion']) ? esc_url($contacto['direccion']) : '';
?>
<section>
  <div class="grid grid-cols-6">
    <div class="py-[70px] col-span-6 md:col-span-2 px-10 bg-gradient-to-t from-[#5C4933] to-[#C2996B]">
      <?php if($ct_titulo): ?>
        <h2 class="text-white font-black text-[48px] md:text-[64px]"><?php echo $ct_titulo; ?></h2>
      <?php endif; ?>
    </div>
    <div class="col-span-6 md:col-span-4">
      <?php if($ct_maps_src): ?>
        <iframe class="w-full" src="<?php echo $ct_maps_src; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
