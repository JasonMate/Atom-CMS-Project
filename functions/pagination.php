<?php
$q = "SELECT COUNT(id) FROM $table_name";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$rows = $row[0];
$last = ceil($rows/$page_rows);

if($last < 1){
	$last = 1;
}

$pagenum = 1;

if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}

if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

$q = "SELECT * FROM $table_name ORDER BY id DESC $limit";
$r = mysqli_query($dbc, $q);
$paginationCtrls = '';

if($last != 1){

	if ($pagenum > 1) {
    $previous = $pagenum - 1;
	  $paginationCtrls .= '<button><a href="'.$_SERVER['PHP_SELF'].'?page='.$page_name.'&pn='.$previous.'"><i class="fa fa-angle-double-left"></i></a></button>&nbsp;&nbsp;';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		     $paginationCtrls .= '<button><a href="'.$_SERVER['PHP_SELF'].'?page='.$page_name.'&pn='.$i.'">'.$i.'</a></button>&nbsp;&nbsp;';
			}
	  }
  }

	$paginationCtrls .= ''.$pagenum.'&nbsp;&nbsp;';

	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<button><a href="'.$_SERVER['PHP_SELF'].'?page='.$page_name.'&pn='.$i.'">'.$i.'</a></button>&nbsp;&nbsp;';
		if($i >= $pagenum+4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<button><a href="'.$_SERVER['PHP_SELF'].'?page='.$page_name.'&pn='.$next.'"><i class="fa fa-angle-double-right"></i></a></button>';
    }
}
?>