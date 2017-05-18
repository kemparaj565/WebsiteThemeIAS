<?php
get_header();

if(get_theme_mod('display_service',true)) {
    get_template_part('template-parts/content-service');
}
if(have_posts()){
?>
<section>
    <div class="container">
        <div class="col-md-12 col-sm-12">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>
</section>

<?php   }
 ?>

<!-- PORTFOLIO -->
<?php  if(get_theme_mod('display_portfolio', true)){
    $portfolio_title = esc_attr( get_theme_mod( 'portfolio_title' , '' ) );
    $portfolio_desc  = wp_kses_post( get_theme_mod( 'portfolio_desc' , '' ) );
    ?>
    <section class="portfolio">
        <div class="container">
            <?php if($portfolio_title != ''  || $portfolio_desc != ''  ){ ?>
            <div class="row">
                <div class="section-title">
                    <?php if($portfolio_title != ''){
                        echo '<span>'.$portfolio_title.'</span>';
                    }
                    ?>
                    <p><?php echo $portfolio_desc; ?></p>
                </div>
            </div>
            <?php } ?>
            <?php get_template_part( 'template-parts/content-portfolio' ); ?>
        </div>
        <!-- end container -->
    </section>
    <!-- portfolio -->
    <?php
}
?>


<!-- TEAM -->
<?php  if(get_theme_mod('display_team',true)){
    $team_title = esc_attr( get_theme_mod( 'team_title' , '' ) );
    $team_desc  = wp_kses_post( get_theme_mod( 'team_desc' , '' ) );
    ?>
    <section>
        <div class="container">
            <?php if($team_title != ''  || $team_desc != ''  ){ ?>
            <div class="row">
                <div class="section-title">
                    <?php if($team_title != ''){
                        echo '<span>'.$team_title.'</span>';
                    }
                    ?>
                    <p><?php echo $team_desc; ?></p>
                </div>
            </div>
            <?php } ?>
            <?php get_template_part( 'template-parts/content-team' ); ?>
        </div>
    </section>
    <?php
}
?>

<!-- TESTIMONIAL AND CLIENTS -->
<?php  if(get_theme_mod('display_testimonial',true) || get_theme_mod('display_clients',true) ){
    $row_class = 'col-md-12';
    if(get_theme_mod('display_testimonial',true) && get_theme_mod('display_clients',true) ){
        $row_class = 'col-md-6';
    }
    ?>
    <section>
        <div class="container">
            <div class="row">
                <?php
                if(get_theme_mod('display_testimonial',true)){
                    ?>
                    <div class="<?php echo $row_class; ?>">
                        <?php get_template_part( 'template-parts/content-testimonial',true ); ?>
                    </div>
                    <?php
                }

                if(get_theme_mod('display_clients',true)){
                    ?>
                    <div class="<?php echo $row_class; ?> clients">
                        <?php get_template_part( 'template-parts/content-clients' ); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>
<?php get_footer(); ?>


