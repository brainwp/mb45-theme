<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>







<div id="fullpage">

	<div class="section">
		<div class="container-fluid">
			<div class="col-md-offset-1 col-md-5">
				<div class="theTitle">
					manicure + blowout 45 minutes
				</div>
				<div class="info col-md-8">
					Chic Hair + Chic Nails in 45 Minutes
Mani + Blowout = $65
				</div>
				<a href="#" class="theButtom">
					view menu
				</a>
			</div>
		</div>
	</div>
	<div class="section two">
		<div class="container-fluid">
			<div class="col-md-offset-1 col-md-5">
				<div class="theTitle">
					mb45 <br>signature
				</div>
				<div class="info col-md-8">
					Chic Hair + Chic Nails in 45 Minutes
Mani + Blowout = $65
				</div>
				<a href="#" class="theButtom">
					buy it now
				</a>
			</div>
		</div>
	</div>


	<div class="section">
		<div class="container-fluid">
			<div class="col-md-offset-1 col-md-5">
				<div class="theTitle">
					Want a more modern, beautiful & efficient life?
				</div>
				<div class="info col-md-8">
					Sign up for our emails to stay in-the-know on exclusive events, tips and offers. We promise we won’t spam you.
				</div>

			</div>

	<!-- FORMULARIO -->
			<div class="col-md-4 form col-md-pull-1">
				<form action="" id="" class="">
					<div class="col-md-6">
						<label>
							FIRST NAME
							<input type="text" name="">
						</label>

					</div>
					<div class="col-md-6">
						<label>
							LAST NAME
							<input type="text" name="">
						</label>
					</div>
					<div class="">
						<label>
							EMAIL
							<input type="email" name="">
						</label>
					</div>
					<div class="buttom">
						<input type="submit" name="" value="JOIN">
					</div>
				</form>

			</div>

		</div>
	</div>




</div>


<?php
get_footer();





























