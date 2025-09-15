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
<section class="-mt-[71px] py-[80px] md:py-[120px] h-auto md:h-[1030px] bg-red-700 p-4" <?php echo $hero_bg; ?>>
  <div class="max-w-[1120px] mx-auto px-4">
    <div>
      <div class="max-w-[850px]">
        <?php if (!empty($hero['arriba_del_titulo'])): ?>
          <span class="text-white md:text-[20px] py-3 px-8 bg-[#C2996B] rounded-[5px]">
            <?php echo strip_tags($hero['arriba_del_titulo']) ?>
          </span>
        <?php endif; ?>
        <?php if (!empty($hero['titulo'])): ?>
          <h1 class="text-white leading-[110%] my-4 text-[40px] sm:text-[56px] md:text-[90px] font-semibold">
            <?php echo esc_html(strip_tags($hero['titulo'])); ?>
          </h1>
        <?php endif; ?>

        <?php if (!empty($hero['bajada'])): ?>
          <div class="text-white leading-[110%] max-w-[590px] text-[16px] sm:text-[18px]">
            <?php echo $hero['bajada']; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($hero['boton']) && !empty($hero['boton']['url'])): ?>
          <a
            class="bg-gradient-to-b py-4 sm:py-5 md:py-6 px-6 sm:px-10 md:px-12 rounded-lg inline-block text-white font-black uppercase mt-4 from-[#132148] to-[#2E50AE] text-[14px] sm:text-[16px]
              transition-all duration-300 ease-out
              motion-safe:hover:-translate-y-0.5 motion-safe:hover:scale-[1.01]
              hover:brightness-110 hover:shadow-lg
              focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/60"
            href="<?php echo esc_url($hero['boton']['url']); ?>"
            <?php echo !empty($hero['boton']['target']) ? ' target="' . esc_attr($hero['boton']['target']) . '" rel="noopener"' : ''; ?>>
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
$datos_bajada = $datos['bajada'];
?>
<section class="z-40 relative px-4">
  <div class="bg-white -mt-[60px] md:-mt-[140px] mx-auto overflow-clip rounded-[5px] max-w-[1000px]">
    <div class="flex flex-col md:flex-row md:items-center px-6 sm:px-10 md:px-[95px] pb-[30px] md:pb-[45px] pt-[22px] gap-6">
      <div class="md:pr-[58px] py-[20px] md:py-[40px] text-center md:text-left">
        <span
          id="datosCounter"
          data-counter
          data-target="<?php echo preg_replace('/[^\d,\. ,]/', '', $datos_num); ?>"
          data-locale="es-AR"
          data-duration="1500"
          data-decimals="0"
          class="text-center md:text-left text-[120px] sm:text-[180px] md:text-[250px] leading-[74%] block md:w-[270px] font-black -tracking-[8px] sm:-tracking-[16px] md:-tracking-[24px] bg-gradient-to-b from-[#0a1a3f] to-[#1e48a8] text-transparent bg-clip-text">
          0
        </span>
        <span class="text-center text-[48px] sm:text-[72px] md:text-[100px] -mt-4 sm:-mt-8 leading-[70%] block font-medium text-[#C2996B] -tracking-[0.5%]"><?php echo $datos_de; ?></span>
      </div>
      <?php if ($datos_img): ?>
        <div class="md:ps-[68px] py-[20px] md:py-[40px] md:border-l-2 md:border-[#132148]">
          <img class="max-w-full w-full h-auto" src="<?php echo $datos_img; ?>" alt="">
        </div>
      <?php endif; ?>
    </div>
    <?php if ($datos_bajada): ?>
      <div class="bg-gradient-to-r py-2 from-[#C2996B] to-[#5C4933]">
        <p class="px-4 text-white leading-[110%] font-semibold text-[18px] sm:text-[24px] md:text-[32px] text-center">
          <?php echo strip_tags($datos_bajada) ?>
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
<section id="servicios" class="scroll-mt-[71px] py-[64px] md:py-[126px] bg-gradient-to-t from-[#2E50AE] to-[#132148] -mt-[20px] md:-mt-[30px] px-4">
  <div class="max-w-[1120px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <?php if ($srv_titulo): ?>
          <h2 class="text-white text-[36px] sm:text-[42px] md:text-[48px] uppercase leading-[120%] font-medium">
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
      <div class="md:col-span-2 md:ps-[150px]">
        <?php if ($srv_items): ?>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php foreach ($srv_items as $item): ?>
              <div class="bg-white p-6 sm:p-8 rounded-[5px] transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl">
                <?php if (!empty($item['titulo'])): ?>
                  <h3 class="text-[#132148] text-[20px] sm:text-[22px] md:text-[24px] font-bold mb-3">
                    <?php echo esc_html($item['titulo']); ?>
                  </h3>
                <?php endif; ?>
                <?php if (!empty($item['descripcion'])): ?>
                  <div class="text-[#132148] opacity-80 leading-[150%] text-[15px] sm:text-[16px]">
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
<div class="h-[12px] sm:h-[18px] md:h-[23px] flex">
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
<section id="nosotros" class="scroll-mt-[71px] py-[40px] md:py-[45px] bg-gradient-to-t from-[#5C4933] to-[#C2996B] px-4">
  <div class="max-w-[1120px] mx-auto">
    <?php if ($his_titulo): ?>
      <h2 class="text-white text-[36px] sm:text-[48px] md:text-[64px] text-center uppercase leading-[120%] font-medium">
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
      <div class="max-w-[670px] leading-[160%] md:leading-[120%] md:columns-2 gap-4 mx-auto text-[15px] sm:text-[16px] mt-4 text-white">
        <?php echo $his_texto; ?>
      </div>
    <?php endif; ?>

    <?php if ($his_img1 || $his_img2 || $his_img3): ?>
      <div class="max-w-[1000px] group mt-6 md:mt-8 mx-auto rounded-lg overflow-clip">
        <?php if ($his_img1): ?>
          <img class="w-full h-[180px] sm:h-[220px] md:h-[250px] object-cover
           transition-transform duration-500 ease-out
           motion-safe:hover:scale-[1.02]" src="<?php echo $his_img1; ?>" alt="Estudio Mudric">
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-5 mt-6 md:mt-8 gap-4 md:gap-8 md:h-[500px]">
          <?php if ($his_img2): ?>
            <img class="w-full h-[220px] sm:h-[280px] md:h-full md:col-span-3 object-cover
           transition-transform duration-500 ease-out
           motion-safe:hover:scale-[1.02]" src="<?php echo $his_img2; ?>" alt="Estudio Mudric">
          <?php endif; ?>
          <?php if ($his_img3): ?>
            <img class="w-full h-[220px] sm:h-[280px] md:h-full md:col-span-2 object-cover
           transition-transform duration-500 ease-out
           motion-safe:hover:scale-[1.02]" src="<?php echo $his_img3; ?>" alt="Estudio Mudric">
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Divider paleta 2 :) -->
<div class="h-[12px] sm:h-[18px] md:h-[23px] flex">
  <div class="w-[25%] h-full bg-white"></div>
  <div class="w-[55%] h-full bg-gradient-to-r from-[#C2996B] to-[#5C4933]"></div>
  <div class="w-[20%] h-full bg-gradient-to-r from-[#2E50AE] to-[#132148]"></div>
