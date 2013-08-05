<?php


//echo count($x);
//echo date('timestamp', strtotime(date('F').' 21, '.date('Y')));
include 'calendar.php';
 
$month = isset($_GET['m']) ? $_GET['m'] : NULL;
$year  = isset($_GET['y']) ? $_GET['y'] : NULL;
 
$calendar = Calendar::factory($month, $year);
     
/*$event2 = $calendar->event()
    ->condition('timestamp', strtotime(date('F').' 22, '.date('Y')))
    ->title('Something Awesome')
    ->output("Hi");*/

$calendar->standard('today')
    ->standard('prev-next') 
    ->standard('holidays');
    //->attach($event1);
   // ->attach($event2); 
	?>
	<style>
	.calendar {width:100%; border-collapse:collapse;}
.calendar tr.navigation th {padding-bottom:20px;}
.calendar th.prev-month {text-align:left;}
.calendar th.current-month {text-align:center; font-size:1.5em;}
.calendar th.next-month {text-align:right;}
.calendar tr.weekdays th {text-align:left;}
.calendar td {width:14%; height:100px; vertical-align:top; border:1px solid #CCC;}
.calendar td.today {background:#FFD;}
.calendar td.prev-next {background:#EEE;}
.calendar td.prev-next span.date {color:#9C9C9C;}
.calendar td.holiday {background:#DDFFDE;}
.calendar span.date {display:block; padding:4px; line-height:12px; background:#EEE;}
.calendar div.day-content {}
.calendar ul.output {margin:0; padding:0 4px; list-style:none;}
.calendar ul.output li {margin:0; padding:5px 0; line-height:1em; border-bottom:1px solid #CCC;}
.calendar ul.output li:last-child {border:0;}
 
/* Small Calendar */
.calendar.small {width:auto; border-collapse:separate;}
.calendar.small tr.navigation th {padding-bottom:5px;}
.calendar.small tr.navigation th a {font-size:1.5em;}
.calendar.small th.current-month {font-size:1em;}
.calendar.small tr.weekdays th {text-align:center;}
.calendar.small td {width:auto; height:auto; padding:4px 8px; text-align:center; border:0; background:#EEE;}
.calendar.small span.date {display:inline; padding:0; background:none;}
#date a {
			text-decoration:none;
			display:block;
			width:35px;
			height:30px;
			background:red;
			color:#004a80;
			font-weight:bold;
		}
</style>
	<table class="calendar small">
    <thead>
        <tr class="navigation">
            <th class="prev-month"><a href="<?php echo htmlspecialchars($calendar->prev_month_url()) ?>"><?php echo $calendar->prev_month(0, '&laquo;') ?></a></th>
            <th colspan="5" class="current-month"><?php echo $calendar->month() ?> <?php echo $calendar->year ?></th>
            <th class="next-month"><a href="<?php echo htmlspecialchars($calendar->next_month_url()) ?>"><?php echo $calendar->next_month(0, '&raquo;') ?></a></th>
        </tr>
        <tr class="weekdays">
            <?php foreach ($calendar->days(1) as $day): ?>
                <th><?php echo $day ?></th>
            <?php endforeach ?>
        </tr>
	
    </thead>
    <tbody>
        <?php foreach ($calendar->weeks() as $week): ?>
            <tr>
                <?php foreach ($week as $day): ?>
                    <?php
                    list($number, $current, $data) = $day;
                     
                    $classes = array();
                    $output  = '';
                     
                    if (is_array($data))
                    {
                        $classes = $data['classes'];
                        $title   = $data['title'];
                        $output  = empty($data['output']) ? '' : '<ul class="output"><li>'.implode('</li><li>', $data['output']).'</li></ul>';
                    }
                    ?>
                    <td class="day <?php echo implode(' ', $classes) ?>">
                        <span class="date" title="<?php echo implode(' / ', $title) ?>">
                            <?php if ( ! empty($output)):
							$t_slug=url_title($title[0],'dash',TRUE);
							if($t_slug=='today')
							$t_slug=url_title($title[1],'dash',TRUE);
							?>
                                <a href="<?echo site_url('students/viewevent').'/'.$t_slug?>" class="view-events"><?php echo $number ?></a>
                            <?php else: ?>
                                <?php echo $number ?>
                            <?php endif ?>
                        </span>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>