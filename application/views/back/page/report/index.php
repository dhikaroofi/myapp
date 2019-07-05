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

	<div class="row">
		<div class="col-md-12 ">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th >Customer Name</th>
							<th >Total</th>
							<th >Transcation Date</th>
							<th >User</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i =1;
						foreach ($result as $key) {
							echo "
								<tr>
									<td>".$i++."</td>
									<td>".$key['customer_name']."</td>
									<td>".$key['total']."</td>
									<td>".$key['created_at']."</td>
									<td>".$key['user']['name']."</td>
								
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
