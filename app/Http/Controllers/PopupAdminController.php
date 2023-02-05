<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Popup;

class PopupAdminController extends Controller
{
    
    public function index(){
        $popups = Popup::get();
        return view('popup_admin')->with('popups',$popups);
    }

    public function popup_admin_create(){
        return view('popup_admin_create');
    }

    public function popup_admin_create_submit(Request $request){
        $name = $request->input('name');
        $text = $request->input('text');
        $change = $request->input('popup_change');



        $request->validate([
            'name' => 'required',
            'text' => 'required'
        ],[
            'name.required' => 'Введите название попапа',
            'text.required' => 'Введите текст в попапе',
        ]);

        Popup::create([
            'popup_name' => $name,
            'popup_text' => $text,
            'popup_change' => $change, 
            'popup_quantity' => 0, 
            'popup_code' => 0
        ]);
        $id = Popup::where('popup_name',$name)->where('popup_text',$text)->first()->id;

        $protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        
        $htmlPopup = '<div class="modal_my fade" id="popup_view" tabindex="-1" role="dialog" aria-labelledby="popup_view" aria-hidden="true"><div class="modal_my-dialog modal_my-dialog-centered" role="document"><div class="modal_my-content"><div class="modal_my-header"><h5 class="modal_my-title" id="exampleModalLongTitle">'.$name.'</h5><button type="button" class="close close-popup" data-dismiss="modal_my" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal_my-body">'.$text.'</div><div class="modal_my-footer"><button type="button" class="btn_my btn_my-secondary close-popup" data-dismiss="modal_my">Close</button></div></div></div></div>';
        
        $script = "var main = document.body;
            main.innerHTML += `".$htmlPopup."`;
            let styleBootstrap = document.createElement('link');
            styleBootstrap.rel = 'stylesheet';
            styleBootstrap.id = 'boots-style';
            styleBootstrap.href = '".$protocol.$_SERVER['HTTP_HOST']."/css/bootstrap.min.css?v=1';
            document.head.appendChild(styleBootstrap);
            const xml = new XMLHttpRequest();
            const link ='".$protocol.$_SERVER['HTTP_HOST']."/popupadmin/change/".$id."' ;
            xml.open('GET', link);
            xml.setRequestHeader('Content-Type', 'application/x-www-form-url');
            xml.addEventListener('readystatechange', () => {
                if (xml.readyState === 4 && xml.status === 200) {
                    setTimeout(()=>{
                        const change = xml.responseText;
                        if(Number(change) == 1){
                            const xttp = new XMLHttpRequest();
                            const url ='".$protocol.$_SERVER['HTTP_HOST']."/popupadmin/view_add/".$id."?view=1';
                            const closePopup = document.querySelectorAll('.close-popup');
        
                            xttp.open('POST', url, true);
                            xttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xttp.addEventListener('readystatechange', () => {
                                if(xttp.readyState === 4 && xttp.status === 200) {       
                                    console.log('POST запрос выполнен');
                                }
                            });
                            xttp.send();
        
                        
                                const popupModal = document.getElementById('popup_view');
                                popupModal.classList.remove('fade');
                                popupModal.style = 'display:block;background-color: rgb(128 128 128 / 40%);';
                            
                                
                            for(let i = 0; i < closePopup.length; i++){
                                closePopup[i].addEventListener('click',() => {
                                    popupModal.classList.add('fade');
                                    popupModal.style = 'display:none';
                                    let popupMy = document.querySelector('.modal_my');
                                    let bootHead = document.getElementById('boots-style');
                                    popupMy.remove();
                                    bootHead.remove();
                                });
                            }
                        } else {
                            let popupMy = document.querySelector('.modal_my');
                            let bootHead = document.getElementById('boots-style');
                            popupMy.remove();
                            bootHead.remove();
                        }
                    },'10000');
                } else if (xml.readyState != 4 && xml.status != 200){
                    let popupMy = document.querySelector('.modal_my');
                    let bootHead = document.getElementById('boots-style');
                    popupMy.remove();
                    bootHead.remove();
                }
            });
            xml.send();";
        $fileName = public_path('/js/script_popup_'.$id.'.js');
        file_put_contents($fileName,$script);
        Popup::where('popup_name',$name)->where('popup_text',$text)->update(['popup_code' => $protocol.$_SERVER['HTTP_HOST'].'/js/script_popup_'.$id.'.js']);
        return redirect()->route('popup_admin');
    }

    public function popup_admin_edit($id){
        $popup = Popup::where('id',$id)->first();
        return view('popup_admin_edit')->with('popup',$popup);
    }

    public function popup_admin_edit_submit(Request $request, $id){
        $name = $request->input('name');
        $text = $request->input('text');
        $change = $request->input('popup_change');
        $request->validate([
            'name' => 'required',
            'text' => 'required'
        ],[
            'name.required' => 'Введите название попапа',
            'text.required' => 'Введите текст в попапе',
        ]);

        $popup_quantity = Popup::where('id',$id)->first()->popup_quantity;

        Popup::where('id',$id)->update([
            'popup_name' => $name,
            'popup_text' => $text,
            'popup_change' => $change, 
            'popup_quantity' => $popup_quantity
        ]);

        return redirect()->route('popup_admin');
    }

    public function popup_admin_delete($id){
        Popup::where('id',$id)->delete();
        if(file_exists(public_path('/js/script_popup_'.$id.'.js'))){
            unlink(public_path('/js/script_popup_'.$id.'.js'));
        }
        return redirect()->route('popup_admin');
    }

    public function popup_admin_view($id){
        $popup = Popup::where('id',$id)->first();
        return view('popup_admin_view')->with('popup',$popup);
    }

    public function popup_admin_change($id){
        $popup = Popup::where('id',$id)->first();
        return view('json')->with('popup',$popup);
    }

    public function popup_admin_view_add(Request $request,$id){
        $value = $request->all();
        $view = intval($value['view']);
        if($view == 1){
            $quary = Popup::where('id',$id);
            $popup = $quary->first();
            $popup_quantity = $popup->popup_quantity + $view;
            $quary->update(['popup_quantity' => $popup_quantity]);
        }
    }
}
