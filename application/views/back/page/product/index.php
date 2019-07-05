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
		<a class="ml-auto col-md-2  btn btn-submit" href="<?php echo base_url()?>product/add">Add Product</a>
	</div>
	<div class="row">
		<div class="col-md-12 ">
				<table class="table table-bordered">
					<thead>
						<tr>
						<th width="5%">#</th>
						<th >Name</th>
						<th >Brand</th>
						<th >Price</th>
						<th >Category</th>
						<th >Quantity</th>
						<th >Purchase Date</th>
						<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i =1;
						foreach ($result as $key) {
							echo "
								<tr>
									<td>".$i++."</td>
									<td>".$key['name']."</td>
									<td>".$key['brand']."</td>
									<td>".$key['price']."</td>
									<td>".$key['category']['name']."</td>
									<td>".$key['quantity']." ".$key['quantity_unit']."</td>
									<td>".$key['purchase_date']."</td>
									<td>
										<form style='display:inline-block;' method='POST' action='".base_url()."product/show'>
											<input type='hidden' name='id' value='".$key['id']."'/>
											<input type='hidden' name='name' value='".$key['name']."'/>
											<input type='hidden' name='brand' value='".$key['brand']."'/>
											<input type='hidden' name='price' value='".$key['price']."'/>
											<input type='hidden' name='category_id' value='".$key['category_id']."'/>
											<input type='hidden' name='quantity' value='".$key['quantity']."'/>
											<input type='hidden' name='quantity_unit' value='".$key['quantity_unit']."'/>
											<input type='hidden' name='purchase_date' value='".$key['purchase_date']."'/>
											<button class='btn btn-primary' name='submit'>Show</button>
										</form>
										<a class='btn btn-danger' href='".base_url()."product/delete/".$key['id']."'>Delete</a>
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
