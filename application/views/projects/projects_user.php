<table class="table is-striped is-narrow is-hoverable is-fullwidth">
    <thead>
        <tr>
            <th>Project</th> 
            <th>Customer</th> 
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (empty($my_projects)) {
            ?>
        <tr>
            <td colspan="2">No projects assigned to me.</td>
        </tr>
            <?php
        } else {
            foreach ($my_projects as $row) {
                $link='projects/view/'.$row['project_id'];
                ?>
        <tr>
            <td><?php echo anchor($link, $row['project_name']); ?></td>
            <td><?php echo anchor($link, $this->Customer_model->get_customer_name($row['customer_id'])); ?></td>
            <td><?php echo anchor($link, $this->format->date($row['project_date'])); ?></td>
        </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
