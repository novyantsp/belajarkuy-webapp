@extends('layouts.app')

@section('content')
@include('users.partials.header', [
    'title' => __('Hello') . ' '. auth()->user()->name,
    'description' => __('This is course detail page. You can edit course and add list course for ') . $course->title. ' Course.',
    'class' => 'col-lg-7'
])

    <div class="container-fluid mt--8">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Course') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('courses.update', $course->id) }}">
                            @csrf
                            @method('PATCH')
                            <h6 class="heading-small text-muted mb-4">{{ __('Course information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ $course->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-desc">{{ __('Description') }}</label>
                                    <textarea type="text" name="desc" id="input-desc" class="form-control form-control-alternative{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="4" required autofocus>{{ $course->desc }}</textarea>

                                    @if ($errors->has('desc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('desc') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-2">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-6 mb-0">{{ __('List Course') }}</h3>
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
                                            <th scope="col" class="sort" data-sort="Desc">Time</th>
                                            <th scope="col" class="sort" data-sort="total">Video</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($course->course_details as $index => $courses)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $courses->title }}</td>
                                            <td>{{ $courses->time }}</td>
                                            <td><a href="{{ $courses->videoURL }}" target="_blank" rel="noopener noreferrer">Open</a></td>
                                            <td>
                                                    <a href="javascript:;" data-toggle="modal" onclick="updateData({{$courses->id}})"
                                                        data-title='{{ $courses->title }}'
                                                        data-time='{{ $courses->time }}'
                                                        data-video='{{ $courses->videoURL }}'
                                                        data-desc='{{ $courses->desc }}'
                                                        data-target="#updateDataModal" class="btn btn-success open-detail"><i class="fas fa-info-circle"></i></a>


                                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$courses->id}})"
                                                    data-target="#modal-notification" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-notification"><i class="fas fa-trash-alt"></i></button> --}}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add Course
                        </button>
                    </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Course to {{ $course->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('courseDetail.store') }}">
                                            @csrf
                                            <h6 class="heading-small text-muted mb-4">{{ __('Course information') }}</h6>
                                            <hr class="my-4" />
                                            <input type="text" name="course_id" value="{{ $course->id }}" hidden>
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="" required autofocus>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-time">{{ __('Time') }}</label>
                                                    <input type="text" name="time" id="input-time" class="form-control form-control-alternative{{ $errors->has('time') ? ' is-invalid' : '' }}" placeholder="{{ __('Time') }}" value="" required autofocus>

                                                    @if ($errors->has('time'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('time') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('videoURL') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-videoURL">{{ __('Video URL') }}</label>
                                                    <input type="text" name="videoURL" id="input-videoURL" class="form-control form-control-alternative{{ $errors->has('videoURL') ? ' is-invalid' : '' }}" placeholder="{{ __('Youtube Video URL') }}" value="" required autofocus>

                                                    @if ($errors->has('videoURL'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('videoURL') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group"{{ $errors->has('desc') ? ' has-danger' : '' }}>
                                                    <label class="form-control-label" for="input-desc">{{ __('Description') }}</label>
                                                    <textarea type="text" name="desc" id="input-desc" class="form-control form-control-alternative{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="4" required autofocus></textarea>

                                                    @if ($errors->has('desc'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>


                                                <div class="text-center">

                                                </div>
                                            </div>
                                        <hr class="my-4" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success mt-2">{{ __('Add Course') }}</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <form action="" id="deleteForm" method="post">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-gradient-danger">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="py-3 text-center">
                                <i class="ni ni-bell-55 ni-3x"></i>
                                <h4 class="heading mt-4">Are you sure delete this course ?</h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-white" onclick="formSubmit()">Delete Course</button>
                            <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="POST" action="" id="updateForm">
            @csrf
            @method('PATCH')
        <div class="modal fade" id="updateDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('Course information') }}</h6>
                            <hr class="my-4" />
                            <div class="pl-lg-4">
                                <input type="text" name="course_id" value="{{ $course->id }}" hidden>
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-time">{{ __('Time') }}</label>
                                    <input type="text" name="time" id="input-time" class="form-control form-control-alternative{{ $errors->has('time') ? ' is-invalid' : '' }}" placeholder="{{ __('Time') }}" value="" required autofocus>

                                    @if ($errors->has('time'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('videoURL') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-videoURL">{{ __('Video URL') }}</label>
                                    <input type="text" name="videoURL" id="input-videoURL" class="form-control form-control-alternative{{ $errors->has('videoURL') ? ' is-invalid' : '' }}" placeholder="{{ __('Youtube Video URL') }}" value="" required autofocus>

                                    @if ($errors->has('videoURL'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('videoURL') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group"{{ $errors->has('desc') ? ' has-danger' : '' }}>
                                    <label class="form-control-label" for="input-desc">{{ __('Description') }}</label>
                                    <textarea type="text" name="desc" id="input-desc" class="form-control form-control-alternative{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="4" required autofocus></textarea>

                                    @if ($errors->has('desc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('desc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        <hr class="my-4" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2" onclick="formSubmits()" >{{ __('Update Course') }}</button>
                    </div>
                </form>
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
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("courseDetail.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
     </script>
     <script type="text/javascript">
        function updateData(id)
        {
            var id = id;
            var url = '{{ route("courseDetail.update", ":id") }}';
            url = url.replace(':id', id);
            $("#updateForm").attr('action', url);
        }

        function formSubmits()
        {
            $("#updateForm").submit();
        }
     </script>
     <script>
        $('#updateDataModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var time = button.data('time');
            var videoURL = button.data('video');
            var desc = button.data('desc');

            var modal = $(this);
            modal.find('.modal-header #exampleModalLabel').val(title);
            modal.find('.modal-body #input-title').val(title);
            modal.find('.modal-body #input-time').val(time);
            modal.find('.modal-body #input-videoURL').val(videoURL);
            modal.find('.modal-body #input-desc').val(desc);
            });
    </script>
@endpush