</div>

<!-- Áreas Legales -->
<?php
$al_titulo = !empty($areas_legales['titulo']) ? esc_html($areas_legales['titulo']) : '';
$al_bajada = !empty($areas_legales['bajada']) ? esc_html($areas_legales['bajada']) : '';
$al_items  = (!empty($areas_legales['items']) && is_array($areas_legales['items'])) ? $areas_legales['items'] : [];
?>
<section id="areas" class="scroll-mt-[71px] py-[60px] md:py-[80px] bg-gradient-to-t from-[#555555] to-[#BBBBBB] px-4">
  <div class="max-w-[900px] mx-auto">
    <?php if ($al_titulo): ?>
      <h2 class="text-white text-[36px] sm:text-[48px] text-center uppercase leading-[110%] font-medium">
        <strong class="font-black"><?php echo $al_titulo; ?></strong>
      </h2>
    <?php endif; ?>

    <?php if ($al_bajada): ?>
      <p class="text-white/90 text-center mt-3 sm:mt-4 md:max-w-[348px] mx-auto leading-[110%] text-[20px]"><?php echo $al_bajada; ?></p>
    <?php endif; ?>

    <?php if ($al_items): ?>
      <?php foreach ($al_items as $item): ?>
        <div class="text-white grid grid-cols-1 md:grid-cols-3 border-b border-white py-6 md:py-12 gap-4 px-4
              transition-colors duration-300 hover:bg-white/5">
          <div class="md:w-[240px]">
            <?php if (!empty($item['area'])): ?>
              <h3 class="text-[32px] sm:text-[40px] md:text-[48px] font-medium leading-[110%]"><?php echo esc_html($item['area']); ?></h3>
            <?php endif; ?>
          </div>
          <div class="md:col-span-2">
            <?php if (!empty($item['texto'])): ?>
              <div class="leading-[160%] md:leading-[110%] text-[16px] md:text-[18px]">
                <?php echo $item['texto']; ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($item['boton'])): ?>
              <a class="bg-gradient-to-t from-[#132148] to-[#2E50AE] px-6 md:px-[40px] py-2 rounded-md text-white font-semibold uppercase block w-fit mt-3 ms-auto
                  transition-all duration-300 ease-out
                  motion-safe:hover:-translate-y-0.5 motion-safe:hover:scale-[1.01]
                  hover:brightness-110 hover:shadow-lg"
                href="<?php echo $item['boton']['url']; ?>">
                <?php echo $item['boton']['title']; ?>
              </a>
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
$eq_cita = !empty($equipo['cita']) ? $equipo['cita'] : '';
$eq_bajada_cita = !empty($equipo['bajada_cita']) ? $equipo['bajada_cita'] : '';
?>
<section id="equipo" class="scroll-mt-[71px] py-[60px] md:py-[80px] px-4">
  <div class="max-w-[900px] mx-auto">
    <?php if ($eq_titulo): ?>
      <h2 class="text-[#132148] text-[36px] sm:text-[48px] md:text-[64px] text-center uppercase leading-[120%] font-medium">
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
      <p class="text-[#132148] leading-[160%] md:leading-[120%] mt-3 sm:mt-4 text-center md:text-left text-[15px] sm:text-[16px]">
        <?php echo $eq_bajada; ?>
      </p>
    <?php endif; ?>

    <?php if ($eq_miembros): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 md:gap-[98px] mt-10 md:mt-12">
        <?php foreach ($eq_miembros as $m): ?>
          <?php
          $foto = (!empty($m['Foto']) && !empty($m['Foto']['url'])) ? esc_url($m['Foto']['url']) : '';
          ?>
          <div class="overflow-clip rounded-[12px] group">
            <?php if ($foto): ?>
              <img 
                class="h-[340px] sm:h-[380px] md:h-[430px] w-full object-cover
                  transition-transform duration-500 ease-out
                  motion-safe:group-hover:scale-[1.02]" 
                src="<?php echo $foto; ?>" 
                alt="Estudio Mudric"
              />
            <?php endif; ?>
            <div class="bg-[#132148] p-6 sm:p-8
                  transition-colors duration-300 group-hover:bg-[#101e49]"
            >
              <?php if (!empty($m['nombre'])): ?>
                <h3 class="text-[18px] sm:text-[20px] font-black text-white text-center"><?php echo esc_html($m['nombre']); ?></h3>
              <?php endif; ?>
              <?php if (!empty($m['cargo'])): ?>
                <p class="text-white text-[13px] sm:text-[14px] text-center"><?php echo esc_html($m['cargo']); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($eq_cita) : ?>
      <h5 class="text-[#C2996B] font-black uppercase leading-[120%] mt-8 text-center text-[28px] sm:text-[36px] md:text-[46px]">
        <?php echo $eq_cita ?>
      </h5>
    <?php endif; ?>
    <?php if ($eq_bajada_cita) : ?>
      <p class="text-[#132148]/80 max-w-[700px] mx-auto text-center leading-[160%] md:leading-[120%] mt-4 px-2">
        <?php echo strip_tags($eq_bajada_cita) ?>
      </p>
    <?php endif; ?>
  </div>
</section>

<!-- Divider :) -->
<div class="h-[12px] sm:h-[18px] md:h-[23px] flex">
  <div class="w-[20%] h-full bg-gradient-to-r from-[#2E50AE] to-[#132148]"></div>
  <div class="w-[55%] h-full bg-gradient-to-r from-[#C4C4C4] to-[#5E5E5E]"></div>
  <div class="w-[25%] h-full bg-white"></div>
