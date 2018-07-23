<?php 
    $ongoing = array();
    $complete = array();
    $reject = array();
    $hold = array();
    $created = array();
    if(count($stat_details->groupBy('title')) > 0){
        foreach($stat_details->groupBy('title') as $title){
            $ongoing[] = $title->sum('ongoing');
            $complete[] = $title->sum('complete');
            $reject[] = $title->sum('reject');
            $hold[] = $title->sum('hold');
            $created[] = $title->sum('created');
        }   
    }else{
        $ongoing[] = 0;
        $complete[] = 0;
        $reject[] = 0;
        $hold[] = 0;
        $created[] = 0;
    }

    // ->sortBy('month')->sortBy('year')
?>



<canvas id="myChart" 
    data-date="{{ json_encode($stat_details->unique('title')->pluck('title')->toArray()) }}" 
    data-ongoing="{{ json_encode($ongoing) }}" data-complete="{{ json_encode($complete) }}" data-created="{{ json_encode($created) }}"
    data-reject="{{ json_encode($reject) }}" data-hold="{{ json_encode($hold) }}" height="300px"> </canvas>