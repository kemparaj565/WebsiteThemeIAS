<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package adney
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'adney' ), get_the_title() );
            } else {
                printf(
                    _nx(
                        '%1$s thought on &ldquo;%2$s&rdquo;',
                        '%1$s thoughts on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'adney'
                    ),
                    number_format_i18n( $comments_number ),
                    get_the_title()
                );
            }
            ?>
        </h2><!-- .comments-title -->
        <hr>
        <ul class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'      => 'ul',
                    'short_ping' => true,
                    'avatar_size' => 48,
                    'callback'    => 'adney_comments_list'
                ) );
            ?>
        </ul><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h3 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'adney' ); ?></h3>
                <ul class="pager  comment-navigation">
                    <li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'adney' ) ); ?></li>
                    <li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'adney' ) ); ?></li>
                </ul>

            </nav><!-- .comment-navigation -->
        <?php
        endif; // Check for comment navigation.

    endif; // Check for have_comments().


    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'adney' ); ?></p>
    <?php
    endif;

    $comment_args = array(
        'class_submit'      => 'btn green',
    );
    comment_form( $comment_args );
    ?>

</div><!-- #comments -->
