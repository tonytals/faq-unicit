<?php

get_header(); 
wp_enqueue_script( 'faq-unicit' );
wp_enqueue_script( 'jquery-mobile-custom' );
wp_enqueue_script( 'modernizr' );
wp_enqueue_script( 'main' );

wp_enqueue_style( 'style_faq_unicit' );
wp_enqueue_style( 'reset_faq_unicit' );
?>

<div id="main-content" class="main-content">
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
     <article class="post-703 page type-page status-publish hentry">
      <section class="cd-faq">
        <ul class="cd-faq-categories">
          <h2 class="cd-faq-title">Qual o assunto?</h2><br/>
          <?php
    
          $categories = get_terms('subjects');
          foreach ( $categories as $subject_menu ) : 
            ?>   

          <li><a href="<?php echo '#' . $subject_menu->name; ?>"><?php echo $subject_menu->name; ?></a></li>  

          <?php    
          endforeach;
          echo "</ul>";
    
          foreach ( $categories as $category ) :
            ?>

          <header class="entry-header">

            <h1 class="entry-title"><?php echo $category->name; ?></h1>
          </header>
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
            <div class="entry-content">
              <a href="#" rel="bookmark" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
              <p><?php the_content(); ?></p>
            </div>
          <?php endforeach; ?>
        <?php endforeach; 
        wp_reset_query(); ?>
      </section>
    </article>       
  </div> 
</div> 
</div> 
<?php 
get_sidebar();
get_footer();
?>