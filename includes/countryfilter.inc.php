<?php

function buildCountryFilter() {
	echo "<div class='box countryfilter'> 
	<h3>Country Filters</h3>
		<section>
			
			<h4>Filter By Search</h4>
				<input type='text' id='text' value=''><br>
			<h4>Filter by Continent</h4>
				<ul id=countryFilter>
					<li><input type='radio' name='cont' value='AF'> Africa</li>
					<li><input type='radio' name='cont' value='AS'> Asia</li>
					<li><input type='radio' name='cont' value='EU'> Europe</li>
					<li><input type='radio' name='cont' value='NA'> North America</li>
					<li><input type='radio' name='cont' value='OC'> Oceania</li>
					<li><input type='radio' name='cont' value='SA'> South America</li>
					<li><input type='radio' name='cont' value='AN'> Antartica</li>
					<li><h4>Filter by Images</h4></li>
					<li><input type='radio' name='cont' value='IM'> Images</li>
				</ul>
			<h4>Clear All Filters</h4>
			<input id='button' type='button' value='Reset'>
			<input id='buttonhide' type='button' value='Hide'>
		</section>

		<div class='show'>
		<input id='buttonshow' type='button' value='Show'>
		</div>
	</div>

	<div class='box countrylist'>
		<h3>Country List</h3>
		<section>
			<ul id='countryList'></ul>
		</section>
	</div>
	";
}

?>