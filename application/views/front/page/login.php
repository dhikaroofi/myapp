<div class="container">
	<div class="row justify-content-md-center">
			<form class=" col-md-4 mt-5 p-5 shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo base_url();?>welcome/loginact" method="POST">
				<h2 >Sign in here!</h2>
				<div >
					<input class="p-1 my-3" required type="email" name="email" placeholder="Email">
				</div>
				<div >
					<input class="p-1 my-3" required type="password" name="password" placeholder="Password">
				</div>
				
				<small id="passwordHelpBlock" class="form-text text-center text-muted">
					Don't have an account? <a href="<?php echo base_url()?>welcome/index">Register here</a>
				</small>
				<div style="">
					<button class="btn-submit" name="submit">Sign in</button>
				</div>
			</form>
	</div>
</div>
