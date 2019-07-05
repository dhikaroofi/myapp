<div class="container">
	<div class="row justify-content-md-center">
			<form class=" col-md-12 mt-5 p-5 shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo base_url();?>product/add" method="POST">
				<h1 class="mb-3">Create product</h1>
				<div class="w-50">
					<input class="p-1 my-3" required type="text" name="name" placeholder="Name">
				</div>
				<div class="w-50">
					<input class="p-1 my-3" required type="text" name="brand" placeholder="Brand">
				</div>
				<div class="w-50">
					<input class="p-1 my-3" required type="number" min="1" name="price" placeholder="Price">
				</div>
				<div class="w-50">
					<select class=" my-3 input" name="category_id">
						<option disabled selected value>Select Category</option>
						<?php 
							foreach ($result as $key) {
								echo 
									"<option value='".$key['id']."'>".$key['name']."</option>"
								;

							}
						?>
					</select>
				</div>
				<div class="w-50">
					<input class="p-1 my-3" required type="number" min="1"  name="quantity" placeholder="Quantity">
				</div>
				<div class="w-50">
					<select class=" my-3 input" name="quantity_unit">
						<option disabled selected value>Select Unit Quantity</option>
						<option value="pcs">Pcs</option>
						<option value="Unit">Unit</option>
						<option value="Meter">Meter</option>
					</select>
				</div>
				<div class="w-50">
					<input class="p-1 my-3 mb-4" required type="date" name="purchase_date" placeholder="Purchase date">
				</div>
				<div style="">
					<button class="btn-submit col-md-2" name="submit">Create product</button>
				</div>
			</form>
	</div>
</div>
