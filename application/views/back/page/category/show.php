<div class="container">
	<div class="row justify-content-md-center">
			<form class=" col-md-12 mt-5 p-5 shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo base_url();?>category/update" method="POST">
				<h1 class="mb-3">Detail category</h1>
				<div class="w-50">
					<input class="p-1 my-3" required type="text" name="name" placeholder="Name" value="<?php echo $name?>">
					<input type="hidden" name="id" placeholder="Name" value="<?php echo $id?>">
				</div>
				<div style="">
					<button class="btn-submit col-md-2" name="submit">Update category</button>
					<a class="btn btn-submit col-md-2" href='<?php echo base_url()."category/delete/".$id; ?>"'>Delete category</a>
				</div>
			</form>
	</div>
</div>
