<?php


namespace TDWTFWidget;


class Controller{

	private $attributes;

	/**
	 * Initiates general functions not specific to admin
	 */
	public function init()
	{
		/** Register shortcode */
		add_shortcode ( 'tdwtf_widget', array( $this, 'shortCode') );

		add_action( 'wp_enqueue_scripts', function(){
			wp_enqueue_media();
			wp_enqueue_style( 'tdwtf-styles', TDWTF_PLUGIN_DIR . 'css/tdwtf-styles.css' );
			wp_enqueue_script( 'tdwtf-script', TDWTF_PLUGIN_DIR . 'js/tdwtf-script.js', array( 'jquery' ), FALSE, TRUE );
			wp_localize_script( 'tdwtf-script', 'ajax', ['url' => admin_url( 'admin-ajax.php' )] );
		});
	}

	public function shortCode( $attributes )
	{
		$this->attributes = shortcode_atts( array(
            'most_recent' => 1
        ), $attributes );


		if($this->attributes['most_recent'])
		{
			$article = Article::getMostRecentArticle();
		}
		else
		{
			$article = Article::getRandomArticle();
		}

		include(WDWTF_PLUGIN_ABSOLUTE_PATH . "/views/widget.php");
	}

	/**
	 * Initiates the admin funcitons
	 */
	public function initAdmin()
	{
		add_action('admin_menu', function(){
			//registering the settings link
			add_filter( 'plugin_action_links_' . TDWTF_BASEPLUGIN_PATH, array( $this, 'registerSettingsLink') );

			//registering the options page
			add_options_page(
				__('Settings', 'tdwtf-domain-string'),
				__('TDWTF Settings', 'tdwtf-domain-string'),
				'manage_options',
				'tdwtf-widget-settings',
				array( $this, 'registerSettingsPage' )
			);

			//registering the settings fields
			$this->registerSettings();
		} );

		add_action( 'wp_ajax_nopriv_tdwtf_widget_get_article_by_id', array( $this, 'getArticleById' ) );
		add_action( 'wp_ajax_tdwtf_widget_get_article_by_id', array( $this, 'getArticleById' ) );
	}

	public function getArticleById() {
		header( 'Content-Type: application/json' );
		echo json_encode( Article::getArticleById( $_POST['id'] ) );
		exit;
	}

	/**
	 * Registers the link displayed under the plugin on the pluign update/activate page.
	 *
	 * @param $links
	 *
	 * @return array
	 */
	public function registerSettingsLink( $links )
	{
		$mylinks = array(
			'<a href="' . admin_url( 'options-general.php?page=tdwtf-widget-settings' ) . '">Settings</a>',
		);

		return array_merge( $links, $mylinks );
	}

	/**
	 * Registers the fields defined on the settings page.
	 */
	public function registerSettings()
	{
//		register_setting(
//			'my_option_group', // Option group
//			'my_option_name', // Option name
//			array( $this, 'sanitize' ) // Sanitize
//		);
//
//		add_settings_section(
//			'setting_section_id', // ID
//			'My Custom Settings', // Title
//			array( $this, 'print_section_info' ), // Callback
//			'my-setting-admin' // Page
//		);
//
//		add_settings_field(
//			'id_number', // ID
//			'ID Number', // Title
//			array( $this, 'id_number_callback' ), // Callback
//			'my-setting-admin', // Page
//			'setting_section_id' // Section
//		);
//
//		add_settings_field(
//			'title',
//			'Title',
//			array( $this, 'title_callback' ),
//			'my-setting-admin',
//			'setting_section_id'
//		);
	}

	/**
	 * This function holds the form code for the settings page.
	 */
	public function registerSettingsPage()
	{
		?>

		<h1>Settings</h1>

		<?php
	}
}