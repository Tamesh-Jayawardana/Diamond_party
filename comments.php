<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;

if ( have_comments() || comments_open() ) {
	?>
	<section class="comments_wrap">
	<?php
	if ( have_comments() ) {
	?>
		<div id="comments" class="comments_list_wrap">
			<h4 class="section_title comments_list_title"><?php $post_comments = get_comments_number(); echo esc_attr($post_comments); ?> <?php echo (1==$post_comments ? esc_html__('Comment', 'yacht-rental') : esc_html__('Comments', 'yacht-rental')); ?></h4>
			<ul class="comments_list">
				<?php
				wp_list_comments( array('callback'=>'yacht_rental_output_single_comment') );
				?>
			</ul><!-- .comments_list -->
			<?php if ( !comments_open() && get_comments_number()!=0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
				<p class="comments_closed"><?php esc_html_e( 'Comments are closed.', 'yacht-rental' ); ?></p>
			<?php }	?>
			<div class="comments_pagination"><?php paginate_comments_links(); ?></div>
		</div><!-- .comments_list_wrap -->
	<?php 
	}

	if ( comments_open() ) {
		?>
		<div class="comments_form_wrap">
			<div class="comments_form">
				<?php
				$form_style = esc_attr(yacht_rental_get_theme_option('input_hover'));
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? ' aria-required="true"' : '' );
				$comments_args = array(
						'class_form' => 'comment-form ' . ($form_style != 'default' ? 'sc_input_hover_' . esc_attr($form_style) : ''),
						// change the id of send button 
						'id_submit' => 'send_comment',
						// change the title of send button 
						'label_submit' => esc_html__('Submit', 'yacht-rental'),
						// change the title of the reply section
						'title_reply' => esc_html__('Add Comment', 'yacht-rental'),
						'title_reply_before' => '<h3 class="section_title comments_form_title">',
						'title_reply_after' => '</h3>',

						// remove "Logged in as"
						'logged_in_as' => '',
						// remove text before textarea
						'comment_notes_before' => '',
						// remove text after textarea
						'comment_notes_after' => '',
						// redefine your own textarea (the comment body)
						'comment_field' => '<div class="comments_field comments_message">'
											. ''
											. ($form_style != 'default'
												? '<label for="comment" class="required">'
														. ($form_style == 'path'
															? '<svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg>'
															: ($form_style == 'iconed'
																? '<i class="sc_form_label_icon icon-feather"></i>'
																: ''
																)
															)
														. '<span class="sc_form_label_content" data-content="' . esc_attr__('Your Comment', 'yacht-rental') . '">'
															. esc_html__('Your Comment', 'yacht-rental')
														. '</span>'
													. '</label>'
												: ''
												)
										. '<textarea id="comment" name="comment"' . ($form_style == 'default' ? ' placeholder="' . esc_attr__( 'COMMENT', 'yacht-rental' ) . '"' : '') . ' aria-required="true"></textarea></div>',
						'fields' => apply_filters( 'comment_form_default_fields', array(
							'author' => '<div class="comments_field comments_author">'
										. ''
										. ($form_style != 'default'
											? '<label for="author"' . ( $req ? ' class="required"' : '' ). '>'
													. ($form_style == 'path'
														? '<svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg>'
														: ($form_style == 'iconed'
															? '<i class="sc_form_label_icon icon-user"></i>'
															: ''
															)
														)
													. '<span class="sc_form_label_content" data-content="' . esc_attr__('Name', 'yacht-rental') . '">'
														. esc_html__('Name', 'yacht-rental')
													. '</span>'
												. '</label>'
											: ''
											)
									. '<input id="author" name="author" type="text"' . ($form_style == 'default' ? '  placeholder="' . esc_attr__( 'Name', 'yacht-rental' ) . ( $req ? ' *' : '') . '"' : '') . ' value="' . esc_attr( isset($commenter['comment_author']) ? $commenter['comment_author'] : '' ) . '" size="30"' . ($aria_req) . ' /></div>',
							'email' => '<div class="comments_field comments_email">'
										. ''
										. ($form_style != 'default'
											? '<label for="email"' . ( $req ? ' class="required"' : '' ) . '>'
													. ($form_style == 'path'
														? '<svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg>'
														: ($form_style == 'iconed'
															? '<i class="sc_form_label_icon icon-mail-empty"></i>'
															: ''
															)
														)
													. '<span class="sc_form_label_content" data-content="' . esc_attr__('E-mail', 'yacht-rental') . '">'
														. esc_html__('E-mail', 'yacht-rental')
													. '</span>'
												. '</label>'
											: ''
											)
									. '<input id="email" name="email" type="text"' . ($form_style == 'default' ? '  placeholder="' . esc_attr__( 'Email', 'yacht-rental' ) . ( $req ? ' *' : '') . '"' : '') . ' value="' . esc_attr(  isset($commenter['comment_author_email']) ? $commenter['comment_author_email'] : '' ) . '" size="30"' . ($aria_req) . ' /></div>',
							'url' => '<div class="comments_field comments_site">'
										. ''
										. ($form_style != 'default'
											? '<label for="url" class="optional">'
													. ($form_style == 'path'
														? '<svg class="sc_form_graphic" preserveAspectRatio="none" viewBox="0 0 404 77" height="100%" width="100%"><path d="m0,0l404,0l0,77l-404,0l0,-77z"></svg>'
														: ($form_style == 'iconed'
															? '<i class="sc_form_label_icon icon-globe"></i>'
															: ''
															)
														)
													. '<span class="sc_form_label_content" data-content="' . esc_attr__('Website', 'yacht-rental') . '">'
														. esc_html__('Website', 'yacht-rental')
													. '</span>'
												. '</label>'
										    : ''
										    )
									. '<input id="url" name="url" type="text"' . ($form_style == 'default' ? '  placeholder="' . esc_attr__( 'Website', 'yacht-rental' ) . '"' : '') . ' value="' . esc_attr(  isset($commenter['comment_author_url']) ? $commenter['comment_author_url'] : '' ) . '" size="30"' . ($aria_req) . ' /></div>'
						) )
				);
			
				comment_form($comments_args);
				?>
			</div>
		</div><!-- /.comments_form_wrap -->
	<?php 
	}
	?>
	</section><!-- /.comments_wrap -->
<?php 
}
?>