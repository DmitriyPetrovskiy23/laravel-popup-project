@extends('layouts.popup_layout')

@section('title-block')Страница просмотра попапа@endsection

@section('content')

<div class="row d-flex justify-content-center align-items-center p-0" style="height:100vh">
    <div class="col-12">
        <button type="button" class="btn_my btn_my-primary w-100" id="view_popup" data-toggle="modal_my" data-target="#popup_view">Просмотреть попап</button>
    </div>
    <div class="col-12">
        <a role="button" href="{{route('popup_admin')}}" id="return" class="btn_my btn_my-primary w-100">Вернуться на страницу с операциями</a>
    </div>
</div>

<div class="modal_my fade" id="popup_view" tabindex="-1" role="dialog" aria-labelledby="popup_view" aria-hidden="true">
  <div class="modal_my-dialog modal_my-dialog-centered" role="document">
    <div class="modal_my-content">
      <div class="modal_my-header">
        <h5 class="modal_my-title" id="exampleModalLongTitle">{{$popup->popup_name}}</h5>
        <button type="button" class="close close-popup" data-dismiss="modal_my" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal_my-body">
        {{$popup->popup_text}}
      </div>
      <div class="modal_my-footer">
        <button type="button" class="btn_my btn_my-secondary close-popup" data-dismiss="modal_my">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="/js/modal.js"></script>
@endsection