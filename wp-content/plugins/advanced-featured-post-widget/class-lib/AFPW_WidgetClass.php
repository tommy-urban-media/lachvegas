<?php

/**
 *
 * Class AFPW Widget
 *
 * @ Advanced Featured Post Widget
 *
 * building the actual widget
 *
 */
class Advanced_Featured_Post_Widget extends A5_Widget {
	
	private static $options;
	
	function __construct() {
		 
		$widget_opts = array( 'description' => __('You can feature a certain post in this widget and display it, where and however you want, in your widget areas. A backup post can be given to avoid dubble content. Define, on what pages the widget will show.', 'advanced-fpw') );
		 
		$control_opts = array( 'width' => 400 );
		 
		parent::__construct(false, $name = 'Advanced Featured Post', $widget_opts, $control_opts);
		
		self::$options = get_option('afpw_options');
		 
	 }
	 
	function form($instance) {
		
	// setup some default settings
		
		$defaults = array(
			'title' => NULL,
			'article' => NULL,
			'backup' => NULL,
			'id' => NULL,
			'bid' => NULL,
			'image' => NULL,
			'width' => get_option('thumbnail_size_w'),
			'headline' => NULL,
			'h' => 3,
			'excerpt' => NULL,
			'linespace' => false,
			'alignment' => NULL,
			'noshorts' => false,
			'readmore' => false,
			'rmtext' => NULL,
			'thumb' => false,
			'style' => NULL,
			'homepage' => true,
			'frontpage' => false,
			'page' => false, 
			'category' => true,
			'single' => false,
			'date' => false,
			'archive' => false,
			'tag' => false,
			'attachment' => false,
			'taxonomy' => false,
			'author' => false,
			'search' => false,
			'not_found' => false,
			'login_page' => false,
			'rmclass' => NULL,
			'filter' => false,
			'showcat' => NULL,
			'showcat_txt'=> NULL,
			'imgborder' => NULL,
			'fullpost' => false,
			'wordcount' => 3,
			'words' => false
		);
		
		$instance = wp_parse_args( $instance, $defaults );
		
		$title = esc_attr($instance['title']);
		$thumb = esc_attr($instance['thumb']);
		$image = esc_attr($instance['image']);
		$article = esc_attr($instance['article']);
		$backup = esc_attr($instance['backup']);
		$width = esc_attr($instance['width']);
		$headline = esc_attr($instance['headline']);	
		$excerpt = esc_attr($instance['excerpt']);
		$linespace = esc_attr($instance['linespace']);
		$alignment = esc_attr($instance['alignment']);
		$noshorts = esc_attr($instance['noshorts']);
		$readmore = esc_attr($instance['readmore']);
		$rmtext = esc_attr($instance['rmtext']);
		$style = esc_attr($instance['style']);
		$homepage = $instance['homepage'];
		$frontpage = $instance['frontpage'];
		$page = $instance['page'];
		$category = $instance['category'];
		$single = $instance['single'];
		$date = $instance['date'];
		$archive = $instance['archive'];
		$tag = $instance['tag'];
		$attachment = $instance['attachment'];
		$taxonomy = $instance['taxonomy'];
		$author = $instance['author'];
		$search = $instance['search'];
		$not_found = $instance['not_found'];
		$login_page = $instance['login_page'];
		$h=esc_attr($instance['h']);
		$rmclass=esc_attr($instance['rmclass']);
		$filter=esc_attr($instance['filter']);
		$id=esc_attr($instance['id']);
		$bid=esc_attr($instance['bid']);
		$showcat = esc_attr($instance['showcat']);
		$showcat_txt = esc_attr($instance['showcat_txt']);
		$imgborder = esc_attr($instance['imgborder']);
		$fullpost = esc_attr($instance['fullpost']);
		$wordcount = esc_attr($instance['wordcount']);
		$words = esc_attr($instance['words']);
		
		$args = array(
			'posts_per_page' => -1,
			'post_status' => 'publish'
		);
		
		$features = get_posts($args);
		
		foreach ( $features as $feature ) :
		
			$posts[] = array($feature->ID, $feature->post_title );
		
		endforeach;
		
		$base_id = 'widget-'.$this->id_base.'-'.$this->number.'-';
		$base_name = 'widget-'.$this->id_base.'['.$this->number.']';
		
		$options = array (array('top', __('Above thumbnail', 'advanced-fpw')) , array('bottom', __('Under thumbnail', 'advanced-fpw')), array('none', __('Don&#39;t show title', 'advanced-fpw')));
		
		a5_text_field($base_id.'title', $base_name.'[title]', $title, __('Title:', 'advanced-fpw'), array('space' => true, 'class' => 'widefat'));
		a5_select($base_id.'article', $base_name.'[article]', $posts, $article, __('Choose here the post, you want to appear in the widget.', 'advanced-fpw'), __('Take a random post', 'advanced-fpw'), array('space' => true, 'class' => 'widefat'));
		a5_select($base_id.'backup', $base_name.'[backup]',$posts,  $backup, __('Choose here the backup post. It will appear, when a single post page shows the featured article.', 'advanced-fpw'), __('Take a random post', 'advanced-fpw'), array('space' => true, 'class' => 'widefat'));
		a5_number_field($base_id.'id', $base_name.'[id]', $id, __('Post ID (if you want a custom post type or simply don&#39;t want to use the dropdown menu):', 'advanced-fpw'), array('space' => true, 'size' => 4, 'step' => 1));
		a5_number_field($base_id.'bid', $base_name.'[bid]', $bid, __('ID for backup post (if you want a custom post type or simply you don&#39;t want to use the dropdown menu):', 'advanced-fpw'), array('space' => true, 'size' => 4, 'step' => 1));
		a5_checkbox($base_id.'showcat', $base_name.'[showcat]', $showcat, __('Check to show the categories in which the post is filed.', 'advanced-fpw'), array('space' => true));
		a5_text_field($base_id.'showcat_txt', $base_name.'[showcat_txt]', $showcat_txt, __('Give some text that you want in front of the post&#39;s categtories (i.e &#39;filed under&#39;:', 'advanced-fpw'), array('space' => true, 'class' => 'widefat'));
		a5_checkbox($base_id.'image', $base_name.'[image]', $image, __('Check to get the first image of the post as thumbnail.', 'advanced-fpw'), array('space' => true));
		a5_number_field($base_id.'width', $base_name.'[width]', $width, __('Width of the thumbnail (in px):', 'advanced-fpw'), array('space' => true, 'size' => 4, 'step' => 1));
		a5_text_field($base_id.'imgborder', $base_name.'[imgborder]', $imgborder, sprintf(__('If wanting a border around the image, write the style here. %s would make it a black border, 1px wide.', 'advanced-fpw'), '<strong>1px solid #000000</strong>'), array('space' => true, 'class' => 'widefat'));
		a5_checkbox($base_id.'thumb', $base_name.'[thumb]', $thumb, sprintf(__('Check to %snot%s display the thumbnail of the post.', 'advanced-fpw'), '<strong>', '</strong>'), array('space' => true));
		a5_select($base_id.'headline', $base_name.'[headline]', $options, $headline, __('Choose, whether or not to display the title and whether it comes above or under the thumbnail.', 'advanced-fpw'), false, array('space' => true));
		parent::select_heading($instance);
		a5_textarea($base_id.'excerpt', $base_name.'[excerpt]', $excerpt, __('If the excerpt of the post is not defined, by default the first 3 sentences of the post are shown. You can enter your own excerpt here, if you want.', 'advanced-fpw'), array('space' => true, 'class' => 'widefat', 'style' => 'height: 60px;'));
		a5_number_field($base_id.'wordcount', $base_name.'[wordcount]', $wordcount, __('In case there is no excerpt defined, how many sentences are displayed:', 'advanced-fpw'), array('space' => true, 'size' => 4, 'step' => 1));
		a5_checkbox($base_id.'words', $base_name.'[words]', $words, __('Check to display words instead of sentences.', 'advanced-fpw'), array('space' => true));
		a5_checkbox($base_id.'fullpost', $base_name.'[fullpost]', $fullpost, __('Check to display the full post instead of an excerpt.', 'advanced-fpw'), array('space' => true));
		a5_checkbox($base_id.'linespace', $base_name.'[linespace]', $linespace, __('Check to have each sentence in a new line.', 'advanced-fpw'), array('space' => true));
		parent::textalign($instance);
		a5_checkbox($base_id.'noshorts', $base_name.'[noshorts]', $noshorts, __('Check to suppress shortcodes in the widget (in case the content is showing).', 'advanced-fpw'), array('space' => true));
		a5_checkbox($base_id.'filter', $base_name.'[filter]', $filter, __('Check to return the excerpt unfiltered (might avoid interferences with other plugins).', 'advanced-fpw'), array('space' => true));
		parent::read_more($instance);	
		parent::page_checkgroup($instance);
		a5_textarea($base_id.'style', $base_name.'[style]', $style, sprintf(__('Here you can finally style the widget. Simply type something like%1$s%2$sborder: 2px solid;%2$sborder-color: #cccccc;%2$spadding: 10px;%3$s%2$sto get just a gray outline and a padding of 10 px. If you leave that section empty, your theme will style the widget.', 'advanced-fpw'), '<strong>', '<br />', '</strong>'), array('space' => true, 'class' => 'widefat', 'style' => 'height: 60px;'));
		a5_resize_textarea(array($base_id.'excerpt', $base_id.'style'), true);
	
	}
	 
