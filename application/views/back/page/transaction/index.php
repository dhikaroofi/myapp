<div class="container-fluid p-3 px-5  mt-2 ">
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
						<strong>Failed</strong> ".$this->session->userdata('alert')."
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
		<div class="col-md-4 p-2 shadow  bg-white rounded"  style="min-height:500px !important;">
			<div class="row">
					<div class="col-md-12" style="min-height:400px;">
						<h4 class="my-3">Shoping List</h4>
						<table class="  table-custom table-bordered" style="width:100%;font-size:0.9rem;">
							<tr class='text-center'>
								<th width="3%">No</th>
								<th class='text-left' width="40%">Name</th>
								<th width="10%">Quantity</th>
								<th>Price</th>
								<th>Total Price</th>
								<th width="20%"> </th>
							</tr>
							<?php
							$i = 0;
							$to = 0;
								foreach ($tmp as $key) {
									$to += $key['quantity']*$key['price'];
									echo "
										<tr class='text-center p-2' style='line-height:30px !important;'>
											<td >".++$i."</td>
											<td class='text-left'>".$key['name']."</td>
											<td>".$key['quantity']." ".$key['quantity_unit']."</td>
											<td>Rp. ".number_format($key['price'])." </td>
											<td>Rp. ".number_format($key['quantity']*$key['price'])."</td>
											<td>
												<a class=' p-1 '  href='".base_url()."transc/delete/".$key['id']."'>Delete</a>
											
												</td>
										</tr>
									";
								}
							?>
						</table>
					</div>
			</div>
			<div class="row pt-4">
				<div class="col-md-12 ">
					<form action="<?php echo base_url()?>transc/submit" method="POST">
						<div class="">
							<input class="p-1 my-2" required type="text" name="name" placeholder="Customer Name">
						</div>
						<div class="">
							<input class="p-1 my-2" required type="number" name="cash" placeholder="Cash">
						</div>
						<div class="w-50" style="">
							<button class="btn-submit mt-1  "  name="submit">Buy</button>
						</div>
					</form>
				</div>
			</div>

		</div>
		<div class="col-md-7 ml-3 p-2 shadow  bg-white rounded">
			<div class="container-fluid">
				<h4 class="my-3">Product List</h4>
				<!-- <form class="row" action="<?php echo base_url()?>/transc/add" method="POST">  
					<div class="col-md-8">
						<input class="p-1 my-2" required type="text" name="name" placeholder="Product Name">
					</div>
					<div class="col-md-4">
						<input class="p-1 my-2" required type="text" name="quantity" placeholder="Quantity">
					</div>
					<div class="col-md-2 ml-auto" style="">
						<button class="btn-submit mt-1" style="padding:2px !important;"  name="submit">Submit</button>
					</div>
				</form> -->
				<div class="row">
					
					<?php
					
						foreach ($product as $p ) {
							echo "
								<div class='col-md-3 mx-2 card p-0' >
									<div class='card-body '>
										<h5 class='card-title text-center'>".$p['name']."</h5>
										<table class='card-body '>
											<tr>
												<td>Brand</td>
												<td>:</td>
												<td>".$p['brand']."</td>
											</tr>
											<tr>
												<td>Category</td>
												<td>:</td>
												<td>".$p['category']['name']."</td>
											</tr>
											<tr>
												<td>Stock</td>
												<td>:</td>
												<td>".$p['quantity']." ".$p['quantity_unit']."</td>
											</tr>
											<tr>
												<td>Price</td>
												<td>:</td>
												<td>".number_format($p['price'])."</td>
											</tr>
										</table>
									</div>
									<div class='card-footer bg-white text-muted'>
										<form action='".base_url()."transc/add' method='POST'>
											<input type='hidden' name='name' value='".$p['name']."'/>
											<input type='hidden' name='price' value='".$p['price']."'/>
											<input type='hidden' name='quantity_unit' value='".$p['quantity_unit']."'/>
											<input type='hidden' name='product_id' value='".$p['id']."'/>
											<input type='number'  name='quantity' value='1'/>
											<button class='mt-3 btn-submit' name='submit'>Choose</button>
										</form>
									</div>
								</div>
							
							";
						}
			
					?>
				</div>
			</div>
		</div>
	</div>
</div>
