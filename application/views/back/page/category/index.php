<div class="container p-3 px-5  mt-5 shadow-sm  bg-white rounded">
	<div class="row">
		<div class="col-md-12">

			<!-- <div class='alert alert-success alert-dismissible fade show' role='alert'>
				<strong>Succes</strong> <span id='message'></span>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				</button>
			</div> -->
		<?php 
			// if ($this->session->has_userdata('succes')) {
			// 	echo "
			// 		<div class='alert alert-success alert-dismissible fade show' role='alert'>
			// 			<strong>Succes</strong> ".$this->session->userdata('succes')."
			// 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			// 				<span aria-hidden='true'>&times;</span>
			// 			</button>
			// 		</div>
			// 		";
			// }
			// if ($this->session->has_userdata('alert')) {
			// 	echo "
			// 		<div class='alert alert-danger alert-dismissible fade show' role='alert'>
			// 			<strong>Failed</strong>".$this->session->userdata('alert')."
			// 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			// 				<span aria-hidden='true'>&times;</span>
			// 			</button>
			// 		</div>
			// 		";
			// }
		?>

		</div>
	</div>
	<div class="row p-3">
		<a class="ml-auto col-md-2  btn btn-submit" data-toggle="modal" data-target="#inputModal">Add Category</a>
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
						// $i = 1;
						// foreach ($result as $key) {
						// 	echo "
						// 		<tr>
						// 			<td>".$i++."</td>
						// 			<td>".$key['name']."</td>
						// 			<td>
						// 				<a class='btn text-white btn-primary' href='".base_url()."category/show/".$key['id']."/".$key['name']."'>Show</a>
						// 				<a onclick='del(".$key['id'].");return false;' class='btn btn-danger' >Delete</a>
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
					<input class="p-1 my-3"  required type="text" name="name" placeholder="Name">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn-submit" id="btn-save" name="submit">Create category</button>
				</div>
			</form>
		</div>
	</div>


<script>
	$(document).ready(function () {  
		function showAll(){
			$.ajax({
				url: 'http://demo.var-x.id/api/category/get',
				type:'GET',
				contentType: 'application/json',
				dataType: 'json',
				headers: {'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'},
				success: function(result){
					$.each(result.data, function (i, val) { 
						$('tbody').append(`
							<tr>
								<td>`+(++i)+`</td>
								<form>
								<td id="name" ><input id='input-name' value='`+val.name+`'/></td>
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
		}


		$('tbody').on('click','#del', function () {
			var id = $(this).attr('data-id');
    		var c_obj = $(this).parents("tr");
			if(confirm("Are you sure you want to delete this?")){
				$.ajax({
					url: 'http://demo.var-x.id/api/category/'+id,
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
				url: 'http://demo.var-x.id/api/category',
				type: "POST",
				data: $(this).serialize(),
				headers: {
					'Authorization' : 'Bearer <?php echo $this->session->userdata('token'); ?>'
					},
				success: function( response ) {
					console.log( response );
					alert('jadi');
					location.reload();
				}
			});
			return false;
		});
	
		$('tbody').on('click','#update-btn', function(){
			var prform = $(this).parents("tr");
			var name = prform.find("#input-name").val();
			var id = $(this).data("id");
			var data = {
				"name" : name,
			}
			$.ajax({
				url: 'http://demo.var-x.id/api/category/'+id,
				type: "PUT",
				dataType: 'JSON',
				data: {
					"name" : name,
					},
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

		showAll();

	});
</script>

