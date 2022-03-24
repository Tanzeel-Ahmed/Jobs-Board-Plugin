<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://fictional-university/
 * @since      1.0.0
 *
 * @package    My_First_Plugin
 * @subpackage My_First_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    My_First_Plugin
 * @subpackage My_First_Plugin/admin
 * @author     Tanzeel <tanzeel@gmail.com>
 */
class My_First_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_First_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_First_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-first-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_First_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_First_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-first-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

		public function job_post_types() {
			$labels = array(
				'name'                  => _x( 'Jobs', 'Jobs Board', $this->plugin_name ),
				'singular_name'         => _x( 'Job', 'Job Board', $this->plugin_name ),
				'menu_name'             => _x( 'Jobs Board', 'Admin Menu text', $this->plugin_name ),
				'name_admin_bar'        => _x( 'Job', 'Add New on Toolbar', $this->plugin_name ),
				'add_new'               => __( 'Add New', $this->plugin_name ),
				'add_new_item'          => __( 'Add New Job', $this->plugin_name ),
				'new_item'              => __( 'New Job', $this->plugin_name ),
				'edit_item'             => __( 'Edit Job', $this->plugin_name ),
				'view_item'             => __( 'View Job', $this->plugin_name ),
				'all_items'             => __( 'All Jobs', $this->plugin_name ),
				'search_items'          => __( 'Search Jobs', $this->plugin_name ),
				'featured_image'        => _x( 'Job Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', $this->plugin_name ),
				'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', $this->plugin_name ),
				'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', $this->plugin_name ),
				'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', $this->plugin_name ),
				'archives'              => _x( 'Job archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', $this->plugin_name ),
				
			);
		 
			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'jobs'),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail'),
				'menu_icon'			 => 'dashicons-shield-alt'
			);
		 
			register_post_type( 'job', $args );
		}

		public function job_taxonomy() {

			$labels = array(
				'name'              => _x( 'Jobs Category','taxonomy general name', $this->plugin_name ),
				'singular_name'     => _x( 'Job category', 'taxonomy singular name', $this->plugin_name ),
				'search_items'      => __( 'Search Jobs category', $this->plugin_name ),
				'all_items'         => __( 'All Jobs Category', $this->plugin_name ),
				'view_item'         => __( 'View Job Category', $this->plugin_name ),
				'parent_item'       => __( 'Parent Job Category', $this->plugin_name ),
				'parent_item_colon' => __( 'Parent Job Category:', $this->plugin_name ),
				'edit_item'         => __( 'Edit Job Category', $this->plugin_name ),
				'update_item'       => __( 'Update Job Category', $this->plugin_name ),
				'add_new_item'      => __( 'Add New Job Category', $this->plugin_name ),
				'new_item_name'     => __( 'New Job Name Category', $this->plugin_name ),
				'not_found'         => __( 'No Jobs Found Category', $this->plugin_name ),
				'back_to_items'     => __( 'Back to Jobs Category', $this->plugin_name ),
				'menu_name'         => __( 'Job  Category', $this->plugin_name ),
			);
		 
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'job-category' ),
				'show_in_rest'      => true,
			);

			register_taxonomy( 'job_category', 'job', $args);

		}

		public function job_details_box() {

			add_meta_box(
		         'job_location',
		         'Job Location',
		         array($this,'job_location_box_content'),
		         'job',
		         'normal',
		         'high'
			);

			add_meta_box(
				'job_salary',
				'Job Salary',
				array($this,'job_salary_box_content'),
				'job',
				'normal',
				'default'
		   );

		   add_meta_box(
			'employment_time',
			'Employment Time',
			array($this,'job_time_box_content'),
			'job',
			'normal',
			'default'
	    	);

			add_meta_box(
				'job_benefits',
				'Job Benefits',
				array($this,'job_benefits_box_content'),
				'job',
				'normal',
				'default'
				);
		}
		// Job Location callback function
		public function job_location_box_content(){
     
			global $post;
			 
			?>
		 
			<div class="row">
				<div class="label">Job Location</div>
				<div class="fields">
					<input type="text" name="job_location" placeholder="Enter Job`s Location" value="<?php echo get_post_meta($post->ID, 'job_location', true)?>"/>
				</div>
			</div>
		 
			<?php
		 
		}


		// Job Salary callback funtion
		public function job_salary_box_content(){
     
			global $post;
			 
			?>
		 
			<div class="row">
				<div class="label">Salary Range</div>
				<div class="slidecontainer">
  				<input type="range" name="job_salary" min="1" max="100" class="slider" id="myRange" value="<?php echo get_post_meta($post->ID, 'job_salary', true)?>">
			</div>
			</div>
		 
			<?php
		 
		}


		// Job`s Timing callback function
		public function job_time_box_content(){
     
			global $post;
			 
			?>
		 
			<div class="row">
				<div class="label">Employment Time</div>
				<div class="fields">
					<input type="text" name="job_time"  placeholder="Enter Job`s Timing" value="<?php echo get_post_meta($post->ID, 'job_time', true)?>"/>
				</div>
			</div>
		 
			<?php
		 
		}


		// Job`s Benefit callback function
		public function job_benefits_box_content(){
     
			global $post;
			 
			?>
		 
			<div class="row">
				<div class="label">Job Benefits</div>
				<div class="fields">
					<input type="text" name="job_benefits"  placeholder="Enter Job`s Benefits" value="<?php echo get_post_meta($post->ID, 'job_benefits', true)?>"/>
				</div>
			</div>
		 
			<?php
		 
		}
		
				// jobs box hook function
			public function job_box_save(){
 
				
			}

					// Register Application custom post type
					public function application_post_types() {
						$labels = array(
							'name'                  => _x( 'Applications', 'Jobs Application', $this->plugin_name ),
							'singular_name'         => _x( 'Application', 'Job Application', $this->plugin_name ),
							'menu_name'             => _x( 'Jobs Application', 'Admin Menu text', $this->plugin_name ),
							'name_admin_bar'        => _x( 'Applications', 'Add New on Toolbar', $this->plugin_name ),
							'all_items'             => __( 'All Applications', $this->plugin_name ),
							'search_items'          => __( 'Search Application', $this->plugin_name ),
							
							
						);
					 
						$args = array(
							'labels'             => $labels,
							'public'             => true,
							'publicly_queryable' => true,
							'show_ui'            => true,
							'show_in_menu'       => true,
							'show_in_rest' 		 => true,
							'rewrite'            => array( 'slug' => 'applications'),
							'capability_type'    => 'post',
							'menu_position'      => null,
							'menu_icon'			 => 'dashicons-media-text'
						);
					 
						register_post_type( 'applications', $args );
					}	
					
					public function application_details_box() {
						add_meta_box(
							'job_application',
							'Job Application',
							array($this,'job_application_box_content'),
							'applications',
							'normal',
							'high'
					   );
					}

					/* Create Meta Boxes in Application Custom post type.
					 * Get data from Apllication Form from Front end/single page template */ 

					// job application callback function
					public function job_application_box_content(){
					
						global $post;
						 
						?>
					 
						<div class="row">
							<div class="label">Full Name</div>
							<div class="fields">
								<input type="text" name="fullname" placeholder="Enter Full Name" value="<?php echo get_post_meta($post->ID, 'fullname', true)?>"/>
							</div>
						</div>
						<div class="row">
							<div class="label">Emil Address</div>
							<div class="fields">
								<input type="text" name="email" placeholder="Enter Email" value="<?php echo get_post_meta($post->ID, 'email', true)?>"/>
							</div>
						</div>
						<div class="row">
							<div class="label">Home Address</div>
							<div class="fields">
								<input type="text" name=" address" placeholder="Enter Address" value="<?php echo get_post_meta($post->ID, 'address', true)?>"/>
							</div>
						</div>
						<div class="row">
							<div class="label">Phone Number</div>
							<div class="fields">
								<input type="text" name=" phone" placeholder="Enter Phone Number" value="<?php echo get_post_meta($post->ID, 'phone', true)?>"/>
							</div>
						</div>
						<div class="row">
							<div class="label">Date</div>
							<div class="fields">
								<input type="text" name=" date" placeholder="Enter Date" value="<?php echo get_post_meta($post->ID, 'date', true)?>"/>
							</div>
						</div>
						<div class="row">
						<div class="label"> Resume
							<?php  $uploadedfile = get_post_meta($post->ID, 'file', true)?>
							<a href="<?php echo $uploadedfile['url']; ?>" download> Download </a>
							</div>
						</div>
					 
						<?php
					 
					}
				// job Application hook function
				public function job_application_box_save(){
 
				global $post;
			 
					if(isset($_POST["fullname"])):
					 
				  	    update_post_meta($post->ID, 'fullname', $_POST["fullname"]);
				 
						endif;
						
						global $post;
					if(isset($_POST["email"])):
					 
					    update_post_meta($post->ID, 'email', $_POST["email"]);
				 
						endif;

						global $post;
					if(isset($_POST["address"])):
					 
						update_post_meta($post->ID, 'address', $_POST["address"]);
					 
						endif;

						global $post;
					if(isset($_POST["phone"])):
					 
						update_post_meta($post->ID, 'phone', $_POST["phone"]);
						 
						endif;

						global $post;
					if(isset($_POST["date"])):
					 
						update_post_meta($post->ID, 'date', $_POST["date"]);
							 
						endif;
					
						global $post;
					if(isset($_POST["file"])):
					 
						update_post_meta($post->ID, 'file', $_POST["file"]);
								 
						endif;	
					}

					

					
}
