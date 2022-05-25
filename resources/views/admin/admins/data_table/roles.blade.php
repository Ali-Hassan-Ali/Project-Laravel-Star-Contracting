@foreach ($admin->roles as $role)
    <h5><span class="badge badge-primary">{{ $role->name }}</span></h5>
@endforeach
