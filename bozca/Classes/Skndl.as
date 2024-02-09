package
{
	
	import canusta.data.*;
	import flash.net.*;
	import flash.display.*;
	import lt.uza.utils.*;
	import flash.events.*;
	import flash.utils.*;
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

public class Skndl extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public function Skndl()
	{
		
		run();
		Tweener.addTween( this, { y:523 , time:0 , transition:"easeOutExpo"} );
		Tweener.addTween( this, { x:global.sx + global.sw , time:0 , transition:"easeOutExpo"} );
		StageResized();
		
	}
	
	private function run():void
	{
		
		buttonize();
		
	}
	
	private function buttonize():void {
		
		bttn.addEventListener(MouseEvent.CLICK, clicked);
		bttn.addEventListener(MouseEvent.MOUSE_OVER, over);
		bttn.addEventListener(MouseEvent.MOUSE_OUT, out);
		bttn.buttonMode = true;
		
	}
	
	private function clicked(e:Event):void
	{
		
		var url:String = "http://www.skndl.com";
		var request:URLRequest = new URLRequest(url);
		navigateToURL(request, '_blank');
		
	}
	
	private function over(e:Event):void
	{
		
		Tweener.addTween( bluepoint, { y:13 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( skndllogo, { x:-22 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( skndllogo, { alpha:1 , time:1 , transition:"easeOutExpo"} );
		
	}
	
	private function out(e:Event):void
	{
		
		Tweener.addTween( bluepoint, { y:0 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( skndllogo, { x:0 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( skndllogo, { alpha:0 , time:1 , transition:"easeOutExpo"} );
	}
	
	
	public function StageResized():void
	{
		
		Tweener.addTween( this, { y:523 , time:1 , transition:"easeOutExpo"} );
		var trgt : Number = 980 + ((global.sw-980)/6) ;
		Tweener.addTween( this, { x:trgt , time:1 , transition:"easeOutExpo"} );
		
	}
	
}

}

