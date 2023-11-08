<!-- Required for graphical charts -->
<link href="<?php echo base_url('public/jqplot/jquery.jqplot.min.css'); ?>" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url('public/jqplot/jquery.jqplot.min.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/excanvas.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/plugins/jqplot.pieRenderer.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/plugins/jqplot.barRenderer.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/plugins/jqplot.categoryAxisRenderer.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/plugins/jqplot.pointLabels.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/plugins/jqplot.canvasTextRenderer.js'); ?>"></script>
<script src="<?php echo base_url('public/jqplot/plugins/jqplot.canvasAxisLabelRenderer.js'); ?>"></script>

<?php $this->load->view('support/navigation'); ?>

<?php

$cust=array();
$total_per_customer=array();
if(!empty($customers)){
    foreach($customers as $row){
        $cust[$row['customer_id']]=$row['customer_Name'];
        $total_per_customer[$row['customer_id']]=0;
    }
}

$total_count=0;
$total_per_year=array();
$total_per_month=array();
$total_per_day=array();
$total_per_status=array();
if(!empty($support)){
    
    foreach($support as $row){
        $curr_year=substr($row['support_date'], 0, 4);
        $curr_month=substr($row['support_date'], 0, 6);
        
        switch($row['support_status']){
            case 'C':
                $curr_status="Closed";
                break;
            case 'A':
                $curr_status="Archived";
                break;
            default:
                $curr_status="Open";
                break;
        }
        
        $total_count++;
        $total_per_status[$curr_status]++;
        $total_per_customer[$row['customer_id']]++;
        $total_per_day[$row['support_date']]++;
        $total_per_month[$curr_month]++;
        $total_per_year[$curr_year]++;
    }
}

arsort($total_per_customer);

//echo "<pre>Total Per Year:<br>".print_r($total_per_year, true)."</pre><hr/>";
//echo "<pre>Total Per Month:<br>".print_r($total_per_month, true)."</pre><hr/>";
//echo "<pre>Total Per Day:<br>".print_r($total_per_day, true)."</pre><hr/>";
//echo "<pre>Total Per Customer:<br>".print_r($total_per_customer, true)."</pre><hr/>";
//echo "<pre>Total Per Status:<br>".print_r($total_per_status, true)."</pre><hr/>";

?>

<style>
    .plot{height: 400px;}
    table.jqplot-table-legend{width: auto !important;}
</style>
<div><h2>Total Support Issues: <u><?php echo $total_count; ?></u></h2></div>
<hr/>
<div class="col-md-6">
    <h3 class="center">Totals Per Status</h3>
    <div id="total_per_status" class="plot"></div>
</div>
<div class="col-md-6">
    <h3 class="center">Totals Per Day Last Month</h3>
    <div id="total_this_month" class="plot"></div>
</div>
<div class="col-md-6">
    <h3 class="center">Totals Per Year</h3>
    <div id="total_per_year" class="plot"></div>
</div>
<div class="col-md-6">
    <h3 class="center">Totals Per Customer (Top 10)</h3>
    <div id="total_per_customer" class="plot"></div>
</div>

<script>
    ////////////////////////////////////////
    //Reports By Status (Pie Chart)
    ////////////////////////////////////////
    $.jqplot ('total_per_status', [[
    <?php
        if(!empty($total_per_status)){
            foreach($total_per_status as $key=>$val){
    ?>
            ['<?php echo $key; ?>', <?php echo $val; ?>],
    <?php
            }
        }else{
    ?>
            ['NO DATA',1],
    <?php
        }
    ?>
    ]],{
        seriesDefaults: {
            // Make this a pie chart.
            renderer: $.jqplot.PieRenderer,
            rendererOptions: {
                // Put data labels on the pie slices.
                // By default, labels show the percentage of the slice.
                showDataLabels: true,
                sliceMargin: 4,
                dataLabels: 'value'
            },
            shadow: false,
        },
        legend: { show:true, location: 'e' }
    });
    
    ////////////////////////////////////////
    //Reports By Customer (Pie Chart)
    ////////////////////////////////////////
    $.jqplot ('total_per_customer', [[
    <?php
        $cust_count=0;
        if(!empty($total_per_customer)){
            foreach($total_per_customer as $key=>$val){
    ?>
            ['<?php echo $cust[$key]; ?>', <?php echo $val; ?>],
    <?php
                $cust_count++;
                if($cust_count==10){
                    break;
                }
            }
        }else{
    ?>
            ['NO DATA',1],
    <?php
        }
    ?>
    ]],{
        seriesDefaults: {
            // Make this a pie chart.
            renderer: $.jqplot.PieRenderer,
            rendererOptions: {
                // Put data labels on the pie slices.
                // By default, labels show the percentage of the slice.
                showDataLabels: true,
                sliceMargin: 4,
                dataLabels: 'value'
            },
            shadow: false,
        },
        legend: { show:true, location: 'e' }
    });
    
    ////////////////////////////////////////
    //Issues This Month (Line Chart)
    ////////////////////////////////////////
    $.jqplot ('total_this_month', [[
    <?php
        if(!empty($total_per_day)){
            //Determine the last month
            if(date('m')=='01'){
                $last_month=date('Y')-1;
                $last_month=$last_month.'12';
            }else{
                $last_month=date('Ym')-1;
            }
            foreach($total_per_day as $key=>$val){
                if($last_month==substr($key, 0, 6)){
    ?>
        [<?php echo substr($key, 6,2); ?>, <?php echo $val; ?>],
    <?php
            }
            }
        }else{
    ?>
            ['',0],
    <?php
        }
    ?>
                              ]],{
        axesDefaults: {
            //Allows vertical text for labels on Y axis
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer
        },
        axes: {
            xaxis: {
                //Specify a label for the X axis.
                label: 'Day of the Month (<?php echo date('F', strtotime('-1 months')); ?>)',
                //Allow data to start at the edges of the grid.
                pad: 0
            },
            yaxis: {
                //Specify a label for the Y axis.
                label: 'Number of Reports'
            }
        }
    });
    
    ////////////////////////////////////////
    //Issues Per Year (Bar Chart)
    ////////////////////////////////////////
    $(document).ready(function(){
        var line1 = [
        <?php
            if(!empty($total_per_year)){
                $line1='';
                foreach($total_per_year as $key=>$val){
                    $line1.="['".$key."', ".$val."],";
                }
                $line1=substr($line1, 0, -1);
            }
            echo $line1;
        ?>
        ];
     
        $('#total_per_year').jqplot([line1], {
            //title:'Bar Chart with Varying Colors',
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {
                    // Set the varyBarColor option to true to use different colors for each bar.
                    // The default series colors are used.
                    varyBarColor: true
                }
            },
            axes:{
                xaxis:{
                    renderer: $.jqplot.CategoryAxisRenderer
                }
            }
        });
    });
</script>