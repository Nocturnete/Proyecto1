<link rel="stylesheet" href="{{ asset('css/alerts.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha256-6a39eJs39WfjZMvRXXY99q8d9o+0mXqPYVs3U2Ck5Cc=" crossorigin="anonymous" />

<!-- resources/views/alerts.blade.php -->

@isset($type)
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="new-message-box">

                    @if($type == 'alert')
                        <div class="new-message-box-alert">
                            <div class="info-tab tip-icon-alert" title="error"><i></i></div>
                            <div class="tip-box-alert">
                                <p>{{ $message }}</p>
                            </div>
                        </div>

                    @elseif($type == 'danger')
                        <div class="new-message-box-danger">
                            <div class="info-tab tip-icon-danger" title="error"><i></i></div>
                            <div class="tip-box-danger">
                                <p>{{ $message }}</p>
                            </div>
                        </div>

                    @elseif($type == 'success')
                        <div class="new-message-box-{{ $type }}">
                            <div class="info-tab tip-icon-{{ $type }}" title="{{ $type }}"><i></i></div>
                            <div class="tip-box-{{ $type }}">
                                <p>{{ $message }}</p>
                            </div>
                        </div>

                    @elseif($type == 'warning')
                        <div class="new-message-box-warning">
                            <div class="info-tab tip-icon-warning" title="error"><i></i></div>
                            <div class="tip-box-warning">
                                <p>{{ $message }}</p>
                            </div>
                        </div>

                    @elseif($type == 'info')
                        <div class="new-message-box-info">
                            <div class="info-tab tip-icon-info" title="error"><i></i></div>
                            <div class="tip-box-info">
                                <p>{{ $message }}</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endisset
