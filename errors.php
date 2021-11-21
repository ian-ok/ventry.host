<?php if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<!-- Include the Dark theme -->
			<link rel="stylesheet" href="node_modules/@sweetalert2/theme-dark/dark.css">

			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
			<script>
				Swal.fire({
					title: 'Error!',
					text: '<?php echo $error ?>',
					icon: 'error',
					confirmButtonText: 'Retry'
				}).then((result) => {
  if (result.isConfirmed) {
    window.location.replace('https://mhills.de');
  }
})
			</script>
		<?php endforeach ?>
	</div>
<?php endif ?>