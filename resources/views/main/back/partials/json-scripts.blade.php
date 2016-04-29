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
				name: "{{ $building->name }}",
				description: "{{ $building->description }}",
      			height: {{ $building->height }},
      			roofColor: "{{ $building->roofcolor }}",
      			wallColor: "{{ $building->wallcolor }}"
				}
			},
		@endforeach
	]
};
