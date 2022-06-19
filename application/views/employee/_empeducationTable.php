<div class="col-md-12">
    <table class="table sar-table table-striped" id="tableempeducation">
        <tr id="tablehead">
            <th rowspan="2">SL</th>
            <th rowspan="2">Level</th>
            <th rowspan="2">Institute</th>
            <th rowspan="2">Board</th>
            <th rowspan="2">Major</th>               
            <th rowspan="2">Score</th>
            <th colspan="2">Session</th> 
			 <th rowspan="2">Passing</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
        </tr>
        <?php
        $c = 1;
		
        foreach ($empdata as $emp_education) {

            echo '<tr>';
            echo '<td>' . $c++ . '</td>';
            echo '<td>' . $emp_education['level'] . '</td>';
            echo '<td>' . $emp_education['institute'] . '</td>';
            echo '<td>' . $emp_education['board'] . '</td>';
            echo '<td>' . $emp_education['major'] . '</td>';
            
            echo '<td>' . $emp_education['score'] . '</td>';
            echo '<td>' . date("Y", strtotime($emp_education['start_date']))  . '</td>';
            echo '<td>' . date("Y", strtotime($emp_education['end_date'])) . '</td>';
			echo '<td>' . $emp_education['year'] . '</td>';
            echo '<td>' . '<a class="btn btn-sm btn-warning" href="#" title="Edit" onClick="edit_empeeducation(' . $emp_education['id'] . ')"><i class="glyphicon glyphicon-pencil"></i> </a>' . ' ' . '<a class="btn btn-sm btn-danger" href="#" title="Hapus" onClick="delete_empeducation(' . $emp_education['id'] . ')"><i class="glyphicon glyphicon-trash"></i> </a>' . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