	function update($new_instance, $old_instance) {
		
		unset(self::$options['cache'][$this->number]);
		
		global $wpdb;
		
		$update_args = array('option_value' => serialize(self::$options));
		
		$result = $wpdb->update( $wpdb->options, $update_args, array( 'option_name' => 'afpw_options' ) );
		 
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['article'] = strip_tags($new_instance['article']);
		$instance['backup'] = strip_tags($new_instance['backup']);	 
		$instance['thumb'] = @$new_instance['thumb'];	 
		$instance['image'] = @$new_instance['image'];	 
		$instance['width'] = strip_tags($new_instance['width']);	 
		$instance['headline'] = strip_tags($new_instance['headline']);
		$instance['excerpt'] = strip_tags($new_instance['excerpt']);
		$instance['linespace'] = @$new_instance['linespace'];
		$instance['alignment'] = strip_tags($new_instance['alignment']);
		$instance['noshorts'] = @$new_instance['noshorts'];
		$instance['readmore'] =@$new_instance['readmore'];
		$instance['rmtext'] = strip_tags($new_instance['rmtext']);
		$instance['style'] = strip_tags($new_instance['style']);
		$instance['homepage'] = @$new_instance['homepage'];
		$instance['frontpage'] = @$new_instance['frontpage'];
		$instance['page'] = @$new_instance['page'];
		$instance['category'] = @$new_instance['category'];
		$instance['single'] = @$new_instance['single'];
		$instance['date'] = @$new_instance['date'];
		$instance['archive'] = @$new_instance['archive'];
		$instance['tag'] = @$new_instance['tag'];
		$instance['attachment'] = @$new_instance['attachment'];
		$instance['taxonomy'] = @$new_instance['taxonomy'];
		$instance['author'] = @$new_instance['author'];
		$instance['search'] = @$new_instance['search'];
		$instance['not_found'] = @$new_instance['not_found'];
		$instance['login_page'] = @$new_instance['login_page'];
		$instance['h'] = strip_tags($new_instance['h']);
		$instance['rmclass'] = strip_tags($new_instance['rmclass']);
		$instance['filter'] = @$new_instance['filter'];
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['bid'] = strip_tags($new_instance['bid']);
		$instance['showcat'] = @$new_instance['showcat'];
		$instance['showcat_txt'] = strip_tags($new_instance['showcat_txt']);
		$instance['imgborder'] = strip_tags($new_instance['imgborder']);
		$instance['fullpost'] = @$new_instance['fullpost'];
		$instance['wordcount'] = strip_tags($new_instance['wordcount']);
		$instance['words'] = @$new_instance['words'];
		
		return $instance;
	}
	
