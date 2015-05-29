<?php

get_template_part('templates/top', 'page');
wp_enqueue_script( 'faq-unicit' );
wp_enqueue_script( 'jquery-mobile-custom' );
wp_enqueue_script( 'modernizr' );
wp_enqueue_script( 'main' );

wp_enqueue_style( 'style_faq_unicit' );
wp_enqueue_style( 'reset_faq_unicit' );
?>

      <section class="cd-faq">
        <div id="preloader"></div>
        <!-- INICIO DA MONTAGEM DO MENU -->
        <ul class="cd-faq-categories">
          <h2 class="cd-faq-title"><?php _e( 'Subject', 'faq-unicit' ) ?></h2><br/>
          <?php
          $categories = get_terms('subjects');
          foreach ( $categories as $subject_menu ) : 
            ?>   

          <li><a href="<?php echo '#' . $subject_menu->name; ?>"><?php echo $subject_menu->name; ?></a></li>  

        <?php endforeach; ?>
      </ul>
      <!-- FIM DA MONTAGEM DO MENU -->
      <div class="cd-faq-items">
        <?php foreach ( $categories as $category ) : ?>
      <!-- INICIO DA MONTAGEM DO CONTEÚDO -->
        <ul id="<?php echo $category->name; ?>" class="cd-faq-group">
          <li class="cd-faq-title"><h2><?php echo $category->name; ?></h2></li>
          <?php

          $posts = get_posts(array(
            'post_type' => 'faq_unicit',
            'orderby' => 'menu_order',
            'order' =>  'ASC',
            'taxonomy' => $category->taxonomy,
            'term'  => $category->slug,
            'nopaging' => true,
            ));

          foreach($posts as $post) :
            setup_postdata($post); 
          ?> 

          <li>
            <a class="cd-faq-trigger" href="#0"><?php echo $post->post_title; ?></a>
            <div class="cd-faq-content">
              <?php the_content(); ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php endforeach; 
      wp_reset_query(); ?>
    </div>
  </section>