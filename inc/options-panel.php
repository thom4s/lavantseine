<?php 


add_action('admin_menu', 'options_panel');

function options_panel() {
	add_menu_page('Options', 'Options', 'activate_plugins', 'options-panel', 'render_panel', null, 75);
}

function render_panel() {
	if ( isset($_POST) ) {
		if( !wp_verify_nonce($_POST['_optionsnonce'], 'my-nonce') ) {
		}	
		foreach ($_POST['options'] as $name => $value) {
			if ( empty($value) ) {
				delete_option($name);
			} else {
				update_option( $name, $value );
			}
		}
		if ($_POST['showAlert']=='on') { $display = 'checked'; } else { $display = ''; }  
    	update_option('showAlert',    $display); 

		?>
		<div id="message" class="update fade">
			<p>Options sauvegardées</p>
		</div>

		<?php
	}
	?>

	<div class="wrap theme-options-page">
		<div id="icon-options-general" class="wp-menu-image"><br></div>
		<h2>Options de l'Avant Seine</h2>
		<form action="" method="post">

			<div class="theme-options-group">
				<table cellspacing="0" class="form-table">
					<tbody>

						<!-- MESSAGE D'ALERTE -->
						<tr valign="top">
							<th scope="row">
								<label for="">Message</label>
							</th>
							<td>
								<textarea row="100" cols="100" id="alerteMessage" name="options[alerteMessage]" value=""><?php echo get_option('alerteMessage', ''); ?></textarea>
								<br /><span class="description">pour intégrer des balises dans le texte d'alerte, utilisez : </span>
								<pre>&lt;span style="color: #f00; font-size: 1.2em;"&gt;En rouge et plus gros&lt;/span&gt;</pre>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
								<label for="">Activer</label>
							</th>
							<td>
								<input type="checkbox" id="showAlert" name="showAlert" <?php echo get_option('showAlert', ''); ?> >
							</td>
						</tr>


						<!-- ID FILTRES -->
						<tr valign="top">
							<th scope="row">
								<label for="">ID filtre PROGRAMMATION</label>
							</th>
							<td>
								<input type="text" id="progFilterID" name="options[progFilterID]" value="<?php echo get_option('progFilterID', ''); ?>">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">
								<label for="">ID filtre MAGAZINE</label>
							</th>
							<td>
								<input type="text" id="magFilterID" name="options[magFilterID]" value="<?php echo get_option('magFilterID', ''); ?>">
							</td>
						</tr>

					</tbody>
				</table><!-- .form-table  -->
			</div><!-- .them-option-group -->
			<input type="hidden" name="_optionsnonce" value="<?php echo wp_create_nonce('my-nonce'); ?>">

			<p class="submit">
				<input type="submit" name="panel_update" class="button button-primary" value="Sauvegarder">
			</p>

		</form><!-- .wrap -->
	</div><!-- .wrap -->

	<?php
}


















