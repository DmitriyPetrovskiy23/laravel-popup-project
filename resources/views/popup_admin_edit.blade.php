@extends('layouts.popup_layout')

@section('title-block')Редактирование попапа@endsection

@section('content')

<h3 class="text-center py-3">Создать попап</h1>
    <form action="{{ route('popup_admin_edit_submit',$popup->id)}}" class="form-horizontal custom-form" method="POST">
    {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-12">
                <div class="row">

                    <div class="col-md-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-width input-group-text" id="basic-addon1">Название</span>
                            </div>
                            @error('name')
                                <input type="text" name="name" maxlength="96" id="name" class="input-mb form-control place input-right-border @error('name') is-invalid @enderror" placeholder="@error('name'){{ $message }} @enderror"> 
                            @else
                                <input type="text" name="name" maxlength="96" id="name" class="input-mb form-control place input-right-border" value="{{$popup->popup_name}}"> 
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-width input-group-text" id="basic-addon2" style="height: 100%;">Текст содержимого</span>
                            </div>
                            @error('text')
                                <textarea name="text" maxlength="1024" id="text" rows="3" style="resize: none;" class="input-mb form-control place input-right-border @error('text') is-invalid @enderror" placeholder="@error('text'){{ $message }} @enderror"></textarea>
                            @else
                                <textarea name="text" maxlength="1024" id="text" rows="3" style="resize: none;" class="input-mb form-control place input-right-border">{{$popup->popup_text}}</textarea>
                            @enderror
                        </div>
                    </div>
                    <div class="grid-magellan mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Активность попапа</span>
                        </div>
                        @if($popup->popup_change == 0)
                            <div class="switch-field">
                                <input type="radio" id="radio-two" name="popup_change" value="0" checked/>
                                <label class="off-button col" for="radio-two">Выключить</label>
                                <input type="radio" id="radio-one" name="popup_change" value="1"/>
                                <label class="on-button col" for="radio-one">Включить</label>
                            </div>  
                        @else
                            <div class="switch-field">
                                <input type="radio" id="radio-two" name="popup_change" value="0"/>
                                <label class="off-button col" for="radio-two">Выключить</label>
                                <input type="radio" id="radio-one" name="popup_change" value="1" checked/>
                                <label class="on-button col" for="radio-one">Включить</label>
                            </div>  
                        @endif  
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">Запланировать</button>
                    </div>
                </div>
            </div>
        </div>


    </form>

@endsection