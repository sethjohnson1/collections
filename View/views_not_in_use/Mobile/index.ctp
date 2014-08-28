<?php
//that's right, this page is written in plain HTML connects through API
?>



<div role="main" class="ui-content">

<!-- I could not get the checkbox to ever show 'off' and quickly gave up and used select -->
<form>
 <label for="flip-select">Show only items on display:</label>
    <select id="flip-select" name="flip-select" data-role="flipswitch">
        <option>Off</option>
        <option>On</option>
    </select>
	<label for="slider-2">Results to show:</label>
    <input type="range" name="slider-2" id="num-results" data-highlight="true" min="5" max="50" value="5">
</form>
<!--
        <form>
    <label for="flip-checkbox">Flip toggle switch checkbox:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox" id="flip-checkbox" />
</form>
-->

        <form class="ui-filterable">
            <input id="filterBasic-input" data-type="search" />
</form>
<ul id="autocomplete" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Synopsis . . ." data-filter-theme="a" data-input="#filterBasic-input" ></ul>
 </div>


	 <div data-role="footer">
	 <h4>Center of the West</h4>
	 </div><!-- /footer -->

</div><!-- /page -->
