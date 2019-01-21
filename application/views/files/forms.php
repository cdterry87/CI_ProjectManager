<?php
    if (empty($forms)) {
        echo "<p>No forms found.</p>";
    } else {
?>
<table class="table is-striped is-narrow is-hoverable is-fullwidth datatable">
    <thead>
        <tr>
            <th>Download</th> 
            <th>Title</th> 
            <th>Description</th> 
            <th>File</th> 
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            foreach ($forms as $row) {
        ?>
        <tr>
            <td><?php echo anchor('public/files/forms/'.$row['file_id']."/".$row['file_name'], '<i class="fas fa-download"></i>Download', 'target="_blank"'); ?></td>
            <td><?php echo $row['file_title']; ?></td>
            <td><?php echo $row['file_description']; ?></td>
            <td><?php echo $row['file_name']; ?> (<?php echo $row['file_size']; ?>KB)</td>
            <td><?php echo anchor('files/delete_form/'.$row['file_id'], '<i class="fas fa-trash"></i>', 'class="has-text-danger"'); ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<?php
    }
?>

