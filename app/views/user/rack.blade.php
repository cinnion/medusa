@extends('layout')

@section('pageTitle')
    Ribbon Rack Builder
@stop

@section('content')
    <div class="row">
        <h1 class="text-center">Ribbon Rack Builder
            for {{  $user->getGreeting() }} {{ $user->first_name }}{{ isset($user->middle_name) ? ' ' . $user->middle_name : '' }} {{ $user->last_name }}{{ isset($user->suffix) ? ' ' . $user->suffix : '' }}</h1>

        <p>Currently, the Ribbon Rack Builder only supports individiual RMN/RMMC ribbons. As the artwork becomes
            avaialble
            for RMA, GSN, RHN and IAN ribbons as well as unit awards worn on the right side of the RMN uniform, they
            will be
            added.</p>

        <p>Once you save your ribbon rack, it will be record in your MEDUSA record and displayed on your Service Record.
            There will be a link under your ribbon rack that will show you the HTML required to embed your ribbon rack
            in
            another website.</p>

        <p>Please select your awards from the list below, then click "Save". If an award can be awarded more than once,
            you will be able to select the number of times you have received the award.</p>
    </div>

    {{ Form::open(array('route' => 'saverack')) }}
    <div class="row text-center"><h3>Qualification Badges</h3></div>
    @foreach(Award::getTopBadges() as $index => $badge)
        @if(is_object($badge))
            @if(file_exists(public_path('awards/badges/' . $badge->code . '-1.svg')))
                <div class="row ribbon-row">
                    <div class="columns small-1">
                        {{Form::checkbox('ribbon[]', $badge->code, isset($user->awards[$badge->code])?true:null)}}
                    </div>
                    <div class="columns small-2 text-center">
                        <img src="{{asset('awards/badges/' . $badge->code . '-1.svg')}}" alt="{{$badge->name}}">
                    </div>
                    <div class="columns small-4">{{$badge->name}}</div>
                    <div class="columns small-1 end">
                        @if($badge->multiple)
                            {{Form::select($badge->code . '_quantity', [1=>'1', 2=>'2', 3=>'3', 4=>'4'], isset($user->awards[$badge->code])?$user->awards[$badge->code]['count']:1)}}
                        @else
                            {{Form::hidden($badge->code . '_quantity', '1')}}
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="ribbon-group">
                @foreach($badge['group']['awards'] as $group)
                    @if(file_exists(public_path('awards/badges/' . $group->code . '-1.svg')))
                        <div class="row ribbon-group-row">
                            <div class="columns small-1">
                                {{Form::radio('group' . $index, $group->code, isset($user->awards[$group->code])?true:null)}}
                            </div>
                            <div class="columns small-2 text-center">
                                <img src="{{asset('awards/badges/' . $group->code . '-1.svg')}}" alt="{{$group->name}}">
                            </div>
                            <div class="columns small-4">{{$group->name}}</div>
                            <div class="columns small-1 end">
                                @if($group->multiple)
                                    {{Form::select($group->code . '_quantity', [1=>'1', 2=>'2', 3=>'3', 4=>'4'], isset($user->awards[$group->code])?$user->awards[$group->code]['count']:1)}}
                                @else
                                    {{Form::hidden($group->code . '_quantity', '1')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row ribbon-group-row">
                    <div class="columns small-1">
                        {{Form::radio('group' . $index, null)}}
                    </div>
                    <div class="columns small-2 text-center">&nbsp;</div>
                    <div class="columns small-4 end">None of the above</div>
                </div>
            </div>
        @endif
    @endforeach

    <div class="row text-center"><h3>Individual Awards</h3></div>
    @foreach(Award::getLeftRibbons() as $index => $ribbon)
        @if(is_object($ribbon))
            @if(file_exists(public_path('ribbons/' . $ribbon->code . '-1.svg')))
                <div class="row ribbon-row">
                    <div class="columns small-1">
                        {{Form::checkbox('ribbon[]', $ribbon->code, isset($user->awards[$ribbon->code])?true:null)}}
                    </div>
                    <div class="columns small-2 text-center">
                        <img src="{{asset('ribbons/' . $ribbon->code . '-1.svg')}}" alt="{{$ribbon->name}}">
                    </div>
                    <div class="columns small-4">{{$ribbon->name}}</div>
                    <div class="columns small-1 end">
                        @if($ribbon->multiple)
                            {{Form::select($ribbon->code . '_quantity', [1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5'], isset($user->awards[$ribbon->code])?$user->awards[$ribbon->code]['count']:1)}}
                        @else
                            {{Form::hidden($ribbon->code . '_quantity', '1')}}
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="ribbon-group">
                @foreach($ribbon['group']['awards'] as $group)
                    @if(file_exists(public_path('ribbons/' . $group->code . '-1.svg')))
                        <div class="row ribbon-group-row">
                            <div class="columns small-1">
                                {{Form::radio('group' . $index, $group->code, isset($user->awards[$group->code])?true:null)}}
                            </div>
                            <div class="columns small-2 text-center">
                                <img src="{{asset('ribbons/' . $group->code . '-1.svg')}}" alt="{{$group->name}}">
                            </div>
                            <div class="columns small-4">{{$group->name}}</div>
                            <div class="columns small-1 end">
                                @if($group->multiple)
                                    {{Form::select($group->code . '_quantity', [1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5'], isset($user->awards[$group->code])?$user->awards[$group->code]['count']:1)}}
                                @else
                                    {{Form::hidden($group->code . '_quantity', '1')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row ribbon-group-row">
                    <div class="columns small-1">
                        {{Form::radio('group' . $index, null)}}
                    </div>
                    <div class="columns small-2 text-center">&nbsp;</div>
                    <div class="columns small-4 end">None of the above</div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="row text-center">
        {{Form::submit('Save', ['class' => 'button'])}}
    </div>
    {{Form::close()}}
@stop