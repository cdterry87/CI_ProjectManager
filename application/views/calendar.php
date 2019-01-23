<link rel="stylesheet" href="<?php echo base_url('public/fullcalendar/fullcalendar.min.css'); ?>">
<script src="<?php echo base_url('public/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('public/fullcalendar/fullcalendar.min.js'); ?>"></script>

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
                url: 'api/calendar/project_dates',
                color: '#209CEE',
                textColor: 'white'
            },
            {
                url: 'api/calendar/support_dates',
                color: '#FF3860',
                textColor: 'white'
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