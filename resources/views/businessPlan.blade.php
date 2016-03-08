@extends('layouts.app')

@section('endHead')
        {!! Html::style('css/jquery.treetable.css') !!}
        {!! Html::style('css/jquery.treetable.theme.default.css') !!}
		{!! Html::style('css/treeTableStyle.css') !!}
		{!! Html::style('css/businessPlan.css') !!}

@stop





@section('content')


<br>
<br>
<h2 id ="title"> Business Plan </h2>

<div style="display: inline-block">
<button id="topButtons" onClick="showTree()">Graphical View</button>
<button id="topButtons" onClick="showGrid()">Tree Grid View</button>
</div>

<div style="display: inline-block">
    <div class="boxCompleted" style="display: inline-block"></div>
    <div style="display: inline-block">Completed</div>
    <div class="boxLow" style="display: inline-block"></div>
    <div style="display: inline-block">Low Priority</div>
    <div class="boxHigh" style="display: inline-block"></div>
    <div style="display: inline-block">High Priority</div>
    <div class="boxUrgent" style="display: inline-block"></div>
    <div style="display: inline-block">Urgent</div>
    <div class="boxNone" style="display: inline-block"></div>
    <div style="display: inline-block">No Priority</div>
</div>

<div style="float: right">
<button class = "collapseBP" id="collapseButtons" onClick="collapseAll()">CollapseAll</button>
<button class = "expandBP" id="collapseButtons" onClick="expandAll()">ExpandAll</button>
</div>


<div class = "notificationsTable">

<input  onclick="window.location='{{ url("businessplan/creategoal") }}'" id="goalCreateButton" type="submit" value = "Create Goal" ></input>
<div class = "container">
@foreach ($goals as $goal)
	<div class = "container">
	<div class = "header"data-myatt="{{ $goal->name }}">
		<span>{{ $goal->name }}</span>
	
	</div>
	<div class = "content">
	@foreach($objectives as $objective)
		@if($objective->goal_id==$goal->id)
		<div>	
			<input id="objectiveButton" type="submit" value = "{{ $objective->name }}"></input>
		</div>

		<table id ="table">
			<tr>
				<td>Description</td>
				<td>Date</td>
				<td>Lead</td>
				<td>Collaborators</td>
				<td>Budget</td>
				<td>Project Plan</td>
				<td>Success Measured</td>
			</tr>
			@foreach($actions as $action)
				@if($action->objective_id==$objective->id)
					<tr id = "actionTR">
						<td>{{$action->description}}</td>
						<td>{{$action->date}}</td>
						<td>{{$action->lead}}</td>
						<td>{{$action->collaborators}}</td>
						<td>{{$action->budget}}</td>
						<td>{{$action->projectPlan}}</td>
						<td>{{$action->successMeasured}}</td>
					</tr>

				@foreach($tasks as $task)
					@if($task->action_id==$action->id)
						<tr>
							<td>{{$task->description}}</td>
							<td>{{$task->date}}</td>
							<td>{{$task->lead}}</td>
							<td>{{$task->collaborators}}</td>
							<td>{{$task->budget}}</td>
							<td>{{$task->projectPlan}}</td>
							<td>{{$task->successMeasured}}</td>
						</tr>
					@endif
  				@endforeach
  				@endif
  			@endforeach
 
		</table>
		@endif
	@endforeach
	</div>
	</div>
@endforeach

	
	
</div>
</div>


<table id="atest">
	<thead>
	<tr>
		<th>Description of GOAT Element</th>
		<th>Date</th>
		<th>Lead</th>
		<th>Collaborators</th>
		<th>Budget</th>
		<th>Project Plan</th>
		<th>Success Measures</th>
	</tr>
	</thead>
	<tbody>
	@foreach($goals as $goal)
		<tr id="tree-goal" data-tt-id="{{$goal->id}}">
			<td>{{$goal->name}}</td>
		</tr>
		@foreach($objectives as $objective)
			@if($objective->goal_id==$goal->id)
				<tr id="tree-objective" data-tt-id="{{$goal->id}}.{{$objective->id}}" data-tt-parent-id="{{$goal->id}}">
					<td>{{$objective->name}}</td>
				</tr>
				@foreach($actions as $action)
					@if($action->objective_id==$objective->id)
                        @if($action->priority > -1)
                            @if($action->priority == 0)
                                <tr id="tree-action" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}" style="background-color: white;">
                            @elseif($action->priority == 1)
                                <tr id="tree-action" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}" style="background-color: red;">
                            @elseif($action->priority == 2)
                                <tr id="tree-action" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}" style="background-color: orange;">
                            @elseif($action->priority == 3)
                                <tr id="tree-action" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}" style="background-color: yellow;">
                            @endif
                        @else
                            <tr id="tree-action" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}" style="background-color: green;">
                        @endif
							<td>{{$action->description}}</td>
							<td>{{$action->date}}</td>
							<td>{{$action->lead}}</td>
							<td>{{$action->collaborators}}</td>
							<td>{{$action->budget}}</td>
							<td>{{$action->projectPlan}}</td>
							<td>{{$action->successMeasured}}</td>
						</tr>
						@foreach($tasks as $task)
							@if($task->action_id==$action->id)
                                <tr id="tree-task" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}.{{$task->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}">
									<td>{{$task->description}}</td>
									<td>{{$task->date}}</td>
									<td>{{$task->lead}}</td>
									<td>{{$task->collaborators}}</td>
									<td>{{$task->budget}}</td>
									<td>{{$task->projectPlan}}</td>
									<td>{{$task->successMeasured}}</td>
								</tr>
							@endif
						@endforeach
					@endif
				@endforeach
			@endif
		@endforeach
	@endforeach

	</tbody>
</table>

@stop

@section('scripts')
		<!-- <link rel="stylesheet" href="/public/javascript/jquery-ui.css"> -->
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="http://ludo.cubicphuse.nl/jquery-treetable/jquery.treetable.js"></script>

<script>
	$("#atest").treetable({ expandable: true, initialState: "expanded" });
	$("#atest").hide();

	function showTree(){
		$("#atest").hide();
		$(".notificationsTable").show();
	}

	function showGrid(){
		$("#atest").show();
		$(".notificationsTable").hide();
	}

    function collapseAll() {
        $("#atest").treetable("collapseAll");
    }

    function expandAll() {
        $("#atest").treetable("expandAll");
    }
</script>

<script>
	$(".header").click(function () {

		$header = $(this);
		$content = $header.next();
		$content.slideToggle(500, function () {
		});

	});
$(".expandBP").click(function () {
$content =$(".content");
$content.slideDown(500, function () {});
});
$(".collapseBP").click(function () {
$content =$(".content");
$content.slideUp(500, function () {});
});
</script>


@stop



