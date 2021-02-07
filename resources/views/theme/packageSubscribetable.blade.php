<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <!-- <th>Image</th> -->
            <th>User Detail</th>
            <th>Package Detail</th>
            <th>Validity Time Period</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($getSubscribepackages) {
            foreach ($getSubscribepackages as $package) {
                ?>
        <tr id="dataid{{$package->package_id}}">
            <td>{{$package->package_id}}</td>
            <!-- <td><img src='{!! asset("public/images/packages/".$package->image) !!}' class='img-fluid' style='max-height: 50px;'></td> -->
            <td>{{$package->name}}
            <br>
            {{$package->email}}
            <br>
            {{$package->mobile}}
        
            </td>
            <td>
            {{$package->package_name}}
            <br>
            
            

            </td>
            <td>
            {{$package->package_validity}} day
            </td>
            <td>    
             <select  onchange="updatePackageStatus(this.value,<?php echo $package->user_id ?>,<?= $package->product_id?>)">
              <option value="Request initiate"  <?=$package->status=='Request initiate' ? 'selected': ''?>>Initiate</option>
              <option value="Request Approved" <?=$package->status=='Request Approved' ? 'selected': ''?>>Approved</option>
             </select>
            </td>
            <td>
            {{$package->created_at}}
            </td>
            <!-- <td>{{$package->package_validity}} day</td>
            <td>{{$package->meals}} </td>
            <td>{{$package->package_amount}} </td>
            <td>{{$package->created_at}} </td> -->
            

            <td>
               
                <span>
                <a href="#" class="badge badge-info px-2" onclick="deletePackage('<?php echo $package->product_id ?>','<?php echo $package->user_id ?>','2')" style="color: #fff;">Delete</a>
                </span>
            </td>
           
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>