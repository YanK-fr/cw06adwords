{if $GA_CONVERSION_ID && $GA_CONVERSION_LABEL }
	<!-- Google Code for Vente Conversion Page -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = "{$GA_CONVERSION_ID}";
	var google_conversion_language = "{$lang_iso}";
	var google_conversion_format = "3";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "{$GA_CONVERSION_LABEL}";
	var google_conversion_amount = {$CONVERSION_AMOUNT};

	{literal}
	if (google_conversion_amount) {
	  var google_conversion_value = google_conversion_amount;
	}
	var google_remarketing_only = false;
	/* ]]> */
	{/literal}
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/{$GA_CONVERSION_ID}/?value={$CONVERSION_AMOUNT}&amp;label={$GA_CONVERSION_LABEL}&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>

	<script>
	{literal}
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-54925665-1', 'auto');
	ga('send', 'pageview');
	{/literal}
	</script>
{/if}

{if $FB_CONVERSION_ID }
	<!-- Facebook Conversion Code for Facebook -->
	<script>
	fbPixelTracking = {$FB_CONVERSION_ID};
	conversionAmount = {$CONVERSION_AMOUNT};
	currency = {$currency->iso_code};
	{literal}
	(function() {
		var _fbq = window._fbq || (window._fbq = []);
		if (!_fbq.loaded) {
			var fbds = document.createElement('script');
			fbds.async = true;
			fbds.src = '//connect.facebook.net/en_US/fbds.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(fbds, s);
			_fbq.loaded = true;
		}
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', fbPixelTracking, {
		'value':conversionAmount,
		'currency':currency
	}]);
	{/literal}
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev={$FB_CONVERSION_ID}&amp;cd[value]={$CONVERSION_AMOUNT}&amp;cd[currency]={$currency->iso_code}&amp;noscript=1" /></noscript>
{/if}