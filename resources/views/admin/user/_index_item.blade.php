<div class="pb-2 post-item">

    <div>
        <h3><a href="{{ route('admin.user.show',['id'=>$model->id]) }}">
                <strong>{{$model->name}}</strong><br/>
                {{ $model->email }}</a>
        </h3>
        <div style="width: 60%;padding-top: 10px">
            {{$model->role->label()}}
        </div>
    </div>
</div>
