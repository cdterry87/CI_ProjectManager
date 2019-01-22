<table class="table is-striped is-narrow is-hoverable is-fullwidth">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(empty($my_customers)){
        ?>
        <tr>
            <td colspan="2">No customers assigned to me.</td>
        </tr>
        <?php
            }else{
                foreach($my_customers as $row){
                    $link='sales/customers/view/'.$row['customer_id'];
        ?>
        <tr>
            <td><?php echo anchor($link, $row['customer_name']); ?></td>
            <td><?php echo anchor($link, ucfirst($row['customer_status'])); ?></td>
        </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>