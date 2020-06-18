<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Course</th>
                <th scope="col" class="sort" data-sort="budget">Total Course</th>
                <th scope="col">Users</th>
                <th scope="col" class="sort" data-sort="completion">Completion</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($courses as $course)
                <th scope="row">
                    <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                            <img alt="Image placeholder" src="{{ $course->image }}">
                        </a>
                        <div class="media-body">
                            <span class="name mb-0 text-sm">{{ $course->title }}</span>
                        </div>
                    </div>
                </th>
                <td>
                    {{ $course->course_details->count() }}
                </td>
                <td>
                    <div class="avatar-group">
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                            data-original-title="Ryan Tompson">
                            <img alt="Image placeholder" src="https://png.pngitem.com/pimgs/s/506-5067022_sweet-shap-profile-placeholder-hd-png-download.png">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                            data-original-title="Romina Hadid">
                            <img alt="Image placeholder" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTPyl4wM_0PWnCOJZU-XZxQniChqr8DqTJbid6Jvlqy4oNyn8iH&usqp=CAU">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                            data-original-title="Alexander Smith">
                            <img alt="Image placeholder" src="https://png.pngitem.com/pimgs/s/506-5067022_sweet-shap-profile-placeholder-hd-png-download.png">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                            data-original-title="Jessica Doe">
                            <img alt="Image placeholder" src="https://png.pngitem.com/pimgs/s/506-5067022_sweet-shap-profile-placeholder-hd-png-download.png">
                        </a>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="completion mr-2">{{ round($course->getProgress()) }}%</span>
                        <div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{ $course->getProgress() }}"
                                    aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->getProgress() }}%;"></div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-right">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">See Detail</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<hr class="my-2" />
