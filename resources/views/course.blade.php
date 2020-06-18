@extends('layouts.app')

@section('content')
@include('users.partials.header', [
    'title' => __('Hello') . ' '. auth()->user()->name,
    'description' => __('This is course page. You can add main course in here.'),
    'class' => 'col-lg-10'
])

<div class="container-fluid mt--7">
    @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <div class="row">
        <div class="col-xl-8 order-xl-2 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('List Main Course') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="no">No</th>
                                        <th scope="col" class="sort" data-sort="title">Title</th>
                                        <th scope="col" class="sort" data-sort="Desc">Description</th>
                                        <th scope="col" class="sort" data-sort="total">Course</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($courses as $index => $course)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ $course->desc }}</td>
                                            <td>{{ $course->course_details->count() }}</td>
                                            <td>
                                                <a href="{{ route('courses.show', $course->id) }}"
                                                    class="btn btn-success"><i class="fas fa-info-circle"></i></a>
                                                <a href="javascript:;" data-toggle="modal"
                                                    onclick="deleteData({{ $course->id }})"
                                                    data-target="#modal-notification" class="btn btn-xs btn-danger"><i
                                                        class="fas fa-trash-alt"></i></a>
                                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-notification"><i class="fas fa-trash-alt"></i></button> --}}
                                                <form action="" id="deleteForm" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal fade" id="modal-notification" tabindex="-1"
                                                        role="dialog" aria-labelledby="modal-notification"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                            role="document">
                                                            <div class="modal-content bg-gradient-danger">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="py-3 text-center">
                                                                        <i class="ni ni-bell-55 ni-3x"></i>
                                                                        <h4 class="heading mt-4">Are you sure delete
                                                                            this course ?</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-white"
                                                                        onclick="formSubmit()">Delete Course</button>
                                                                    <button type="button"
                                                                        class="btn btn-link text-white ml-auto"
                                                                        data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="my-4" />

                </div>
            </div>
        </div>
        <div class="col-xl-4 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('Add Main Course') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('courses.store') }}">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label"
                                    for="input-title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="input-title"
                                    class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Title') }}" value="" required autofocus>

                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <label class="form-control-label"
                                    for="input-image">{{ __('Image URL') }}</label>
                                <input type="text" name="image" id="input-image"
                                    class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Image URL') }}" value="" required autofocus>

                                @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="input-desc">{{ __('Description') }}</label>
                                <textarea type="text" name="desc" id="input-desc"
                                    class="form-control form-control-alternative{{ $errors->has('desc') ? ' is-invalid' : '' }}"
                                    rows="4" required autofocus> </textarea>

                                @if($errors->has('desc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-success mt-2">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route("courses.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

    </script>

@endpush