</div>

<!-- Contacto -->
<?php
$ct_titulo   = !empty($contacto['titulo']) ? esc_html($contacto['titulo']) : '';
$ct_maps_src = !empty($contacto['direccion']) ? esc_url($contacto['direccion']) : ''; // en tu JSON es el SRC del iframe
?>
<section id="contacto" class="scroll-mt-[71px]">
  <div class="grid grid-cols-1 md:grid-cols-6">
    <div class="py-[50px] md:py-[70px] col-span-1 md:col-span-2 px-6 sm:px-8 md:px-10 bg-gradient-to-t from-[#5C4933] to-[#C2996B]">
      <?php if ($ct_titulo): ?>
        <h2 class="text-white font-black text-[36px] sm:text-[48px] md:text-[64px] uppercase"><?php echo $ct_titulo; ?></h2>
      <?php endif; ?>
      <?php echo do_shortcode('[contact-form-7 id="109d2dd" title="Contact form 1"]'); ?>
    </div>
    <div class="col-span-1 md:col-span-4 min-h-[300px] md:min-h-0">
      <?php if ($ct_maps_src): ?>
        <iframe class="w-full h-[300px] md:h-full" src="<?php echo $ct_maps_src; ?>" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
  (function() {
    // Formatea con Intl y decimales
    function formatNumber(value, locale, decimals) {
      try {
        return new Intl.NumberFormat(locale || 'es-AR', {
          minimumFractionDigits: decimals,
          maximumFractionDigits: decimals
        }).format(value);
      } catch (_) {
        return value.toLocaleString(); // fallback simple
      }
    }

    // Parsea targets tipo "12.345", "12 345", "12,5"
    function parseTarget(str) {
      if (typeof str !== 'string') return 0;
      const s = str.trim();
      const hasComma = s.includes(',');
      const hasDot = s.includes('.');

      // Heurística: si hay coma y punto, priorizamos el formato es-AR (punto miles, coma decimal)
      if (hasComma && hasDot) {
        const cleaned = s.replace(/\./g, '').replace(',', '.'); // "12.345,67" -> "12345.67"
        return parseFloat(cleaned) || 0;
      }
      // Solo coma: asumimos coma decimal
      if (hasComma && !hasDot) {
        return parseFloat(s.replace(',', '.')) || 0;
      }
      // Solo punto: puede ser miles o decimal, pero parseFloat ya sirve
      const onlyDigitsAndDot = s.replace(/[^\d.]/g, '');
      return parseFloat(onlyDigitsAndDot) || 0;
    }

    function animateCount(el) {
      const target = parseTarget(el.getAttribute('data-target') || '0');
      const duration = parseInt(el.getAttribute('data-duration') || '1500', 10);
      const decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
      const locale = el.getAttribute('data-locale') || 'es-AR';
      const startTime = performance.now();
      const startVal = 0;

      function tick(now) {
        const p = Math.min(1, (now - startTime) / duration);
        // Easing suave (easeOutCubic)
        const eased = 1 - Math.pow(1 - p, 3);
        const current = startVal + (target - startVal) * eased;
        el.textContent = formatNumber(+current.toFixed(decimals), locale, decimals);
        if (p < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    }

    // Soporte múltiples contadores: [data-counter]
    const counters = document.querySelectorAll('[data-counter]');

    if ('IntersectionObserver' in window) {
      const io = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateCount(entry.target);
            obs.unobserve(entry.target); // animar una sola vez
          }
        });
      }, {
        threshold: 0.3
      });

      counters.forEach(el => io.observe(el));
    } else {
      // Fallback: animar inmediatamente
      counters.forEach(el => animateCount(el));
    }
  })();
</script>


<?php get_footer(); ?>