var geojson = {
	"type": "FeatureCollection", 
	"features": [@foreach($buildings as $building){
		"type": "Feature", 
		"properties": {
			"id": "{{ $building->id }}",
			"name": "{{ $building->name }}",
			"description": "{{ $building->description }}",
      		"height": {{ $building->height }},
      		"roofColor": "{{ $building->roofcolor }}",
      		"wallColor": "{{ $building->wallcolor }}"},
		"geometry": {
			"type": "Polygon",
			"coordinates": {{ $building->polygon }}
			}			
		},
		@endforeach
		@foreach($events as $event)
		{
		"type": "Feature", 
		"properties": {
			"id": "{{ $event->id }}",
			"name": "{{ $event->name }}",
			"description": "{{ $event->description }}",
      		"room": "{{ $event->room }}",
      		"date": "{{ $event->date }}",
      		"time": "{{ $event->time }}"},
		"geometry": {
			"type": "Point",
			"coordinates": {{ $event->location }}
		}
				
		},
		@endforeach
	]
};
