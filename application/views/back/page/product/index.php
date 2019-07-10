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
		<a class="ml-auto col-md-2  btn btn-submit" href="<?php echo base_url()?>product/add" data-toggle="modal" data-target="#inputModal">Add Product</a>
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
							<th >Quantity Unit</th>
							<th >Purchase Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr id="Loading">
							<td align="center" colspan="9">
								<h3>Loading .....</h3>
							</td>
						</tr>
						<?php 
						// $i =1;
						// foreach ($result as $key) {
						// 	echo "
						// 		<tr>
						// 			<td>".$i++."</td>
						// 			<td>".$key['name']."</td>
						// 			<td>".$key['brand']."</td>
						// 			<td>".$key['price']."</td>
						// 			<td>".$key['category']['name']."</td>
						// 			<td>".$key['quantity']." ".$key['quantity_unit']."</td>
						// 			<td>".$key['purchase_date']."</td>
						// 			<td>
						// 				<form style='display:inline-block;' method='POST' action='".base_url()."product/show'>
						// 					<input type='hidden' name='id' value='".$key['id']."'/>
						// 					<input type='hidden' name='name' value='".$key['name']."'/>
						// 					<input type='hidden' name='brand' value='".$key['brand']."'/>
						// 					<input type='hidden' name='price' value='".$key['price']."'/>
						// 					<input type='hidden' name='category_id' value='".$key['category_id']."'/>
						// 					<input type='hidden' name='quantity' value='".$key['quantity']."'/>
						// 					<input type='hidden' name='quantity_unit' value='".$key['quantity_unit']."'/>
						// 					<input type='hidden' name='purchase_date' value='".$key['purchase_date']."'/>
						// 					<button class='btn btn-primary' name='submit'>Show</button>
						// 				</form>
						// 				<a class='btn btn-danger' href='".base_url()."product/delete/".$key['id']."'>Delete</a>
						// 			</td>
						// 		</tr>
						// 	";
						// 	$i++;
						// }
						?>
					</tbody>
				</table>
		</div>
	</div>
</div>


	<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="POST" id="modalinput" class="modal-content" data-id="test">
				<div class="modal-header">
					<h5 class="modal-title" id="inputModalLabel">Create Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" >
					<input class="p-1 my-3" required type="text" name="name" placeholder="Name">
					<input class="p-1 my-3" required type="text" name="brand" placeholder="Brand">
					<input class="p-1 my-3" required type="number" min="1" name="price" placeholder="Price">
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
					<input class="p-1 my-3" required type="number" min="1"  name="quantity" placeholder="Quantity">
					<select class=" my-3 input" name="quantity_unit">
							<option disabled selected value>Select Unit Quantity</option>
							<option value="pcs">Pcs</option>
							<option value="Unit">Unit</option>
							<option value="Meter">Meter</option>
						</select>
					<input class="p-1 my-3 mb-4" required type="date" name="purchase_date" placeholder="Purchase date">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn-submit" id="btn-save" name="submit">Create Product</button>
				</div>
			</form>
		</div>
	</div>

	
<script>
	$(document).ready(function () {  

		
		function showAll(){
			var category = '';
			$.ajax({
				url: 'http://demo.var-x.id/api/category/get',
				type:'GET',
				contentType: 'application/json',
				dataType: 'json',
				headers: {'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'},
				success: function (result) {
					$.each(result.data, function (i, valc) { 
						category += `
							<option value='`+valc.id+`'>`+valc.name+`</option>
						`;

					});
				}
			});
			setTimeout(function(){
					$.ajax({
						url: 'http://demo.var-x.id/api/product/get',
						type:'GET',
						contentType: 'application/json',
						dataType: 'json',
						headers: {'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'},
						success: function(result){
							$('tbody').find('#loading').remove();
							$.each(result.data, function (i, val) { 
								$('tbody').append(`
									<tr>
										<td>`+(++i)+`</td>
										<form>
										<td id="name" ><input id='input-name' value='`+val.name+`'/></td>
										<td id="brand" ><input type='text' id='input-brand' value='`+val.brand+`'/></td>
										<td id="price" ><input type='text' id='input-price' value='`+val.price+`'/></td>
										<td id="category_id" >
											<select class='input' id='input-category_id'>
												<option selected='selected' value='`+val.category.id+`'>`+val.category.name+`</option>
												`+category+`
											</select>
										</td>
										<td id="quantity" ><input type='number' id='input-quantity' value='`+val.quantity+`'/></td>
										<td id="quantity_unit" ><input type='text' id='input-quantity_unit' value='`+val.quantity_unit+`'/></td>
										<td id="purchase_date" ><input type='date' id='input-purchase_date' value='`+val.purchase_date+`'/></td>
										<td>
											<button id='update-btn' class='btn btn-warning text-white' data-id='`+val.id+`'>Update</button>
											<button id='del' class='btn btn-danger' data-id='`+val.id+`'>Delete</button>
										</td>
									</tr>
								`);
							});
						},
						error: function () {
								alert('data gagal dihapus');
						},
					});
			}, 2000);
		}

	



		showAll();
		$('tbody').on('click','#del', function () {
			var id = $(this).attr('data-id');
    		var c_obj = $(this).parents("tr");
			if(confirm("Are you sure you want to delete this?")){
				$.ajax({
					url: 'http://demo.var-x.id/api/product/'+id,
					method:'DELETE',
					contentType: 'application/json',
					dataType: 'json',
					headers: {
						'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'
						},
					// success: function(result){
					// 	// alert('jad');
					// },
				})
				location.reload();
				// $(".alert-success ").append('Data telah dihapus');;
				// $(".alert-success ").show(10);
				alert('data berhasil dihapus')
			}
		});

		$('#modalinput').submit(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			$.ajax({
				url: 'http://demo.var-x.id/api/product',
				type: "POST",
				data: $(this).serialize(),
				headers: {
					'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'
					},
				success: function( response ) {
					console.log( response );
					alert('success');
					location.reload();
				}
			});
			return false;
		});

		$('tbody').on('click','#update-btn', function(){
			var prform = $(this).parents("tr");
			var name = prform.find("#input-name").val();
			var brand = prform.find("#input-brand").val();
			var price = prform.find("#input-price").val();
			var category_id = prform.find("#input-category_id").val();
			var quantity = prform.find("#input-quantity").val();
			var quantity_unit = prform.find("#input-quantity_unit").val();
			var purchase_date = prform.find("#input-purchase_date").val();
			var id = $(this).data("id");
			var data = {
					"name" : name,
					"brand" : brand,
					"price" : price,
					"category_id" : category_id,
					"quantity_unit" : quantity_unit,
					"quantity" : quantity,
					"purchase_date" : purchase_date,
			}
			$.ajax({
				url: 'http://demo.var-x.id/api/product/'+id,
				type: "PUT",
				dataType: 'JSON',
				data: data,
				headers: {
					'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'
					},
				success: function( response ) {
					console.log( response );
					alert('Succes, data update');
					location.reload();
				},error: function () {
						alert('failed');
				},
			});
			
		});

	});
</script>

