<div class="sidebar bg-grey p-20">
    <div class="element">
        <a href="{{route('tasks.index')}}"><i class="fa fa-clipboard"></i> Tasks</a>
    </div>
    <div class="element">
        <a href="{{route('projects.index')}}"><i class="fa fa-columns"></i> Projects</a>
    </div>
    @can('manage users')
        <div class="element">
            <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Users</a>
        </div>
    @endcan   
</div>