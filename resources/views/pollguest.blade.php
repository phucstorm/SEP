@extends('layouts.guest')
@push('head')
<!-- Scripts -->
    <script src="{{ asset('js/pollguest.js') }}" defer></script>
@endpush
@section('content')
    <div class="container">
        <div class="poll-container">
            <h1 class="h1-content total-answer">
                0 <i class="fa fa-user" aria-hidden="true"></i>
            </h1>
            <form action="/room" method="post" class="poll-form">
                <div class="poll-form-header">
                    Đố mấy bạn tui tên gì?
                </div>
                <div class="poll-form-body">
                    <!-- non-multiple choice thì hiển thị dạng radio button -->
                    <fieldset class='poll-answers'>
                        <legend hidden>id</legend>
                            <input id='talk-type-1'
                                    name='talk-type'
                                    type='radio'
                                    value='1' 
                                    hidden/>
                            <label for='talk-type-1' class='radio-label poll-label'><span class="styled-radio-btn"></span>Linh đáng iu</label>
                            <input id='talk-type-2'
                                    name='talk-type'
                                    type='radio'
                                    value='workshop'
                                    hidden />
                            <label for='talk-type-2' class='radio-label poll-label'><span class="styled-radio-btn"></span>Linh cute</label>
                    </fieldset>
                    <!-- multiple choice thì hiển thị dạng checkbox -->
                    <div class='poll-answers'>
                        <label class='checkbox-label poll-label' for='available'>
                        <input id='available'
                                name='available'
                                type='checkbox'
                                value='is-available' hidden/><span class="styled-checkbox"></span>
                        Linhhhhhh
                        </label>
                        <label class='checkbox-label poll-label' for='unavailable'>
                        <input id='unavailable'
                                name='unavailable'
                                type='checkbox'
                                value='is-available' hidden/><span class="styled-checkbox"></span>
                        Linh vo hoxxx
                        </label>
                    </div>
                </div>  
                <div class="poll-result">
                    <div class="poll-result-item">
                        <div class="poll-result-answer">
                        Linh đáng iu <span class="percent">({{(1/10)*100}}%)</span>
                        </div>
                        <!-- width là (số lượt vote answers/tổng số vote) * 100 -->
                        <div class="poll-result-bar" data-width="{{(1/10)*100}}%"></div>
                    </div>
                    <div class="poll-result-item">
                        <div class="poll-result-answer">
                        Linh cute <span class="percent">({{(9/10)*100}}%)</span>
                        </div>
                        <div class="poll-result-bar" data-width="{{(9/10)*100}}%"></div>
                    </div>
                </div> 
                <div class="question-form__footer poll-form-footer">
                    <button type="button" id="submit-btn" class="submit-poll-btn poll-btn">Send</button>
                    <button type="button" id="edit-btn" class="edit-poll-btn poll-btn">Edit Response</button>
                </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@endsection