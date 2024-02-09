package
{
	
import canusta.data.*;
import flash.utils.*;
import flash.text.*;
import flash.display.*;
import lt.uza.utils.*;
import flash.events.*;
import XMLList;
import Math;
import com.hydrotik.queueloader.QueueLoader;
import com.hydrotik.queueloader.QueueLoaderEvent;
import lt.uza.utils.*
import caurina.transitions.*;
import flash.events.TimerEvent;
import flash.display.Sprite;
import flash.net.NetConnection;
import flash.net.NetStream;
import flash.media.Video;
import flash.events.AsyncErrorEvent;
import flash.display.Sprite;
import flash.events.MouseEvent;
import flash.display.MovieClip;
import flash.events.Event;
import flash.events.IOErrorEvent;
import fl.transitions.Tween;
import fl.transitions.easing.Strong;
import flash.net.URLRequest;
import flash.net.URLLoader;
import flash.net.URLVariables;
import flash.net.URLRequestMethod;
import flash.text.TextField;
import flash.text.TextFieldAutoSize;
import flash.text.StyleSheet;
import flash.net.*;

public class Order extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var elmaAmount 						: TextField;
	private var narAmount 						: TextField;
	private var isim							: TextField;
	private var telefon							: TextField;
	private var mailtext						: String;
	
	private var step							: int=0;
	
	public function Order()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		if(global.root)
		{
			global.root.Expand();
		}
		
		elmaAmount = muvi.muvi.adet_elma.adet;
		narAmount = muvi.muvi.adet_nar.adet;
		isim = muvi.muvi.bttn.order2.muvi.isim_input;
		telefon = muvi.muvi.bttn.order2.muvi.telefon_input;
		isim.text = '';
		telefon.text = '';
		
		buttonize();
		
	}
	
	private function buttonize():void
	{
		
		muvi.muvi.bttn.bttn.buttonMode = true;
		muvi.muvi.bttn.bttn.addEventListener(MouseEvent.CLICK, orderclicked);
		muvi.muvi.bttn.bttn.addEventListener(MouseEvent.MOUSE_OVER, orderover);
		muvi.muvi.bttn.bttn.addEventListener(MouseEvent.MOUSE_OUT, orderout);
		
	}
	
	private function orderclicked(e:Event):void
	{
		
		if(step==0)
		{
			orderStep1();
		}else
		{
			orderStep2();
		}
		
		
	}
	
	private function orderover(e:Event=null):void
	{
		
		
		Tweener.addTween( muvi.muvi.bttn.hover, { y: 10 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( muvi.muvi.bttn.out, { y: 38 , time:0.5 , transition:"easeOutExpo"} );
		
	}
	
	private function orderout(e:Event=null):void
	{
		
		Tweener.addTween( muvi.muvi.bttn.hover, { y: -25 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( muvi.muvi.bttn.out, { y: 8 , time:0.5 , transition:"easeOutExpo"} );
		
	}
	
	private function orderStep1():void
	{
		
		step = 1;
		
		muvi.muvi.bttn.order2.play();
		
	}
	
	private function orderStep2():void
	{
		
		step = 2;
		
		if(isim.text != '' || telefon.text != '')
		{
			muvi.muvi.bttn.order2.play();
			muvi.muvi.bttn.order2.addEventListener('sendmail', sendMessage);
		}
		
	}
	
	public function sendMessage(e:Event=null):void
    {
	
		mailtext = "İsim: " + isim.text + '\n' + "Telefon: " + telefon.text + '\n' + 'Elmalı Bozca: ' + elmaAmount.text + ' Adet' + '\n' + 'Narlı Bozca: ' + narAmount.text + ' Adet';
	
        var variables:URLVariables=new URLVariables();
        variables.name='BOZCA Siparişi';
        variables.email='info@bozcadrinks.com';
        variables.message=mailtext;
        
        var request:URLRequest=new URLRequest();
        request.url='sendmail.php';
        request.method=URLRequestMethod.POST;
        request.data=variables;
        
        var loader:URLLoader=new URLLoader();
        loader.dataFormat=URLLoaderDataFormat.VARIABLES;
        loader.addEventListener(Event.COMPLETE,messageSent);
        try
        {
            loader.load(request);
        } 
        catch (error:Error) 
        {
            trace('Unable to load requested document.');
        }
    }

    private function messageSent(evt:Event):void
    {
        var loader:URLLoader=URLLoader(evt.target);
        var vars:URLVariables=new URLVariables(loader.data);
        if(vars.answer=="ok")
            muvi.muvi.bttn.order2.play();
        else
            trace("Something wrong");
    }
	
}

}

