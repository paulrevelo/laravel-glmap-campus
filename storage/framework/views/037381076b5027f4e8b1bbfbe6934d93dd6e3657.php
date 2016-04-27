	var geojson = {
		type: "FeatureCollection", 
		features: [
			
			<?php foreach($polygons as $polygon): ?>
				{
					type: "Feature", 
					geometry: {
						type: "Polygon",
						coordinates: <?php echo e($polygon->polygon); ?>

					},
					properties: {
									id: "<?php echo e($polygon->id); ?>",
	           			roofColor: "<?php echo e($polygon->roofcolor); ?>",
	            		height: <?php echo e($polygon->height); ?>,
	            		wallColor: "<?php echo e($polygon->wallcolor); ?>"
					}
				},
			<?php endforeach; ?>
		]
	};
