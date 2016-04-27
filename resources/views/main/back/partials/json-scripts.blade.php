	var geojson = {
		type: "FeatureCollection", 
		features: [
			
			@foreach($polygons as $polygon)
				{
					type: "Feature", 
					geometry: {
						type: "Polygon",
						coordinates: {{ $polygon->polygon }}
					},
					properties: {
						id: "{{ $polygon->id }}",
	           			roofColor: "{{ $polygon->roofcolor }}",
	            		height: {{ $polygon->height }},
	            		wallColor: "{{ $polygon->wallcolor }}"
					}
				},
			@endforeach
		]
	};
