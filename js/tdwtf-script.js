(function($){
	$('#tdwtf-widget-previous-article').on('click', function(){
		var id = $(this).data('id');

		$.ajax({
			url: ajax.url,
			type: 'POST',
			data: {
				action: 'tdwtf_widget_get_article_by_id',
				id: id
			},
			success: function(article)
			{
				if(article != null)
				{
					reloadArticle(article);
				}
			}
		});
	});

	$('#tdwtf-widget-next-article').on('click', function(){
		var id = $(this).data('id');

		$.ajax({
			url: ajax.url,
			type: 'POST',
			data: {
				action: 'tdwtf_widget_get_article_by_id',
				id: id
			},
			success: function(article)
			{
				if(article != null)
				{
					reloadArticle(article);
				}
			}
		});
	});

	function reloadArticle( article ){

		if(article.previous_article_id != null)
		{
			$('#tdwtf-widget-previous-article').data( 'id', article.previous_article_id).show();
		}
		else
		{
			$('#tdwtf-widget-previous-article').hide();
		}

		if(article.next_article_id != null)
		{
			$('#tdwtf-widget-next-article').data( 'id', article.next_article_id).show();
		}
		else
		{
			$('#tdwtf-widget-next-article').hide();
		}

		$('.tdwtf-widget-summary').html( article.summary_html );
		$('.tdwtf-widget-author').html( article.author.name );
		$('.tdwtf-widget-article-date').html( article.display_date );
		$('.tdwtf-widget-article-link').attr( 'href', article.url );

		$('.tdwtf-widget-title')
			.attr( 'href', article.url)
			.html( article.title );

		$('.tdwtf-widget-comment-link')
			.attr( 'href', article.comment_url )
			.html( '<span class="dashicons dashicons-admin-comments"></span> ' + article.comment_count );
	}

})(jQuery);