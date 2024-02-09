package
{
	
import canusta.data.*;
import flash.utils.*;
import flash.net.*;
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

public class BosphorusLogo extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	public var locked							: Boolean = true;
	
	public function BosphorusLogo()
	{
		
		this.y = global.sy - 70;
		hover.alpha = 0;
		buttonize();
		
	}
	
	public function StageResized():void
	{
		
		if(locked==false)
		{
			Tweener.addTween( this, { y:global.sy + 12 , time:1 , transition:"easeOutExpo"} );
		}else
		{
			Tweener.addTween( this, { y:25 , time:1 , transition:"easeOutExpo"} );
		}
		
	}
	
	private function buttonize():void
	{
		
		bttn.buttonMode = true;
		bttn.addEventListener(MouseEvent.CLICK, clicked);
		bttn.addEventListener(MouseEvent.MOUSE_OVER, over);
		bttn.addEventListener(MouseEvent.MOUSE_OUT, out);
		
	}
	
	private function clicked(e:Event) {
		
		var url:String = "http://www.thebosphorusbrand.com/";
		var request:URLRequest = new URLRequest(url);
		navigateToURL(request, '_blank');
		Tweener.addTween( hover, { y:-60 , time:1 , transition:"easeInExpo"} );
		Tweener.addTween( hover, { alpha:0 , time:1 , transition:"easeInExpo"} );
		
	}
	
	private function over(e:Event) {
		
		Tweener.addTween( hover, { y:15 , time:1 , transition:"easeOutExpo"} );
		Tweener.addTween( hover, { alpha:1 , time:1 , transition:"easeOutExpo"} );
		
	}
	
	private function out(e:Event) {
		
		Tweener.addTween( hover, { y:-60 , time:1 , transition:"easeInExpo"} );
		Tweener.addTween( hover, { alpha:0 , time:1 , transition:"easeInExpo"} );
		
	}
	
}

}

