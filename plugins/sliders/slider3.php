<?php
function slider_value($dbc, $id){
	$q = "SELECT value FROM sliders WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
  
	return $data['value'];	
}

function slider_alt($dbc, $id){
	$q = "SELECT alt FROM sliders WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
  
	return $data['alt'];	
}

function slider_url($dbc, $id){
	$q = "SELECT url FROM sliders WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
  
	return $data['url'];	
}

$s1 = slider_value($dbc, 'f3-s1');
$a1 = slider_alt($dbc, 'f3-s1');
$u1 = slider_url($dbc, 'f3-s1');

$s2 = slider_value($dbc, 'f3-s2');
$a2 = slider_alt($dbc, 'f3-s2');
$u2 = slider_url($dbc, 'f3-s2');

$s3 = slider_value($dbc, 'f3-s3');
$a3 = slider_alt($dbc, 'f3-s3');
$u3 = slider_url($dbc, 'f3-s3');

$s4 = slider_value($dbc, 'f3-s4');
$a4 = slider_alt($dbc, 'f3-s4');
$u4 = slider_url($dbc, 'f3-s4');

$s5 = slider_value($dbc, 'f3-s5');
$a5 = slider_alt($dbc, 'f3-s5');
$u5 = slider_url($dbc, 'f3-s5');

$s6 = slider_value($dbc, 'f3-s6');
$a6 = slider_alt($dbc, 'f3-s6');
$u6 = slider_url($dbc, 'f3-s6');

# SLIDER 3

echo '<div class="slider-wrap">';
echo '<div id="Fader" class="fader">';
# ************************************

if($s1 != ""){
  if($u1 == ""){
    echo "<img style='z-index: 4;' class='slide' src='".$s1."' alt='".$a1."' />"; 
  } else {  
    echo "<a href='".$u1."'><img style='z-index: 4;' class='slide' src='".$s1."' alt='".$a1."' /></a>";  
  }  
}

if($s2 != ""){
  if($u2 == ""){
    echo "<img class='slide' src='".$s2."' alt='".$a2."' />"; 
  } else {  
    echo "<a href='".$u2."'><img class='slide' src='".$s2."' alt='".$a2."' /></a>";  
  }  
}

if($s3 != ""){
  if($u3 == ""){
    echo "<img class='slide' src='".$s3."' alt='".$a3."' />"; 
  } else {  
    echo "<a href='".$u3."'><img class='slide' src='".$s3."' alt='".$a3."' /></a>";  
  }  
}

if($s4 != ""){
  if($u4 == ""){
    echo "<img class='slide' src='".$s4."' alt='".$a4."' />"; 
  } else {  
    echo "<a href='".$u4."'><img class='slide' src='".$s4."' alt='".$a4."' /></a>";  
  }  
}

if($s5 != ""){
  if($u5 == ""){
    echo "<img class='slide' src='".$s5."' alt='".$a5."' />"; 
  } else {  
    echo "<a href='".$u5."'><img class='slide' src='".$s5."' alt='".$a5."' /></a>";  
  }  
}

if($s6 != ""){
  if($u6 == ""){
    echo "<img class='slide' src='".$s6."' alt='".$a6."' />"; 
  } else {  
    echo "<a href='".$u6."'><img class='slide' src='".$s6."' alt='".$a6."' /></a>";
  }  
}

# ************************************
echo '<div class="fader_controls">';
echo '<div style="z-index: 5;" class="page prev" data-target="prev">&lsaquo;</div>';
echo '<div style="z-index: 5;" class="page next" data-target="next">&rsaquo;</div>';
echo '<ul style="z-index: 5;" class="pager_list"></ul>';
echo '</div>';
echo '</div>';
echo '</div>';
?>