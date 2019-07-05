<div class="container p-3 px-5  mt-5 shadow-sm  bg-white rounded">
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
	<div class="row p-3">
		<a class="ml-auto col-md-2  btn btn-submit" href="<?php echo base_url()?>category/add">Add Category</a>
	</div>
	<div class="row">
		<div class="col-md-12 ">
				<table class="table table-bordered">
					<thead>
						<tr>
						<th width="5%">#</th>
						<th >Name</th>
						<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						foreach ($result as $key) {
							echo "
								<tr>
									<td>".$i++."</td>
									<td>".$key['name']."</td>
									<td>
										<a class='btn text-white btn-primary' href='".base_url()."category/show/".$key['id']."/".$key['name']."'>Show</a>
										<a class='btn btn-danger' href='".base_url()."category/delete/".$key['id']."'>Delete</a>
									</td>
								</tr>
							";
							$i++;
						}
						?>
					</tbody>
					</table>

		</div>
	</div>
</div>
