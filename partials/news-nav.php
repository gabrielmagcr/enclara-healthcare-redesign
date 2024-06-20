



<nav class="news-nav">
	<div class="inner">
		
		<div class="news-nav--categories">
			<ul class="blog-filters_catmenu">
				<li class="<?php if (!is_archive()) { echo 'blog-filters_current'; } ?>">
					<a href="<?php echo get_site_url().'/media'; ?>">All</a>
				</li>
				<?php 
				$blog_cats = get_categories();
				$current_cat = single_cat_title('', false);
				
				foreach($blog_cats as $cat) { 
					$current_class = '';
					if ($current_cat === $cat->name) {
						$current_class = 'blog-filters_current';
					}
					echo '<li class="'.$current_class.'"><a href="'.get_category_link($cat->cat_ID).'">'.$cat->name.'</a></li>';
				} ?>
			</ul>
		</div>

	</div>
</nav>
