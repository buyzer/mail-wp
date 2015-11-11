<div class="main-contact form-career-wrapper">
	<div id="message"></div>
	<form id="form-contact" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
		          <label >*First Name</label>
		          <input type="text"  name="first_name" id="first-name" class="form-control important">
		        </div>
		        <div class="form-group">
		          <label >*Last Name</label>
		          <input type="text"  name="last_name" id="last-name" class="form-control important">
		        </div>
		        <div class="form-group">
		          <label >*Company</label>
		          <input type="text"  name="company" id="company" class="form-control important">
		        </div>
		        <div class="form-group">
		          <label >*Email Address</label>
		          <input type="text"  name="email" id="email" class="form-control important">
		        </div>
		        <div class="form-group">
		          <label >*Country</label>
		          <select  name="country" id="country" class="form-control important">
		          	<option value="">Select...</option>
		          	<?php
		          	if($_SESSION['country'] != null){
		          		foreach ($_SESSION['country'] as $key => $value) {
		          		 echo "<option value='$value' >$value</option>";		
		          		}
		          	}
		          	?>
		          </select>
		        </div>
		        <div class="form-group">
		          <label >*I&rsquo;m Interested i...</label>
		          <select  name="interested" id="interested" class="form-control important">
		          	<option value="">Select...</option>
		          	<?php
		          	$args = array( 'post_type' => 'ourservice');
					$loop = new WP_Query($args);
					$no = 0;
					while ($loop->have_posts() ) {
						$loop->the_post();
						echo "<option value='".$loop->posts[$no]->post_title."'> ".$loop->posts[$no]->post_title."</option>";
						$no++;
					}?>
		          	?>
		          </select>
		        </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
		          <label >*Phone Number</label>
		          <input type="text"  name="phone1" id="phone1" class="form-control important">
		        </div>
		        <div class="form-group">
		          <label >*Phone Number</label>
		          <input type="text"  name="phone2" id="phone2" class="form-control important">
		        </div>
		        <div class="form-group">
		          <label >City</label>
		          <input type="text"  name="city" id="city" class="form-control">
		        </div>
		        <div class="form-group">
		          <label >State</label>
		          <input type="text"  name="state" id="state" class="form-control">
		        </div>
		        <div class="form-group">
		          <label >*Zip Code</label>
		          <input type="text"  name="zip_code" id="zip_code" class="form-control important">
		        </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
		          <label >Comments :</label>
		          <textarea name="comment" id="comment" class="form-control"></textarea>
		        </div>
			</div>
		</div>
		<input type="hidden" name="type" value="contact">
		<input type="hidden" name="action" value="form_email">
		<input type="hidden" name="verify" value="<?php echo wp_create_nonce( 'contact' ); ?>">
		<div class="row">
			<div class="col-md-12">
				<button name="careers" id="submit-contact" value="true" class="btn btn-career">Submit</button>
			</div>
		</div>
	</form>
</div>
<div class="row contact-footer">
	<div class="col-md-3">
		<div class="contact-career-info"> 
			<h3>Headquarters-Atlanta, GA</h3>
			<?php echo of_get_option('head_address');?>
			<p>Phone : <?php echo of_get_option('head_phone');?></p>
			<p>Fax : <?php echo of_get_option('head_fax');?></p>		
		</div>
	</div>
	<div class="col-md-3">
		<div class="contact-career-info"> 
			<h3>Sales</h3>
			<p><?php echo of_get_option('phone_sales');?></p>
			<p><a href="mailto:<?php echo of_get_option('email_sales');?>" title="sales mail"><?php echo of_get_option('email_sales');?></a></p>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contact-career-info"> 
			<h3>Careers</h3>
			<p><?php echo of_get_option('phone_career');?></p>
			<p><a href="mailto:<?php echo of_get_option('email_career');?>" title="mail to careers"><?php echo of_get_option('email_career');?></a></p>
		</div>
	</div>
	<div class="col-md-3">
		<div class="contact-career-info"> 
			<h3>General Inquiries</h3>
			<p><?php echo of_get_option('phone_contact');?></p>
			<p><a href="mailto:<?php echo of_get_option('email_contact');?>" title="mail to general"><?php echo of_get_option('email_contact');?></a></p>
		</div>
	</div>
</div>
