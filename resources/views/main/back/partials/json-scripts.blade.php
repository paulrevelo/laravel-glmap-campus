var geojson = {
	type: "FeatureCollection", 
	features: [
		
		@foreach($buildings as $building)
			{
				type: "Feature", 
				geometry: {
					type: "Polygon",
					coordinates: {{ $building->polygon }}
				},
				properties: {
					id: "{{ $building->id }}",
     			roofColor: "{{ $building->roofcolor }}",
      		height: {{ $building->height }},
      		wallColor: "{{ $building->wallcolor }}"
				}
			},
		@endforeach
	]
};
