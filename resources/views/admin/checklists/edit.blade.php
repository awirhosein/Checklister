@extends('layouts.app')

@section('content')

    {{-- Edit Checklist --}}
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">

            @if ($errors->any())
                <div class="alert alert-danger border-0 small" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">{{ __('Edit Checklist') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.checklist-groups.checklists.update', [$checklistGroup, $checklist]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-control-label">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $checklist->name) }}">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn bg-gradient-primary px-5 mb-0">{{ __('Save Checklist') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <form action="{{ route('admin.checklist-groups.checklists.destroy', [$checklistGroup, $checklist]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm mt-3" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete This Checklist') }}</button>
            </form>
        </div>
    </div>

    {{-- Task Lists --}}
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">{{ __('List of Tasks') }}</h6>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checklist->tasks as $task)
                                <tr>
                                    <td class="align-middle">
                                        <span class="font-weight-bold text-sm ps-3">{{ $task->name }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}" class="btn bg-gradient-primary btn-sm mb-0 px-3 py-1">Edit</a>
                                        <form action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('{{ __('Are you sure?') }}')" class="btn bg-gradient-danger btn-sm mb-0 px-3 py-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- New Task --}}
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 mb-lg-0 mb-4">

            @if ($errors->storeTask->any())
                <div class="alert alert-danger border-0 small" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->storeTask->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">{{ __('New Task') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.checklists.tasks.store', $checklist) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn bg-gradient-primary px-5 mb-0">{{ __('Save Task') }}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection