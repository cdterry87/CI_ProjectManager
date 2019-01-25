<link rel="stylesheet" href="<?php echo base_url('public/fullcalendar/fullcalendar.min.css'); ?>">
<script src="<?php echo base_url('public/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('public/fullcalendar/fullcalendar.min.js'); ?>"></script>

<div class="field is-grouped is-grouped-centered">
    <div class="control">
        <div class="tags has-addons">
            <div class="tag is-danger">Open Support</div>
            <div class="tag is-warning">Closed Support</div>
            <div class="tag is-info">Incomplete Project</div>
            <div class="tag is-success has-text-dark">Complete Project</div>
        </div>
    </div>
</div>

<div id="calendar"></div>

<script>
$(function() {
    $('#calendar').fullCalendar({
        defaultView: 'month',

        header: {
            left:   'title',
            center: 'month,basicWeek,listWeek',
            right:  'today prev,next'
        },
        
        eventSources: [
            {
                url: 'api/calendar/incomplete_project_dates',
                color: '#209CEE',
                textColor: 'white'
            },
            {
                url: 'api/calendar/open_support_dates',
                color: '#FF3860',
                textColor: 'white'
            },
            {
                url: 'api/calendar/complete_project_dates',
                color: '#23D160',
                textColor: '#222222'
            },
            {
                url: 'api/calendar/closed_support_dates',
                color: '#FFDD57',
                textColor: '#222222'
            },
        ],
        eventClick: function(event) {
            if (event.url) {
                window.open(event.url);
                return false;
            }
        }
    });
});

</script>