<div class="row">
    <label for="subject_id">Periods: </label>
    <div class="ip_container">
        <?php if(!empty($cycle_periods)) foreach($cycle_periods as $k=>$v){ $v=(object) $v; if(isset($form_data['period_id']) && $v->id!=$form_data['period_id']){ ?>
        <label title="<?php echo $v->details; ?>"><input type='checkbox' value='<?php echo $v->id; ?>' name='extend_period_ids[]' /><?php echo $v->period_label,' - ',$v->time_label; ?></label>
        <?php } } ?>
    </div>
</div>