<?php
$description = get_field('description');
$counter = 1;
if( have_rows('items') ):

    echo "<div class='expandableListSection' id='accordion'>";
    
    if($description):
    echo "<div class='container'>" . $description . "</div>";
    endif;
    echo "<div class='lists'>";
    
    while ( have_rows('items') ) : the_row();

$count = $counter++;

    echo "<div class='container'>
    <div class='item-heading'>
      
      <a data-toggle='collapse' data-parent='#accordion' href='#collapse" . $count . "'>
        <div class='row'>
            <div class='item-title'>
                <p>
                "; echo the_sub_field('list_title'); 
                echo "
                </p>
            </div>
            <div><span class='dashicons dashicons-arrow-down-alt2'></span></div>
        </div>
      </a>

    <div id='collapse" . $count . "' class='panel-collapse collapse'>
      <div class='item-body'>";
      the_sub_field('list_info');
    echo "</div>
    </div>
    </div>
  </div>";

    endwhile;
    echo "</div>";
    echo "</div>";
else :
endif;
?>