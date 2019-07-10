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
							<tbody id='table-list'>
							
							</tbody>
							<?php
							// $i = 0;
							// $to = 0;
							// 	foreach ($tmp as $key) {
							// 		$to += $key['quantity']*$key['price'];
							// 		echo "
							// 			<tr class='text-center p-2' style='line-height:30px !important;'>
							// 				<td >".++$i."</td>
							// 				<td class='text-left'>".$key['name']."</td>
							// 				<td>".$key['quantity']." ".$key['quantity_unit']."</td>
							// 				<td>Rp. ".number_format($key['price'])." </td>
							// 				<td>Rp. ".number_format($key['quantity']*$key['price'])."</td>
							// 				<td>
							// 					<a class=' p-1 '  href='".base_url()."transc/delete/".$key['id']."'>Delete</a>
											
							// 					</td>
							// 			</tr>
							// 		";
							// 	}
							?>
						</table>
					</div>
			</div>
			<div class="row pt-4">
				<div class="col-md-12 ">
					<form method="POST">
							<input class="p-1 my-2" required type="text" id="input-customer" name="name" placeholder="Customer Name">
							<input class="p-1 my-2" required type="number" id="input-cash" name="cash" placeholder="Cash">
						<div class="w-50" style="">
							<button class="btn-submit mt-1" id="transc-sumbit" name="submit">Buy</button>
						</div>
					</form>
				</div>
			</div>

		</div>
		<div class="col-md-7 ml-3 p-2 shadow  bg-white rounded">
			<div class="container-fluid table-custom" style="height:600px !important;">
				<h4 class="my-3">Product List</h4>
				<div class="row ">
					
					<?php
					
						foreach ($product as $p ) {
							echo "
								<div class='col-md-3 mx-4 mt-3 card p-0' >
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
										<form id='form'  method='POST'>
											<input type='hidden' id='input-name' name='name' value='".$p['name']."'/>
											<input type='hidden' id='input-price' name='price' value='".$p['price']."'/>
											<input type='hidden' id='input-quantity_unit' name='quantity_unit' value='".$p['quantity_unit']."'/>
											<input type='hidden' id='input-product_id' name='product_id' value='".$p['id']."'/>
											<input type='number'  id='input-quantity' name='quantity' value='1'/>
											<br>
											<button class='mt-3 btn-submit btn-choose' ' name='submit'>Choose</button>
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


<script>
	$(document).ready(function () {  
	
		function tableShoppingList(){
			var data = JSON.parse(localStorage.getItem('dataList'));
			let a = 0;
			$.each(data, function (i, val) { 
				$('#table-list').append(`
					<tr class='text-center'>	
						<td>`+(++i)+`</td>
						<td class='text-left'>`+val.name+`</td>
						<td>`+val.price+`</td>
						<td>`+val.quantity+` `+val.quantity_unit+`</td>
						<td>`+(val.price*val.quantity)+`</td>
						<td class='text-center'> 
							<button id='del' class='btn btn-danger px-2 py-0 m-1' data-id='`+a+`'>X</button>
						</td>
					</tr>
				`);
				a++;

			});
		}
		$('.btn-choose').on('click', function (e) {
			var dat = JSON.parse(localStorage.getItem('dataList'));
			var frm = $(this).parents('form');
			var data1 = {};
			var product_id = frm.find('#input-product_id').val();
			var name = frm.find('#input-name').val();
			var price = frm.find('#input-price').val();
			var quantity_unit = frm.find('#input-quantity_unit').val();
			var quantity 	= parseInt( frm.find('#input-quantity').val());
			var existstatus = false;
			var ix;
			$.each(dat, function (i, val) { 
				if (val.product_id==product_id) {
					existstatus = true;
					ix = i;
				}
			});
			if (existstatus==true) {
				var tmp = dat.splice(ix,1);
				data1={
					'product_id' : tmp[0].product_id,
					'name' : tmp[0].name,
					'price' : tmp[0].price,
					'quantity_unit' : quantity_unit,
					'quantity' : parseInt(tmp[0].quantity) + quantity,
				}
				dat.splice(ix,0,data1);
			}else{
				data1 =  
					{
					'product_id' : product_id,
					'name' : name,
					'price' : price,
					'quantity_unit' : quantity_unit,
					'quantity' : quantity,
				};
				dat.push(data1);
			}
			localStorage.setItem('dataList', JSON.stringify(dat));
			alert('data di tambahkan');
			location.reload();
			e.preventDefault();
		});

		$('#table-list').on('click','#del', function (e) {
			var id = $(this).attr('data-id');
			var data = JSON.parse(localStorage.getItem('dataList'));
			data.splice(id,1);
			localStorage.setItem('dataList', JSON.stringify(data));
			location.reload();
		});

		//end transcartion
		$('#transc-sumbit').on('click', function (e) {
			e.preventDefault();
			var form = $(this).parents('form');
			var cust_name = form.find('#input-customer').val();
			var cash = form.find('#input-cash').val();
			var total = 0;
			var dat = JSON.parse(localStorage.getItem('dataList'));
			var dat2 = [];
			$.each(dat, function (i, val) { 
				total += (val.price*val.quantity);
				let dattmp = {
					'product_id' : val.product_id,
					'quantity' : val.quantity,
				}
				dat2.push(dattmp);
			})
			if (cash<total) {
				alert('Total bayar tidak cukup');
				location.reload();
			}else{
			
				var data = {
					'transaction':{
						'customer_name' : cust_name,
					},
					'transaction_products':dat2,
				}
				console.log(data);

				$.ajax({
					url: 'http://demo.var-x.id/api/transaction',
					type: "POST",
					dataType: 'JSON',
					data: data,
					headers: {
						'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'
						},
					success: function( response ) {
						console.log(response);
						localStorage.clear();
						alert('Succes, kembalian anda : '+(cash-total));
						return location.reload();

					},error: function () {
						alert('failed');
					},
				});

			}


		});


		tableShoppingList();

	});
</script>
