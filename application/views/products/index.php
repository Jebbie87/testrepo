<?php setlocale(LC_MONETARY, 'en_US.UTF-8'); ?>
<h1 class="page-title"><strong><?= $title ?></strong></h1>

<div class="products">
<?php foreach ($products as $product): ?>

	<div class="product">
		<?php if ($product['quantity'] == 0) : ?>
			<div class="sold-out">Sold out</div>
		<?php endif; ?>
		<a href="<?php echo base_url(); ?>products/<?php echo $product['id'] ?>">
			<img class="product-image" src="<?php echo base_url(); echo "assets/images/products/"; echo $product['product_image']; ?>">
		</a>

		<p>Name: <?php echo $product['name']; ?></p>

		<p>Price: <?php echo money_format('%.2n', $product['price'] * $current_price); ?></p>
		<p>Description: <?php echo $product['description']; ?></p>
		<p>Quantity: <?php echo $product['quantity']; ?></p>
		<div class="product-buttons">
			<?php
				$hidden = array(
					'id' => $product['id'],
					'price' => $product['price'],
					'name' => $product['name'],
					'description' => $product['description']
				);
			 	echo form_open('products/add', '', $hidden);
				echo form_submit('', 'Add', ($product['quantity'] == 0 ? 'class="btn btn-default" disabled' : array('class' => 'btn btn-default') ));
				echo form_close();
			?>

			<a href="<?php echo base_url(); echo "products/"; echo $product['id'] ?>" class="btn btn-default">Details</a>

			<?php
				if ($this->session->userdata('logged_in') and $this->session->userdata('user_id') === $product['user_id']) {
				  echo form_open('/products/delete/'.$product['id']);
					echo form_submit(array('value' => 'Delete', 'class' => 'btn btn-danger'));
				  echo form_close();
				}
			?>
		</div>
	</div>
<?php endforeach; ?>

