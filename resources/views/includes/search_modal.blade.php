<div id="vestidos-search-main-pnl">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 text-center mx-auto mt-4">
                <div class="form-row px-0 mx-0 vestido-search-input-row mb-0">
                    <div class="form-group col-10 col-lg-11 mb-0">
                        <input id="search-input-text" onKeyDown="inputSearchKeyDown(event)" onKeyUp="searchBarProductName(event)" class="vestidos-search-input form-control my-0 py-1" type="text" placeholder="{{ __('search.type_word_search') }}" aria-label="Search">
                    </div>
                    <div class="form-group col-2 col-lg-1">
                        <div id="modal-close-pnl">
                            <a href="javascript:closeModalSearch()">
                                <div>
                                    <svg version="1.1" id="modal-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve"><g><path fill="black" d="M9.1,8L14,3.1c0.3-0.3,0.3-0.8,0-1.1c-0.3-0.3-0.8-0.3-1.1,0L8,6.9L3.1,2C2.8,1.7,2.3,1.7,2,2
                                            C1.7,2.3,1.7,2.8,2,3.1L6.9,8L2,12.9c-0.3,0.3-0.3,0.8,0,1.1c0.2,0.2,0.3,0.2,0.5,0.2c0.2,0,0.4-0.1,0.5-0.2L8,9.1l4.9,4.9
                                            c0.2,0.2,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2c0.3-0.3,0.3-0.8,0-1.1L9.1,8z"/></g></svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row vestidos-search-loader">
            <div class="col text-center">
                <img class="img-fluid" src="{{ asset('images/vest_load_b.gif')}}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 mx-auto mt-4">
                <div id="vestidos-search-results-pnl">
                    <ul>
                    </ul>
                </div>
                <div id="vestidos-search-result-not-found" class="py-5 text-center">
                            <p>
                            {{ __('search.no_result_line1') }} "<span></span>"
                            </p>
                            <p>
                             {{ __('search.no_result_line2') }}
                            </p>
                    </div>
            </div>
        </div>

    </div>
</div>