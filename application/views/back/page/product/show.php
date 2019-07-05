<div class="container">
	<div class="row justify-content-md-center">
			<form class=" col-md-12 mt-5 p-5 shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo base_url();?>product/update" method="POST">
				<h1 class="mb-3">Update product</h1>
				<div class="w-50">
					<input class="p-1 my-3" required type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
				</div>
				<div class="w-50">
					<input class="p-1 my-3" required type="text" name="brand" placeholder="Brand" value="<?php echo $brand; ?>">
				</div>
				<div class="w-50">
					<input class="p-1 my-3" required type="number" min="1" name="price" placeholder="Price" value="<?php echo $price; ?>">
				</div>
				<div class="w-50">
					<select class=" my-3 input" name="category_id">
						<option disabled selected value>Select Category</option>
						<?php 
							foreach ($result as $key) {
								if ($key['id']==$category_id) {
									echo 
										"<option value='".$key['id']."' selected>".$key['name']."</option>"
									;
								}else{
									echo 
										"<option value='".$key['id']."' >".$key['name']."</option>"
									;
								}
								
							}
						?>
					</select>
				</div>
				<div class="w-50">
					<input class="p-1 my-3" required type="number" min="1"  name="quantity" placeholder="Quantity" value="<?php echo $quantity;?>">
				</div>
				<div class="w-50">
					<select class=" my-3 input" name="quantity_unit">
						<option selected value='<?php echo $quantity_unit;?>'><?php echo $quantity_unit;?></option>
						<option value="pcs">Pcs</option>
						<option value="Unit">Unit</option>
						<option value="Meter">Meter</option>
					</select>
				</div>
				<div class="w-50">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input class="p-1 my-3 mb-4" required type="date" name="purchase_date" placeholder="Purchase date" value="<?php echo $purchase_date;?>">
				</div>
				<div style="">
					<button class="btn-submit col-md-2" name="submit">Update product</button>
					<a class="btn btn-submit col-md-2" href='<?php echo base_url()."product/delete/".$id; ?>"'>Delete Product</a>

				</div>
			</form>
	</div>
</div>
