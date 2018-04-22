<?php
function paginate($reload, $page, $tpages, $adjacents,$funcion) {
	$prevlabel = "&lsaquo; Ant";
	$nextlabel = "Sig &rsaquo;";
	$out = '<ul class="pagination pagination-large">';
	
	// previous label

	if($page==1) {
		$out.= "<li class='disabled mypage'><span><a>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li class='mypage'><span><a href='javascript:void(0);' onclick='".$funcion."(1)'>$prevlabel</a></span></li>";
	}else {
		$out.= "<li class='mypage'><span><a href='javascript:void(0);' onclick='".$funcion."(".($page-1).")'>$prevlabel</a></span></li>";

	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= "<li class='mypage'><a href='javascript:void(0);' onclick='".$funcion."(1)'>1</a></li>";
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "<li class='mypage'><a>...</a></li>";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active mypage'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li class='mypage'><a href='javascript:void(0);' onclick='".$funcion."(1)'>$i</a></li>";
		}else {
			$out.= "<li class='mypage'><a href='javascript:void(0);' onclick='".$funcion."(".$i.")'>$i</a></li>";
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "<li class='mypage'><a>...</a></li>";
	}

	// last

	if($page<($tpages-$adjacents)) {
		$out.= "<li class='mypage'><a href='javascript:void(0);' onclick='".$funcion."($tpages)'>$tpages</a></li>";
	}

	// next

	if($page<$tpages) {
		$out.= "<li class='mypage'><span><a href='javascript:void(0);' onclick='".$funcion."(".($page+1).")'>$nextlabel</a></span></li>";
	}else {
		$out.= "<li class='disabled mypage'><span><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}
?>