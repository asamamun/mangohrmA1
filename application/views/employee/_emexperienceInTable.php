<div class="col-md-12">
    <table class="table sar-table table-bordered table-striped table-responsive" id="tableempexperience">
        <tr id="tablehead">
            <th rowspan="2">SL</th>
            <th rowspan="2">Company</th> 
            <th rowspan="2">Occupation</th>
            <th colspan="2">Experience</th>          
            <th rowspan="2">Comment</th>
            <th rowspan="2">Action</th>
        </tr>

        <tr>
            <th>From</th>
            <th>To</th>
        </tr>

        <?php
        $c = 1;
        foreach ($empexperience as $emp_experience) {
            echo '<tr>';
            echo '<td>' . $c++ . '</td>';
            echo '<td>' . $emp_experience['company'] . '</td>';
            echo '<td>' . $emp_experience['occupation'] . '</td>';
            echo '<td>' . $emp_experience['exp_from'] . '</td>';
            echo '<td>' . $emp_experience['exp_to'] . '</td>';
            echo '<td>' . $emp_experience['comment'] . '</td>';
            echo '<td>' . '<a class="btn btn-sm btn-warning" href="#" title="Edit" onClick="edit_empexperience(' . $emp_experience['id'] . ')"><i class="glyphicon glyphicon-pencil"></i> </a>' . ' ' . '<a class="btn btn-sm btn-danger" href="#" title="Hapus" onClick="delete_empexperience(' . $emp_experience['id'] . ')"><i class="glyphicon glyphicon-trash"></i> </a>' . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
