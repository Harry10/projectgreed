<script type="text/javascript">
	// Original script by Walter Heitman Jr, first published on http://techblog.shanock.com

	// Set an initial scroll speed. This equates to the number of pixels shifted per tick
	var scrollspeed=5;
	var pxptick=scrollspeed;
	function startmarquee(){
		// Make a shortcut referencing our div with the content we want to scroll
		marqueediv=document.getElementById("marqueecontent");
		// Get the total width of our available scroll area
		marqueewidth=document.getElementById("marqueeborder").offsetWidth;
		// Get the width of the content we want to scroll
		contentwidth=marqueediv.offsetWidth;
		// Start the ticker at 50 milliseconds per tick, adjust this to suit your preferences
		// Be warned, setting this lower has heavy impact on client-side CPU usage. Be gentle.
		setInterval("scrollmarquee()",50);
	}
	function scrollmarquee(){
		// Check position of the div, then shift it left by the set amount of pixels.
		if (parseInt(marqueediv.style.left)>(contentwidth*(-1)))
			marqueediv.style.left=parseInt(marqueediv.style.left)-pxptick+"px";
		// If it's at the end, move it back to the right.
		else
			marqueediv.style.left=parseInt(marqueewidth)+"px";
	}
	window.onload=startmarquee;
</script>

<div id="marqueeborder" onmouseover="pxptick=0" onmouseout="pxptick=scrollspeed">
<div id="marqueecontent">

Dow Jones Industrial Top 30: <?php

	// Original script by Walter Heitman Jr, first published on http://techblog.shanock.com

	// List your stocks here, separated by commas, no spaces, in the order you want them displayed:
	$stocks = "AXP,MMM,T,BA,CAT,CVX,CSCO,KO,DD,XOM,GE,GS,HD,IBM,INTC,JNJ,JPM,MCD,MRK,MSFT,NKE,PFE,PG,TRV,UTX,UNH,VZ,V,WMT";

	// Function to copy a stock quote CSV from Yahoo to the local cache. CSV contains symbol, price, and change
	function upsfile($stock) { copy("http://finance.yahoo.com/d/quotes.csv?s=$stock&f=sl1c1&e=.csv","stockcache/".$stock.".csv"); }

	foreach ( explode(",", $stocks) as $stock ) {

		// Where the stock quote info file should be...
		$local_file = "stockcache/".$stock.".csv";

		// ...if it exists. If not, download it.
		if (!file_exists($local_file)) { upsfile($stock); }
		// Else,If it's out-of-date by 15 mins (900 seconds) or more, update it.
		elseif (filemtime($local_file) <= (time() - 900)) { upsfile($stock); }

		// Open the file, load our values into an array...
		$local_file = fopen ("stockcache/".$stock.".csv","r");
		$stock_info = fgetcsv ($local_file, 1000, ",");

		// ...format, and output them. I made the symbols into links to Yahoo's stock pages.
		echo "<span class=\"stockbox\"><a href=\"http://finance.yahoo.com/q?s=".$stock_info[0]."\">".$stock_info[0]."</a> ".sprintf("%.2f",$stock_info[1])." <span style=\"";
		// Green prices for up, red for down
		if ($stock_info[2]>=0) { echo "color: #009900;\">&uarr;";	}
		elseif ($stock_info[2]<0) { echo "color: #ff0000;\">&darr;"; }
		echo sprintf("%.2f",abs($stock_info[2]))."</span></span>\n";
		// Done!
		fclose($local_file); 
	}
?><span class="stockbox" style="font-size:1em">Quotes from <a href="http://finance.yahoo.com/">Yahoo Finance</a></span>
</div>
</div>
