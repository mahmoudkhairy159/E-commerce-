


@if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <div class="alert alert-success alert-dismissible fade show">
          <strong> {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    </div>
@endif
@if (session('error'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@if (session('warning'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('warning') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    </div>
@endif
@if (session('info'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    </div>
@endif


@if ($errors->any())
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <div class="alert alert-danger">
            Please check the form below for errors
        </div>
    </div>
@endif



