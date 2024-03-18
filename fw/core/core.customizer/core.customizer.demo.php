<div class="to_demo_wrap">
	<a href="" class="to_demo_pin iconadmin-pin" title="<?php esc_attr_e('Pin/Unpin demo-block by the right side of the window', 'yacht-rental'); ?>"></a>
	<div class="to_demo_body_wrap">
		<div class="to_demo_body">
			<h1 class="to_demo_header"><?php esc_html_e('Header with','yacht-rental');?> <span class="to_demo_header_link"><?php esc_html_e('inner link','yacht-rental');?></span> <?php esc_html_e('and it','yacht-rental');?> <span class="to_demo_header_hover"><?php esc_html_e('hovered state','yacht-rental');?></span></h1>
			<p class="to_demo_info"><?php esc_html_e('Posted','yacht-rental');?> <span class="to_demo_info_link"><?php esc_html_e('12 May, 2015','yacht-rental');?></span> <?php esc_html_e('by','yacht-rental');?> <span class="to_demo_info_hover"><?php esc_html_e('Author name hovered','yacht-rental');?></span>.</p>
			<p class="to_demo_text"><?php esc_html_e('This is default post content. Colors of each text element are set based on the color you choose below.','yacht-rental');?></p>
			<p class="to_demo_text"><span class="to_demo_text_link"><?php esc_html_e('link example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_text_hover"><?php esc_html_e('hovered link','yacht-rental');?></span></p>

			<?php 
			$colors = yacht_rental_storage_get('custom_colors');
			if (is_array($colors) && count($colors) > 0) {
				foreach ($colors as $slug=>$scheme) { 
					?>
					<h3 class="to_demo_header"><?php esc_html_e('Accent colors','yacht-rental');?></h3>
					<?php if (isset($scheme['text_link'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_text_link"><?php esc_html_e('text_link example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_text_hover"><?php esc_html_e('hovered text_link','yacht-rental');?></span></p></div>
					<?php } ?>
					<?php if (isset($scheme['accent2'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent2"><?php esc_html_e('accent2 example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_accent2_hover"><?php esc_html_e('hovered accent2','yacht-rental');?></span></p></div>
					<?php } ?>
					<?php if (isset($scheme['accent3'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent3"><?php esc_html_e('accent3 example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_accent3_hover"><?php esc_html_e('hovered accent3','yacht-rental');?></span></p></div>
					<?php } ?>
		
					<h3 class="to_demo_header"><?php esc_html_e('Inverse colors (on accented backgrounds)','yacht-rental');?></h3>
					<?php if (isset($scheme['text_link'])) { ?>
						<div class="to_demo_columns3 to_demo_text_link_bg to_demo_inverse_block">
							<h4 class="to_demo_text_hover_bg to_demo_inverse_dark"><?php esc_html_e('Accented block header','yacht-rental');?></h4>
							<div>
								<p class="to_demo_inverse_light"><?php esc_html_e('Posted','yacht-rental');?> <span class="to_demo_inverse_link"><?php esc_html_e('12 May, 2015','yacht-rental');?></span> <?php esc_html_e('by','yacht-rental');?> <span class="to_demo_inverse_hover"><?php esc_html_e('Author name hovered','yacht-rental');?></span>.</p>
								<p class="to_demo_inverse_text"><?php esc_html_e('This is a inversed colors example for the normal text','yacht-rental');?></p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link"><?php esc_html_e('link example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_inverse_hover"><?php esc_html_e('hovered link','yacht-rental');?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($scheme['accent2'])) { ?>
						<div class="to_demo_columns3 to_demo_accent2_bg to_demo_inverse_block">
							<h4 class="to_demo_accent2_hover_bg to_demo_inverse_dark"><?php esc_html_e('Accented block header','yacht-rental');?></h4>
							<div>
								<p class="to_demo_inverse_light"><?php esc_html_e('Posted','yacht-rental');?> <span class="to_demo_inverse_link"><?php esc_html_e('12 May, 2015','yacht-rental');?></span> <?php esc_html_e('by','yacht-rental');?> <span class="to_demo_inverse_hover"><?php esc_html_e('Author name hovered','yacht-rental');?></span>.</p>
								<p class="to_demo_inverse_text"><?php esc_html_e('This is a inversed colors example for the normal text','yacht-rental');?></p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link"><?php esc_html_e('link example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_inverse_hover"><?php esc_html_e('hovered link','yacht-rental');?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($scheme['accent3'])) { ?>
						<div class="to_demo_columns3 to_demo_accent3_bg to_demo_inverse_block">
							<h4 class="to_demo_accent3_hover_bg to_demo_inverse_dark"><?php esc_html_e('Accented block header','yacht-rental');?></h4>
							<div>
								<p class="to_demo_inverse_light"><?php esc_html_e('Posted','yacht-rental');?> <span class="to_demo_inverse_link"><?php esc_html_e('12 May, 2015','yacht-rental');?></span> <?php esc_html_e('by','yacht-rental');?> <span class="to_demo_inverse_hover"><?php esc_html_e('Author name hovered','yacht-rental');?></span>.</p>
								<p class="to_demo_inverse_text"><?php esc_html_e('This is a inversed colors example for the normal text','yacht-rental');?></p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link"><?php esc_html_e('link example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_inverse_hover"><?php esc_html_e('hovered link','yacht-rental');?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php 
					break;
				}
			}
			?>
	
			<h3 class="to_demo_header"><?php esc_html_e('Alternative colors used to decorate highlight blocks and form fields','yacht-rental');?></h3>
			<div class="to_demo_columns2">
				<div class="to_demo_alter_block">
					<h4 class="to_demo_alter_header"><?php esc_html_e('Highlight block header','yacht-rental');?></h4>
					<p class="to_demo_alter_text"><?php esc_html_e('This is a plain text in the highlight block. This is a plain text in the highlight block.','yacht-rental');?></p>
					<p class="to_demo_alter_text"><span class="to_demo_alter_link"><?php esc_html_e('link example','yacht-rental');?></span> <?php esc_html_e('and','yacht-rental');?> <span class="to_demo_alter_hover"><?php esc_html_e('hovered link','yacht-rental');?></span></p>
				</div>
			</div>
			<div class="to_demo_columns2">
				<div class="to_demo_form_fields">
					<h4 class="to_demo_header"><?php esc_html_e('Form field','yacht-rental');?></h4>
					<input type="text" class="to_demo_field" value="<?php esc_attr_e('Input field example','yacht-rental');?>">
					<h4 class="to_demo_header"><?php esc_html_e('Form field focused','yacht-rental');?></h4>
					<input type="text" class="to_demo_field_focused" value="<?php esc_attr_e('Focused field example','yacht-rental');?>">
				</div>
			</div>
		</div>
	</div>
</div>
