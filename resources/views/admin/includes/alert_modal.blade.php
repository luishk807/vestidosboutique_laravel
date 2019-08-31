<div id="modal-black-bg">
    <div id="modal-pnl" id="col-lg-5 col-sm-12">
        <div id="modal-close-pnl">
            <a href="javascript:closeModalAlert()">
                <div>
                    <svg version="1.1" id="modal-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve"><g><path fill="black" d="M9.1,8L14,3.1c0.3-0.3,0.3-0.8,0-1.1c-0.3-0.3-0.8-0.3-1.1,0L8,6.9L3.1,2C2.8,1.7,2.3,1.7,2,2
                            C1.7,2.3,1.7,2.8,2,3.1L6.9,8L2,12.9c-0.3,0.3-0.3,0.8,0,1.1c0.2,0.2,0.3,0.2,0.5,0.2c0.2,0,0.4-0.1,0.5-0.2L8,9.1l4.9,4.9
                            c0.2,0.2,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2c0.3-0.3,0.3-0.8,0-1.1L9.1,8z"/></g></svg>
                </div>
            </a>
        </div>
        @if(isset($popupInfo))
        <div id="modal-title-pnl">{{ $popupInfo->title}}</div>
        <div id="modal-in-pnl">
            <p>
                {{ $popupInfo->line_1}}
            </p>
            @if($popupInfo->line_2)
            <p>
                {{ $popupInfo->line_2}}
            </p>
            @endif
            <p>
                <a href="{{ $popupInfo->action_link }}" target="{{ $popupInfo->action_tab == 0 ? '_self' : '_blank' }}" class='modal-in-link'>{{ $popupInfo->action_text }}</a>
            </p>
        </div>
        @endif
    </div>
</div>