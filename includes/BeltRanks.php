<?php
	
	$cdsHtml = sprintf('<div type="hidden">');
	
	$cdsHtml .= sprintf("<div type='hidden' id='Hidden_Menu'>
							<ul class='dropdown-menu dropdown-menu-right' aria-labelledby='dLabel' style='background-color:grey;width:320px'></ul></div>");
	
	$cdsHtml .= sprintf("<div type='hidden' id='Little_Ninja_Menu'>
							<ul class='dropdown-menu dropdown-menu-right' aria-labelledby='dLabel' style='background-color:grey;width:320px'></ul></div>");
						
	$cdsHtml .= sprintf("<div type='hidden' id='Children_Menu'>
							<ul id='belt_change' class='dropdown-menu dropdown-menu-right' aria-labelledby='dLabel' style='background-color:grey;width:320px'>
								<li id='1.00' class='Children'><a><img style='vertical-align:middle' src='belts/W.png'>&nbsp;White Belt</a></li>
								<li id='1.01' class='Children'><a><img style='vertical-align:middle' src='belts/W1Y.png'>&nbsp;1 Yellow Stripe</a></li>
								<li id='1.02' class='Children'><a><img style='vertical-align:middle' src='belts/W2Y.png'>&nbsp;2 Yellow Stripes</a></li>
								<li id='1.03' class='Children'><a><img style='vertical-align:middle' src='belts/Y.png'>&nbsp;Yellow Belt</a></li>
								<li id='1.04' class='Children'><a><img style='vertical-align:middle' src='belts/Y1P.png'>&nbsp;Purple Stripe</a></li>
								<li id='1.05' class='Children'><a><img style='vertical-align:middle' src='belts/Y2P.png'>&nbsp;2 Purple Stripes</a></li>
								<li id='1.06' class='Children'><a><img style='vertical-align:middle' src='belts/P.png'>&nbsp;Purple Belt</a></li>
								<li id='1.07' class='Children'><a><img style='vertical-align:middle' src='belts/P1Bl.png'>&nbsp;1 Blue Stripe</a></li>
								<li id='1.08' class='Children'><a><img style='vertical-align:middle' src='belts/P2Bl.png'>&nbsp;2 Blue Stripes</a></li>
								<li id='1.09' class='Children'><a><img style='vertical-align:middle' src='belts/Bl.png'>&nbsp;Blue Belt</a></li>
								<li id='1.10' class='Children'><a><img style='vertical-align:middle' src='belts/Bl1G.png'>&nbsp;1 Green Stripe</a></li>
								<li id='1.11' class='Children'><a><img style='vertical-align:middle' src='belts/Bl2G.png'>&nbsp;2 Green Stripes</a></li>
								<li id='1.12' class='Children'><a><img style='vertical-align:middle' src='belts/G.png'>&nbsp;Green Belt</a></li>
								<li id='1.13' class='Children'><a><img style='vertical-align:middle' src='belts/G1Br.png'>&nbsp;1 Brown Stripe</a></li>
								<li id='1.14' class='Children'><a><img style='vertical-align:middle' src='belts/G2Br.png'>&nbsp;2 Brown Stripes</a></li>
								<li id='1.15' class='Children'><a><img style='vertical-align:middle' src='belts/G3Br.png'>&nbsp;3 Brown Stripes</a></li>
								<li id='1.16' class='Children'><a><img style='vertical-align:middle' src='belts/G4Br.png'>&nbsp;4 Brown Stripes</a></li>
								<li id='1.17' class='Children'><a><img style='vertical-align:middle' src='belts/Br.png'>&nbsp;Brown Belt</a></li>
								<li id='1.18' class='Children'><a><img style='vertical-align:middle' src='belts/Br1Bk.png'>&nbsp;1 Black Stripe</a></li>
								<li id='1.19' class='Children'><a><img style='vertical-align:middle' src='belts/Br2Bk.png'>&nbsp;2 Black Stripes</a></li>
								<li id='1.20' class='Children'><a><img style='vertical-align:middle' src='belts/Br3Bk.png'>&nbsp;3 Black Stripes</a></li>
								<li id='1.21' class='Children'><a><img style='vertical-align:middle' src='belts/Br4Bk.png'>&nbsp;4 Black Stripes</a></li>
								<li id='1.22' class='Children'><a><img style='vertical-align:middle' src='belts/Bk.png'>&nbsp;Black Belt</a></li>
								<li id='1.23' class='Children'><a><img style='vertical-align:middle' src='belts/Bk1R.png'>&nbsp;Shodan</a></li></ul></div>");
						
						
						
	$cdsHtml .= sprintf("<div type='hidden' id='Adult_Menu'>
							<ul id='belt_change' class='dropdown-menu dropdown-menu-right' aria-labelledby='dLabel' style='background-color:grey;width:320px'>
								<li id='2.00' class='Adult'><a><img style='vertical-align:middle' src='belts/W.png'>&nbsp;White Belt</a></li>
								<li id='2.01' class='Adult'><a><img style='vertical-align:middle' src='belts/W1G.png'>&nbsp;1 Green Stripe</a></li>
								<li id='2.02' class='Adult'><a><img style='vertical-align:middle' src='belts/W2G.png'>&nbsp;2 Green Stripes</a></li>
								<li id='2.03' class='Adult'><a><img style='vertical-align:middle' src='belts/G.png'>&nbsp;Green Belt</a></li>
								<li id='2.04' class='Adult'><a><img style='vertical-align:middle' src='belts/G1Br.png'>&nbsp;1 Brown Stripe</a></li>
								<li id='2.05' class='Adult'><a><img style='vertical-align:middle' src='belts/G2Br.png'>&nbsp;2 Brown Stripes</a></li>
								<li id='2.06' class='Adult'><a><img style='vertical-align:middle' src='belts/Br.png'>&nbsp;Brown Belt</a></li>
								<li id='2.07' class='Adult'><a><img style='vertical-align:middle' src='belts/Br1Bk.png'>&nbsp;1 Black Stripe</a></li>
								<li id='2.08' class='Adult'><a><img style='vertical-align:middle' src='belts/Br2Bk.png'>&nbsp;2 Black Stripes</a></li>
								<li id='2.09' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk.png'>&nbsp;Black Belt</a></li>
								<li id='2.10' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk1R.png'>&nbsp;Shodan</a></li>
								<li id='2.11' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk2R.png'>&nbsp;Nidan</a></li>
								<li id='2.12' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk3R.png'>&nbsp;Sandan</a></li>
								<li id='2.13' class='Adult'><a><img style='vertical-align:middle' src='belts/Bk4R.png'>&nbsp;Yondan</a></li>
								<li id='2.14' class='Adult'><a><img style='vertical-align:middle' src='belts/Go.png'>&nbsp;Godan</a></li>
								<li id='2.15' class='Adult'><a><img style='vertical-align:middle' src='belts/Ro.png'>&nbsp;Rokudan</a></li>
								<li id='2.16' class='Adult'><a><img style='vertical-align:middle' src='belts/Sh.png'>&nbsp;Shichidan</a></li>
								<li id='2.17' class='Adult'><a><img style='vertical-align:middle' src='belts/Ha.png'>&nbsp;Hachidan</a></li>
							</ul></div>");
	
	$cdsHtml .= '</div>';
	echo($cdsHtml);
	?>