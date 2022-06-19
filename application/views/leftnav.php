<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo site_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->




        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Company Info</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($active == "Company_Info") echo 'class="active"'; ?>><?php echo anchor('Company_Setup', '<i class="fa fa-circle-o"></i>Company', 'title="Company_Setup"'); ?></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Configuration</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($active == "Department") echo 'class="active"'; ?>><?php echo anchor('department', '<i class="fa fa-circle-o"></i>Department', 'title="Department"'); ?></li>
                    <li <?php if ($active == "Section") echo 'class="active"'; ?>><?php echo anchor('section', '<i class="fa fa-circle-o"></i>Section', 'title="Section"'); ?></li>
                    <li <?php if ($active == "Designation") echo 'class="active"'; ?>><?php echo anchor('designations', '<i class="fa fa-circle-o"></i>Designation', 'title="Designation"'); ?></li>
                    <li <?php if ($active == "Empgrade") echo 'class="active"'; ?>><?php echo anchor('empgrade/index', '<i class="fa fa-circle-o"></i>Grade', 'title="Grade"'); ?></li>
                </ul>
            </li>  


            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Employee Manage</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($active == "Employee_List") echo 'class="active"'; ?>><?php echo anchor('employee/emp_table_load', '<i class="fa fa-circle-o"></i>Employee List', 'title="Employee List"'); ?></li>                                
                    <li <?php if ($active == "Employee_gen_first") echo 'class="active"'; ?>><?php echo anchor('employee/add_emp_gen_info', '<i class="fa fa-circle-o"></i>Add Employee', 'title="Add Employee"'); ?></li>                                
                </ul>
            </li>



            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Leave Manage</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($active == "Leave_manage") echo 'class="active sidebar-toggle"'; ?>><?php echo anchor('leave/index', '<i class="fa fa-circle-o"></i>Leave Manage', 'title="Leave Manage"'); ?></li>                                

                </ul>
            </li>		

            <li class="treeview" active>
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Attendance Management</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($active == "Attend_Upload") echo 'class="active"'; ?>><?php echo anchor('Attend_upload/index', '<i class="fa fa-circle-o"></i>Attendance Upload', 'title="Attendance Upload"'); ?></li>                                
                    <li <?php // if ($active == "employee") echo 'class="active"';  ?>><?php // echo anchor('employee/add_emp_gen_info', '<i class="fa fa-circle-o"></i>Add Employee', 'title="Add Employee"');  ?></li>                                
                </ul>
            </li>

            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Report Management</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($active == "Shift_wise_report") echo 'class="active"'; ?>><?php echo anchor('Report_Shift_wise/index', '<i class="fa fa-circle-o"></i>Shift Wise Report', 'title="Shift Wise Report"'); ?></li>                                

                </ul>			

                </section>
                <!-- /.sidebar -->
                </aside>
