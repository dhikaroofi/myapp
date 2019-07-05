<div class="container py-4">
	<div class="row">
		<div class="col-md-12">
		<?php 
			if ($this->session->has_userdata('succes')) {
				echo "
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Succes</strong> ".$this->session->userdata('succes')."
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>
					";
			}
			if ($this->session->has_userdata('alert')) {
				echo "
					<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Failed</strong>".$this->session->userdata('alert')."
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>
					";
			}
		?>

		</div>
	</div>
	<div class="row justify-content-md-center">
			<form class=" col-md-12 mt-5 p-5 shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo base_url();?>category/add" method="POST">
				<h1 class="mb-3">Create category</h1>
				<div class="w-50">
					<input class="p-1 my-3" required type="text" name="name" placeholder="Name">
				</div>
				<div style="">
					<button class="btn-submit col-md-2" name="submit">Create category</button>
				</div>
			</form>
	</div>
</div>
