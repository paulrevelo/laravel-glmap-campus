          @foreach ($events as $event)
            <tr>
              <td class="text-primary"><strong>{{ $event->name }}</strong></td>
              <td>{{ $event->description }}</td> 
              <td>{{ $event->location }}</td> 
              <td>{{ $event->schedule }}</td> 
              <td></td>
            </tr>
          @endforeach
