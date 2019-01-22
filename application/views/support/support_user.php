<table class="table is-striped is-narrow is-hoverable is-fullwidth">
    <thead>
        <tr>
            <th>Support</th>
            <th>Customer</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (empty($my_support)) {
            ?>
        <tr>
            <td colspan="2">No support assigned to me.</td>
        </tr>
            <?php
        } else {
            foreach ($my_support as $row) {
                $link='support/view/'.$row['support_id'];
                ?>
        <tr>
            <td><?php echo anchor($link, $row['support_name']); ?></td>
            <td><?php echo anchor($link, $this->Customer_model->get_customer_name($row['customer_id'])); ?></td>
            <td><?php echo anchor($link, $this->format->date($row['support_date'])." ".$this->format->time($row['support_time'])); ?></td>
        </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>