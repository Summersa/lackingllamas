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


<button id="topButtons" onClick="showTree()">Graphical View</button>
<button id="topButtons" onClick="showGrid()">Tree Grid View</button>
<button id="collapseButtons" onClick="collapseAll()">CollapseAll</button>
<button id="collapseButtons" onClick="expandAll()">ExpandAll</button>

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
						<tr id="tree-action" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}">
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
                                @if($task->priority > -1)
                                    @if($task->priority == 0)
                                        <tr id="tree-task" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}.{{$task->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" style="background-color: white;">
                                    @elseif($task->priority == 1)
                                        <tr id="tree-task" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}.{{$task->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" style="background-color: red;">
                                    @elseif($task->priority == 2)
                                        <tr id="tree-task" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}.{{$task->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" style="background-color: orange;">
                                    @elseif($task->priority == 3)
                                        <tr id="tree-task" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}.{{$task->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" style="background-color: yellow;">
                                    @endif
                                @else
                                    <tr id="tree-task" data-tt-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}.{{$task->id}}" data-tt-parent-id="{{$goal->id}}.{{$objective->id}}.{{$action->id}}" style="background-color: green;">
                                @endif
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
		//getting the next element
		$content = $header.next();
		//open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
		$content.slideToggle(500, function () {
			//execute this after slideToggle is done
			//change text of header based on visibility of content div

			$header.text(function () {
				//change text based on condition
				return $content.is(":visible") ? "Collapse" : $header.data('myatt')
			});
		});

	});
</script>


@stop



