@extends('layouts.app')
@section('endHead')
    {!! Html::style('css/groups.css') !!}
@stop
@section('content')
    <div class="groups-container">
        <div class="groups-container-inner">
            <div class="options-container">
                <div id="search-results">
                    <ul class="result-list">
                    @if (count($groups))
                        <div id="select-group">Departments</div>
                        @foreach($groups as $group)<!--departments-->
                            @if(!$group->team)
                            <li class="result-list-elem team href="#" onclick="display('{{$group->name}}','{{$users->find($group->user_ID)->name}}' ,'{{$group->description}}', '{{$group->budget}}', '{{json_encode($actions[0])}}', '{{json_encode($tasks[0])}}', '{{json_encode($users)}}', '{{$group->id}}', '{{$rosters}}');return false;"">
                                <a id="link-result">{{$group->name}}</a>
                            </li>
                            @endif
                        @endforeach
                        <div id="select-group">Teams</div>
                        @foreach($groups as $group)<!--teams-->
                            @if($group->team)
                            <li class="result-list-elem department href="#" onclick="display('{{$group->name}}','{{$users->find($group->user_ID)->name}}' ,'{{$group->description}}', '{{$group->budget}}', '{{json_encode($actions[0])}}', '{{json_encode($tasks[0])}}', '{{json_encode($users)}}', '{{$group->id}}', '{{$rosters}}');return false;"">
                                <a id="link-result">{{$group->name}}</a>
                            </li>
                            @endif
                        @endforeach
                    @else
                        <li class="result-list-elem">N/A</li>
                    @endif
                    </ul>
                </div>
            </div>

            <div class="roster-container">
                @if (count($groups))
                <h2 id="group-name"><label id="group-name-colour-bar"></label>{{$groups[0]['name']}}</h2>
                @else
                <h2 id="group-name"><label id="group-name-colour-bar"></label>No Groups</h2>
                @endif
                @if (count($groups))
                <div class="group-elements" id="group-lead">Lead: {{$users->find($groups[0]['user_ID'])->name}}</div>
                <div class="group-elements" id="group-description">Description: {{$groups[0]['description']}}</div>
                <div class="group-elements" id="group-budget">Budget: ${{$groups[0]['budget']}}</div>
                @else
                <div class="group-elements" id="group-lead">Lead: N/A</div>
                <div class="group-elements" id="group-description">Description: N/A</div>
                <div class="group-elements" id="group-budget">Budget: N/A</div>
                @endif
                    <br>
                <h2 class="roster-headers"><label id="action-colour-bar"></label>Actions</h2>
                <div id="group-actions">
                    @if (count($groups))
                        @foreach ($actions[0] as $action)<!-- first businessplan -->
                            @if ($action->group == $groups[0]['id'])
                                <div class="action-task-content">
                                    <a class="action-task-content-link" href="{{url('/task', $action->id)}}">{{$action->description}}</a>
                                </div>
                            @endif
                        @endforeach
                    @else
                    <div class="action-task-content">N/A</div>
                    @endif
                </div>
                    <br>
                <h2 class="roster-headers"><label id="task-colour-bar"></label>Tasks</h2>
                <div id="group-tasks">
                    @if (count($groups))
                        @foreach ($tasks[0] as $task)<!-- first businessplan -->
                            @if ($task->group == $groups[0]['id'])
                                <div class="action-task-content">
                                    <a class="action-task-content-link" href="{{url('/task', $task->id)}}">{{$task->description}}</a>
                                </div>
                            @endif
                        @endforeach
                    @else
                    <div class="action-task-content">N/A</div>
                    @endif
                </div>
                    <br>
                <h2 class="roster-headers"><label id="roster-colour-bar"></label>Roster</h2>
                <div id="group-users">
                    @if (count($groups))
                        @foreach ($rosters as $roster)
                            @if ($roster->group_ID == $groups[0]['id'])
                                <div class="roster-names">{{$users->find($roster->user_ID)->name}}</div>
                            @endif
                        @endforeach
                    @else
                        <div class="roster-names">N/A</div>
                    @endif
                </div>
            </div>

        </div>
        <div class="business-plan-div">
            {{Form::label('businessplan-label', 'Business Plan', ['class' => 'business-plan-selector'])}}
            {{Form::select('business-plan', $businessPlans, null, ['class' => 'business-plan-selector'])}}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        function display(element, lead, description, budget, actions, tasks, users, id, rosters) {

            var $name = element;
            var headerText = document.getElementById("group-name");
            var descriptionText = document.getElementById("group-description");
            var leadText = document.getElementById("group-lead");
            var budgetText = document.getElementById("group-budget");
            var actionText = document.getElementById("group-actions");
            var taskText = document.getElementById("group-tasks");
            var userText = document.getElementById("group-users");
            var actionsArray = JSON.parse(actions);
            var tasksArray = JSON.parse(tasks);
            var usersArray = JSON.parse(users);
            var rostersArray = JSON.parse(rosters);
            var actionContent = '';
            var taskContent = '';
            var userContent = '';

            for (var i = 0; i < actionsArray.length; i++)
                if (actionsArray[i].group == id)
                    actionContent+="<div class='action-task-content'> <a class='action-task-content-link' href=\"action/" + actionsArray[i].id + "\">" + actionsArray[i].description + "</a> </div>";

            for (var i = 0; i < tasksArray.length; i++)
                if (tasksArray[i].group == id)
                    taskContent+="<div class='action-task-content'> <a class='action-task-content-link' href=\"task/" + tasksArray[i].id + "\">" + tasksArray[i].description + "</a> </div>";

            for (var j = 0; j < usersArray.length; j++)
                for (var k = 0; k < rostersArray.length; k++)
                    if ((usersArray[j].id == rostersArray[k].user_ID) && (rostersArray[k].group_ID == id))
                        userContent+="<div class='roster-names'>" + usersArray[j].name + "</div>";

            userText.innerHTML = userContent;
            actionText.innerHTML = actionContent;
            taskText.innerHTML = taskContent + "<br>";
            headerText.innerHTML = "<label id=\"group-name-colour-bar\"></label>" + $name;
            descriptionText.innerHTML = "Description: " + description;
            budgetText.innerHTML = "Budget: $" + budget + "<br>";
            leadText.innerHTML = "Lead: " + lead;
        }
    </script>
@stop