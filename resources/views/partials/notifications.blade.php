	@if(Session::has('flash_message'))
        <p class="notification notification-success">
            {{ Session::get('flash_message') }}
            <span class="target-close">
                <i class="icon icon-cancel29"></i>
            </span>
        </p>                         
    @endif