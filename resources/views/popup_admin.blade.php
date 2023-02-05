@extends('layouts.popup_layout')

@section('title-block')Операции для попапа@endsection

@section('content')

<h3 class="text-center py-3">Админ-панель попапов</h3>
@if($popups->count() == 0)
    <div class="col-12 d-flex justify-content-center align-items-center p-0" style="height:100vh">
        <a role="button" href="{{route('popup_admin_create')}}" class="btn_my btn_my-primary w-100">Создать попап</a>
    </div>
@else
    @foreach($popups as $popup)
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-3">
                    <span>{{$popup->popup_name}}</span>
                </div>
                <div class="col-2">
                    <a role="button" href="{{route('popup_admin_view',$popup->id)}}" class="btn_my btn_my-primary w-100">Просмотреть попап</a>
                </div>
                <div class="col-1">
                    <input type="hidden" value="{{$popup->popup_code}}" id="input-code-{{$popup->id}}">
                    <button type="button" class="btn_my btn_my-primary w-100" id="button-code-{{$popup->id}}">Ссылка</button>
                </div>
                <div class="col-3">
                    <a role="button" href="{{route('popup_admin_edit',$popup->id)}}" class="btn_my btn_my-primary w-100">Редактировать попап</a>
                </div>
                <div class="col-3">
                    <a role="button" href="{{route('popup_admin_delete',$popup->id)}}" class="btn_my btn_my-danger w-100">Удалить попап</a>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-12 mt-4">
        <a role="button" href="{{route('popup_admin_create')}}" class="btn_my btn_my-primary w-100">Создать попап</a>
    </div>
    <script>
        const inputCode = document.querySelectorAll('[id^=input-code-]');
        const buttonCode = document.querySelectorAll('[id^=button-code-]');
        for(let i = 0; i < inputCode.length; i++){
            const inCode = inputCode[i];
            const butCode = buttonCode[i];
            butCode.addEventListener('click',()=>{
                inCode.type = "text";
                inCode.select();
                document.execCommand("copy");
                inCode.type = "hidden";
                alert("Ссылка: " + inCode.value + " скопирована в буфер обмена");
            })
        }
    </script>
@endif

@endsection