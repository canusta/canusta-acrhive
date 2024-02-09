package
{
	
import canusta.data.*;
import flash.utils.*;
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
import flash.net.*;

public class Contact extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public function Contact()
	{
		
		run();
		buttonize();
		
	}
	
	private function run():void
	{
		if(global.root)
		{
			global.root.Expand();
		}
		
	}
	
	private function buttonize():void
	{
		
		pidief.addEventListener(MouseEvent.CLICK, downloadpdf);
		pidief.addEventListener(MouseEvent.MOUSE_OVER, over);
		pidief.addEventListener(MouseEvent.MOUSE_OUT, out);
		pidief.buttonMode = true;
		
	}
	
	private function downloadpdf(e:Event):void
	{
		
		var url:String = "http://www.bozcadrinks.com/press.zip";
		var request:URLRequest = new URLRequest(url);
		navigateToURL(request, '_blank');
		
	}
	
	private function over(e:Event):void
	{
		
		Tweener.addTween( pidief, { width: 45 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( pidief, { height: 45 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( pidief, { x: 711 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( pidief, { y: 232 , time:0.5 , transition:"easeOutExpo"} );
		
	}
	
	private function out(e:Event):void
	{
		
		Tweener.addTween( pidief, { width: 50 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( pidief, { height: 49 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( pidief, { x: 709 , time:0.5 , transition:"easeOutExpo"} );
		Tweener.addTween( pidief, { y: 230 , time:0.5 , transition:"easeOutExpo"} );
		
	}
	
}

}