	function widget($args, $instance) {
		
		$show_widget = parent::check_output($instance);
			
		if ($show_widget) :
			
			$eol = "\n";
			
			// the widget is displayed	
			extract( $args );
			
			$title = apply_filters('widget_title', $instance['title']);
			
			if (!empty($instance['style'])) :
			
				$style=str_replace(array("\r\n", "\n", "\r"), '', $instance['style']);
				
				$before_widget = str_replace('>', 'style="'.$style.'">', $before_widget);
			
			endif;
				
			// widget starts
			
			echo $before_widget.$eol;
			
			if ( $title ) echo $before_title . $title . $after_title . $eol;
			
			global $wp_query, $post;
			
			$article = ($instance['id']) ? $instance['id'] : $instance['article'];
			$backup = ($instance['bid']) ? $instance['bid'] : $instance['backup'];
			
			$current_post = $wp_query->get_queried_object_id();
			
			$afpw_setup['p'] = ($current_post == $article) ? (int)$backup : (int)$article;
				
			if (empty($afpw_setup['p'])) :
			
				$afpw_setup['posts_per_page'] = 1;
			
				$afpw_setup['orderby'] = 'rand';
				
				$afpw_setup['post__not_in'] = array($current_post);
				
			else :
			
				$afpw_setup['post_type'] = 'any';
				
			endif;
		 
			/* This is the actual function of the plugin, it fills the widget with the customized post */
		
			$afpw_posts = new WP_Query($afpw_setup);
			
			while($afpw_posts->have_posts()) :
			
				$afpw_posts->the_post();
				
				setup_postdata($post);
				
				if ($instance['showcat']) :
					
					$post_byline = ($instance['showcat_txt']) ? $eol.'<p id="afpw_byline-'.$widget_id.'">'.$eol.$instance['showcat_txt'].' ' : $eol.'<p id="afpw_byline-'.$widget_id.'">';
					
					echo $post_byline;
				
					the_category(', ');
				
					echo $eol.'</p>'.$eol;
				
				endif;
				
				if (isset(self::$options['cache'][$this->number][$post->ID]['tags'])) :
				
					$afpw_tags = self::$options['cache'][$this->number][$post->ID]['tags'];
				
				else :
			 
					$afpw_tags = A5_Image::tags();
					
					self::$options['cache'][$this->number][$post->ID]['tags'] = $afpw_tags;
					
					update_option('afpw_options', self::$options);
					
				endif;
				
				$afpw_image_alt = $afpw_tags['image_alt'];
				$afpw_image_title = $afpw_tags['image_title'];
				$afpw_title_tag = $afpw_tags['title_tag'];
				
				// headline, if wanted
				
				if ($instance['headline'] != 'none') :
				
					$afpw_style = ($instance['alignment'] != 'notext' && $instance['alignment'] != 'none') ? ' style="text-align: '.$instance['alignment'].';"' : '';
				
					$afpw_headline = '<h'.$instance['h'].$afpw_style.'>'.$eol.'<a href="'.get_permalink().'" title="'.$afpw_title_tag.'">'.get_the_title().'</a>'.$eol.'</h'.$instance['h'].'>';
					
				endif;
				
				// thumbnail, if wanted
			
				if (!$instance['thumb']) :
				
					if (isset(self::$options['cache'][$this->number][$post->ID]['image'])) :
			
						$afpw_image = self::$options['cache'][$this->number][$post->ID]['image'];
					
					else :
					
						$afpw_image = false;
				
						$afpw_imgborder = (!empty($instance['imgborder'])) ? ' style="border: '.$instance['imgborder'].';"' : '';
						
						$afpw_float = ($instance['alignment'] != 'notext') ? $instance['alignment'] : 'none';
						
						$afpw_margin = '';
							if ($instance['alignment'] == 'left') $afpw_margin = ' margin-right: 1em;';
							if ($instance['alignment'] == 'right') $afpw_margin = ' margin-left: 1em;';
						
						$number = ($instance['image']) ? $instance['image'] : NULL;
						
						$args = array (
							'id' => $post->ID,
							'width' => $instance['width'],
							'number' => $number
						);	
					   
						$afpw_image_info = A5_Image::thumbnail($args);
						
						$afpw_thumb = $afpw_image_info[0];
						
						$afpw_width = $afpw_image_info[1];
				
						$afpw_height = ($afpw_image_info[2]) ? ' height="'.$afpw_image_info[2].'"' :'';
						
						if ($afpw_thumb) $afpw_img_tag = '<img title="'.$afpw_image_title.'" src="'.$afpw_thumb.'" alt="'.$afpw_image_alt.'" class="wp-post-image" width="'.$afpw_width.'"'.$afpw_height.'style="float: '.$afpw_float.';'.$afpw_margin.$afpw_imgborder.'" />';
							
						if (!empty($afpw_img_tag)) $afpw_image = '<a href="'.get_permalink().'">'.$afpw_img_tag.'</a>'.$eol;
						
						if ($instance['alignment'] == 'none' || $instance['alignment'] == 'notext') $afpw_image .= '<div style="clear: both;"></div>'.$eol;
						
						self::$options['cache'][$this->number][$post->ID]['image'] = $afpw_image;
					
						update_option('afpw_options', self::$options);
						
					endif;
					
				endif;
				
				// excerpt if wanted
				
				$afpw_float = ($instance['alignment'] != 'notext') ? $instance['alignment'] : 'none';
					
				$afpw_margin = '';
				if ($instance['alignment'] == 'left') $afpw_margin = ' margin-right: 1em;';
				if ($instance['alignment'] == 'right') $afpw_margin = ' margin-left: 1em;';
				
				if ($instance['alignment'] != 'notext') :
				
					if (isset(self::$options['cache'][$this->number][$post->ID]['text'])) :
				
						$afpw_text = self::$options['cache'][$this->number][$post->ID]['text'];
					
					else :
					
						$rmtext = ($instance['rmtext']) ? $instance['rmtext'] : '[&#8230;]';
						
						$shortcode = ($instance['noshorts']) ? false : true;
						
						$filter = ($instance['filter']) ? false : true;
					
						$args = array(
							'usertext' => $instance['excerpt'],
							'excerpt' => $post->post_excerpt,
							'content' => $post->post_content,
							'shortcode' => $shortcode,
							'count' => $instance['wordcount'],
							'linespace' => $instance['linespace'],
							'link' => get_permalink(),
							'title' => $afpw_title_tag,
							'readmore' => $instance['readmore'],
							'rmtext' => $rmtext,
							'class' => $instance['rmclass'],
							'filter' => $filter
						);
						
						if (!empty($instance['fullpost'])) $args['type'] = 'post';
						
						if (!empty($instance['words'])) $args['type'] = 'words';
				
						$afpw_text = A5_Excerpt::text($args);
						
						self::$options['cache'][$this->number][$post->ID]['text'] = $afpw_text;
					
						update_option('afpw_options', self::$options);
					
					endif;
				
				endif;
				
				// writing the stuff in the widget
				
				if ($instance['headline'] == 'top') echo $afpw_headline.$eol;
				
				if (!$instance['thumb'] && !empty($afpw_image)) echo $afpw_image;
				
				if ($instance['headline'] == 'bottom') echo $afpw_headline.$eol;
				
				if ($instance['alignment'] == 'left' || $instance['alignment'] == 'right') echo $eol.do_shortcode($afpw_text).$eol;
				
				if ($instance['alignment'] == 'none') echo do_shortcode($afpw_text).$eol;
				
			endwhile;
			
			wp_reset_postdata();
		
			echo $after_widget.$eol;
				
		else:
	
			echo "<!-- Advanced Featured Post Widget is not setup for this view. -->";
		 
		endif;
	
	} // widget
 
} // Advanced Featured Post Widget

add_action('widgets_init', create_function('', 'return register_widget("Advanced_Featured_Post_Widget");'));

?>