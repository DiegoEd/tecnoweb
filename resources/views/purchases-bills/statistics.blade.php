@extends('layouts.app')
@section('content')
<div class="container">
	<div id="visualization" style="background-color: white"></div>
	<script type="text/javascript">
		var container = document.getElementById('visualization');
	    var items = [<?php echo $all ?>];
	    var dataset = new vis.DataSet(items);
	    var options = {
	    	start: '2017-02-01',
	    	end: '2017-10-31'
	    };
	    var graph2d = new vis.Graph2d(container, dataset, options);
	</script>
</div>
@endsection