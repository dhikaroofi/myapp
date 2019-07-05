<div class="container">
	<div class="row justify-content-md-center">
			<form class=" col-md-4 mt-5 p-5 shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo base_url();?>welcome/registerAct" method="POST">
				<h2 >Create an Account</h2>
				<div >
					<input class="p-1 my-3" required type="text" name="name" placeholder="Full Name">
				</div>
				<div >
					<input class="p-1 my-3" required type="email" name="email" placeholder="Email">
				</div>
				<div >
					<input class="p-1 my-3" required type="Password" name="password" placeholder="Password">
				</div>
				<div >
					<input class="p-1 my-3 mb-4" required type="Password" name="cpassword" placeholder="Confirm Password">
				</div>
				<small id="passwordHelpBlock" class="form-text text-center text-muted">
					Already have an account? <a href="<?php echo base_url()?>welcome/login">Sign in here</a>
				</small>
				<div style="">
					<button class="btn-submit" name="submit">Create Account</button>
				</div>
			</form>
	</div>
</div>
