<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Delivery Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getitem as $item) {
            // print_r($item);
        ?>
        <tr id="dataid<?php echo e($item->id); ?>">
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e(@$item['category']->category_name); ?></td>
            <td><?php echo e($item->item_name); ?></td>
            <td><?php echo env('CURRENCY').''.number_format($item->item_price, 2); ?></td>
            <td><?php echo e($item->delivery_time); ?></td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($item->id); ?>')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    <a data-toggle="tooltip" href="<?php echo e(URL::to('admin/item-images/'.$item->id)); ?>" data-original-title="View">
                        <span class="badge badge-warning">View</span>
                    </a>
                    <a class="badge badge-danger px-2" onclick="StatusUpdate('<?php echo e($item->id); ?>','2')" style="color: #fff;">Delete</a>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/theme/itemtable.blade.php ENDPATH**/ ?>