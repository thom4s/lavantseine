<?php
if ( ! defined('IS_MOBILE') ):
	$always_open = true;
else :
	$always_open = false;
endif;
?>
			<div class="sidebar-filter">
				<div class="sidebar-filter-content filter-dashboard clearfix">
					<h2 class="sidebar-filter-title filter-dashboard-title"><strong>Ma recherche</strong></h2>
					<?php
					wp_reset_query();
					if ( get_query_var('ou') || get_query_var('quoi') || get_query_var('quand') ) :
					?> 
					<div class="sidebar-filter-content-inner clearfix">
						<ul class="no-bullet sidebar-filter-list">
							<?php
							if ( get_query_var('ou') ):
								switch(get_query_var('ou')):
									case 'hors-les-murs':
										$url = mahi_remove_query_path(null, 'ou', 'hors-les-murs');
										?>
										<li class="sidebar-filter-dashboard">
											<a href="<?php print $url ?>">
												Hors des murs
											</a>
										</li>
										<?php
									break;
									default:
										$term = get_term_by('slug', get_query_var('ou'), 'place');
										$url = mahi_remove_query_path(null, 'ou', $term->slug);
										?>
										<li class="sidebar-filter-dashboard">
											<a href="<?php print $url ?>">
												<?php print $term->name ?>
											</a>
										</li>
										<?php
									break;
									case 'maison-europeenne-de-la-photographie':
										$url = mahi_remove_query_path(null, 'ou', $term->slug);
										?>
										<li class="sidebar-filter-dashboard">
											<a href="<?php print $url ?>">
												A la MEP
											</a>
										</li>
										<?php
									break;
								endswitch;
							endif;

							if ( get_query_var('quoi') ):
								$terms = preg_split("#,#", get_query_var('quoi'), -1, PREG_SPLIT_NO_EMPTY);
								sort($terms);
								foreach($terms as $term):
									$term = get_term_by('slug', $term, 'event_category');
									$t = implode(',', array_diff($terms, array($term->slug)));
									$url = mahi_add_query_path(null, 'quoi', $t);
									?>
									<li class="sidebar-filter-dashboard">
										<a href="<?php print $url ?>">
											<?php print $term->name ?>
										</a>
									</li>
									<?php
								endforeach;
							endif;

							
							switch ( get_query_var('quand') ):
								case '-':
									$quand_url = mahi_remove_query_path(null, 'quand', get_query_var('quand'));
									$quand_title = "Tous";
								break;
								case '':
								case null:
									// $quand_url = mahi_add_query_path(null, 'quand', '-');
									// $quand_title = "A venir";
								break;
								default:
									if ( preg_match("#\d+\-\d+?#", get_query_var('quand') ) ):
										$quand_url = mahi_remove_query_path(null, 'quand', get_query_var('quand'));
										$quand_title = "Au mois de ".strftime('%B %Y', strtotime(get_query_var('quand')));
									else:
										$quand_url = mahi_remove_query_path(null, 'quand', get_query_var('quand'));
										$quand_title = "Au cours de l'année ".get_query_var('quand');
									endif;

								break;
							endswitch;

							if ( $quand_title ):
								?>
								<li class="sidebar-filter-dashboard">
									<a href="<?php print $quand_url ?>">
										<?php print $quand_title ?>
									</a>
								</li>
								<?php
							endif;


							if ( get_query_var('q') ):
								$url = mahi_remove_query_path(null, 'q');
								?>
								<li class="sidebar-filter-dashboard">
									<a href="<?php print $url ?>">
										<?php print get_query_var('q') ?>
									</a>
								</li>
								<?php
							endif;
							?>
						</ul>
					</div><!-- .sidebar-filter-content-inner -->
					<?php
						endif;
					?>
				</div><!-- .sidebar-filter-content -->

				<div class="sidebar-filter-content clearfix">
					<h2 class="sidebar-filter-title <?php print $always_open ? 'sidebar-filter-opened' : '' ?>"><strong>Type d'événements</strong></h2>
					<div class="sidebar-filter-content-inner clearfix" <?php print $always_open ? 'style="display:block;"' : '' ?>>
						<ul class="no-bullet sidebar-filter-list">
							<?php
							$terms = preg_split("#,#", get_query_var('quoi'), -1, PREG_SPLIT_NO_EMPTY);
							foreach(get_terms('event_category') as $term):
								if ( in_array($term->slug, $terms) )
									$t = array_diff($terms, array($term->slug));
								else
									$t = array_merge($terms, array($term->slug));
								sort($t);
								$url = mahi_add_query_path(null, 'quoi', implode(',', $t));
								?>
								<li class="sidebar-filter-item <?php print in_array($term->slug, $terms) ? 'active' : '' ?>">
									<a href="<?php print $url ?>">
										<?php print $term->name ?>
									</a>
								</li>
								<?php
							endforeach;
							?>
						</ul>
					</div><!-- .sidebar-filter-content-inner -->
				</div><!-- .sidebar-filter-content -->

				<div class="sidebar-filter-content clearfix">
					<h2 class="sidebar-filter-title <?php print $always_open || get_query_var('quand') ? 'sidebar-filter-opened' : '' ?>"><strong>Date</strong></h2>
					<div class="sidebar-filter-content-inner clearfix" <?php print $always_open || get_query_var('quand') ? 'style="display:block;"' : '' ?>>
						<form name="sidebar-filter-date" class="sidebar-filter-date clearfix">
							<?php
							if ( preg_match("#\d+(\-\d+)?#", get_query_var('quand') ) ):
								list($curYear, $curMonth) = explode('-', get_query_var('quand') );
							else:
								// $curYear = date('Y');
								// $curMonth = date('m');
							endif;
							?>
							<select name="filter-year" class="custom-select custom-filter-select" id="filter-year">
								<option value="">Année</option>
								<?php
								for($i = constant('MEP_PROGRAMMATION_FIRST_YEAR');$i < date('Y')+3; $i++):
									?>
									<option value="<?php print mahi_add_query_path(null, 'quand', $i) ?>" <?php print $i == $curYear ? 'selected' : '' ?>><?php print $i ?></option>
									<?php
								endfor;
								?>
							</select>
							<div class="left filter-month-container">
								<select name="filter-month" class="custom-select custom-filter-select" id="filter-month">
									<option value="">Mois</option>
									<?php
									if ( ! $curYear )
										$curYear = date('Y');
									for($i = 1;$i <= 12; $i++):
										$date = $curYear.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
										?>
										<option value="<?php print mahi_add_query_path(null, 'quand', $date) ?>" <?php print $date == get_query_var('quand') ? 'selected' : '' ?>><?php print strftime('%B', strtotime($date)) ?></option>
										<?php
									endfor;
									?>
								</select>
							</div><!-- .filter-month-container -->
						</form>
						<?php
						if ( get_query_var('quand') ):
							?>
							<ul class="no-bullet sidebar-filter-list">
								<li class="sidebar-filter-item <?php print in_array($term->slug, $terms) ? 'active' : '' ?>">
									<a href="<?php print mahi_remove_query_path(null, 'quand', get_query_var('quand'))?>">
										Retour aux événements en cours et à venir.
									</a>
								</li>
							</ul>
							<?php
						endif;
						?>
					</div><!-- .sidebar-filter-content-inner -->
				</div><!-- .sidebar-filter-content -->

				<div class="sidebar-filter-content clearfix">
					<h2 class="sidebar-filter-title <?php print $always_open ? 'sidebar-filter-opened' : '' ?>"><strong>Lieux</strong></h2>
					<div class="sidebar-filter-content-inner clearfix" <?php print $always_open ? 'style="display:block;"' : '' ?>>
						<ul class="no-bullet sidebar-filter-list">
							<li class="sidebar-filter-item <?php print get_query_var('ou') == 'maison-europeenne-de-la-photographie' ? 'active' : '' ?>">
								<a href="<?php print mahi_add_query_path(null, 'ou', 'maison-europeenne-de-la-photographie') ?>">
									à la MEP
								</a>
							</li>
							<li class="sidebar-filter-item <?php print get_query_var('ou') == 'hors-les-murs' ? 'active' : '' ?>">
								<a href="<?php print mahi_add_query_path(null, 'ou', 'hors-les-murs') ?>">
									Hors les murs
								</a>
							</li>
							<li class="sidebar-filter-item <?php print get_query_var('ou') == 'virtuelle' ? 'active' : '' ?>">
								<a href="<?php print mahi_add_query_path(null, 'ou', 'virtuelle') ?>">
									Virtuelle
								</a>
							</li>
						</ul>
					</div><!-- .sidebar-filter-content-inner -->
				</div><!-- .sidebar-filter-content -->

				<div class="sidebar-filter-content sidebar-filter-search clearfix">
					<h2 class="sidebar-filter-title sidebar-filter-search-title sidebar-filter-opened"><strong>Recherche</strong></h2>
					<div class="sidebar-filter-content-inner clearfix" style="display:block;">
						<form id="sidebar-filter-search-form" name="sidebar-filter-search-form" class="sidebar-filter-search-form" action="<?php print mahi_remove_query_path(null, 'quoi') ?>">
							<input type="text" value="<?php print get_query_var('q') ?>" name="search" class="sidebar-filter-search-form-field" />
							<button type="submit" class="sidebar-filter-search-form-button">
								Rechercher
							</button>
						</form>
					</div><!-- .sidebar-filter-content-inner -->
				</div><!-- .sidebar-filter-content -->

			</div><!-- .sidebar-filter -->