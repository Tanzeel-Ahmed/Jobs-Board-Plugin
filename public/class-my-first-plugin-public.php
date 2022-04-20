<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://fictional-university/
 * @since      1.0.0
 *
 * @package    My_First_Plugin
 * @subpackage My_First_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    My_First_Plugin
 * @subpackage My_First_Plugin/public
 * @author     Tanzeel <tanzeel@gmail.com>
 */
class My_First_Plugin_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-first-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-first-plugin-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script('jquery-form');

	}
	// Our First jobs board Shortcode
	public function public_jobs_board() {?>
		
		<div class="container">
			
				<form action="" method="GET">
					<div class="row">
					<div class="col-75">
						<select name="city">
						<option value="">Select City</option>
						<?php
						$homepagejobs = new WP_Query(array(
							'posts_per_page' => -1,
							'post_type' => 'job',
							'orderby' => 'meta_value_num',
							'order' => 'DESC'
						));
						if ($homepagejobs->have_posts() ){
							$cities=array();
						while($homepagejobs->have_posts() ) {
							$homepagejobs->the_post(); 
							$city= get_post_meta( get_the_ID(), 'job_location', true ); 
							
							// populate an array of all occurrences (non duplicated)
							if( !in_array( $city, $cities ) ){?>
								<option name="location"><?php echo get_post_meta( get_the_ID(), 'job_location', true ); ?></option>
							<?php	array_push($cities ,$city);    
							}
						?>
						
						<?php }

						} else {
							echo 'No location yet!';
       						return;
						}
						wp_reset_postdata();
						?>
						</select><br><br>

						<select name="category">
						<option value="">Select Category</option>
						<?php

						// Get all the categories
						$categories = get_terms( 'job_category' );

						// Loop through all the returned terms
					
						

							foreach ( $categories as $category ):
						?>
						<option name="category" ><?php echo $category->name ?></option>
						
						<?php
						 
						// end the loop
					endforeach;
					
	
							 // Reset things, for good measure
							 $homepagejobs = null;
    						wp_reset_postdata();
						
						?>
						
						</select>
					</div>
					</div><br>
					<div class="slidecontainer">
					<label>Select Salary Range</label>	
  					<input type="range" name="job_salary" min="1" max="100" class="slider" id="myRange" >
					</div>
					<div class="row">
					<input type="submit" name="submit" value="Go">
					</div>
				</form>
				</div>
				<h1> Available Jobs </h1>		
					<?php
					
			if(isset($_GET['submit'])){
				$get_city= $_GET['city'];
				$get_category=$_GET['category'];
				if ($get_city != NULL) {
				$args = array( 
					'post_type'     => 'job',
					'posts_per_page' => '-1',
					'meta_key'      => 'job_location',
					'meta_value'        => $get_city,   
					'meta_compare'  => 'LIKE',
				);} elseif($get_category !=NULL) {
				$args = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'job_category',
							'field'    => 'slug',
							'terms' => $get_category, // (the name of what you want to filter by (latest or whatever))
						)
					) 
				);}
				
					// The Query
					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) {

						while ( $the_query->have_posts() ) : $the_query->the_post();?> 
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5><p>City: <?php echo get_post_meta( get_the_ID(), 'job_location', true ); ?></p> 
						<?php
						endwhile;

				
					/* Restore original Post Data */
					wp_reset_postdata();
					}?>		
				<?php

					 

			} else {
		   $query = new WP_Query(array(
					   'posts_per_page' =>  get_option( 'my_setting_field' ),
					   'post_type' => 'job',
					   'order' => 'ASC'
				   ));
		   
				   while($query->have_posts()) {
					   $query->the_post(); 
					   ?>   <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5><p>City: <?php echo get_post_meta( get_the_ID(), 'job_location', true ); ?></p> <?php
					} 
			}	
					
		}
	
		function my_custom_template($single) {

			global $post;

			/* This is for single template by post type.*/
			if ( $post->post_type == 'job' ) {
				if ( file_exists( plugin_dir_path( __FILE__ ) . 'templates/single-job.php' ) ) {
					return plugin_dir_path( __FILE__ ) . 'templates/single-job.php';
				}
			}

			return $single;

		}
}
