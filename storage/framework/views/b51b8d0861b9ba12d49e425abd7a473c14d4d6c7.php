          <?php foreach($buildings as $building): ?>
            <tr>
              <td class="text-primary"><strong><?php echo e($building->name); ?></strong></td>
              <td><?php echo e($building->description); ?></td> 
            </tr>
          <?php endforeach; ?>
