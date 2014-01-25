<?

use Illuminate\Support\Facades\Request;
use Orchestra\Support\Facades\Asset; ?>
<footer>
	<div class="container">
		<hr>
		<p>
            Proudly Powered by <a href="//github.com/grans/edlara">Edlara</a>. Educational Laravel Package
		</p>
	</div>
</footer>

<?php
$asset = Asset::container('orchestra/foundation::footer');
?>

{{ $asset->styles() }}
{{ $asset->scripts() }}
@placeholder("orchestra.layout: footer")

