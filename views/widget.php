<?php /** @var \TDWTFWidget\Article $article */ ?>

<section class="tdwtf-widget-wrapper">
	<h3 class="tdwtf-widget-header">
		<a href="<?php echo $article->url; ?>" class="tdwtf-widget-title"><?php echo $article->title; ?></a>
		<a href="<?php echo $article->comment_url ?>" class="tdwtf-widget-comment-link">
			<span class="dashicons dashicons-admin-comments"></span> <?php echo $article->comment_count; ?>
		</a>
	</h3>
	<div class="tdwtf-widget-summary-wrapper">
		<div class="tdwtf-widget-summary">
			<?php echo $article->summary_html; ?>
		</div>
		<div class="tdwtf-widget-summary-footer">
			<a id="tdwtf-widget-previous-article"
				<?php if($article->previous_article_id != NULL){ ?>
					data-id="<?php echo $article->previous_article_id; ?>"
				<?php }else{ ?>
					style="display: none;"
				<?php } ?>>
				<span class="dashicons dashicons-arrow-left-alt2"></span>
			</a>

			<a href="<?php echo $article->url; ?>" target="_blank" class="tdwtf-widget-article-link">Read More</a>

			<a id="tdwtf-widget-next-article"
				<?php if($article->next_article_id != NULL){ ?>
					data-id="<?php echo $article->next_article_id; ?>"
				<?php }else{ ?>
					style="display: none;"
				<?php } ?>>
				<span class="dashicons dashicons-arrow-right-alt2"></span>
			</a>
		</div>
	</div>
	<div class="tdwtf-widget-footer">
		<span class="tdwtf-widget-author-wrapper">
			by <span class="tdwtf-widget-author"><?php echo $article->author->name; ?></span>
		</span>
		<span class="tdwtf-widget-article-date">
			<?php echo $article->display_date; ?>
		</span>
	</div>
</section>
