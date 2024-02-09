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

public class Preloader extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public function Preloader()
	{
		
		this.x = 475;
		this.y = 300;
		this.alpha = 0;
		
	}
	
	public function hideit():void
	{
		
		Tweener.removeTweens(this);
		Tweener.addTween( this, { alpha: 0 , time:3 , transition:"easeOutExpo", onComplete:function(){this.y = -1000;}} );
		
	}
	
	public function showit():void
	{
		
		this.y = 300;
		Tweener.removeTweens(this);
		Tweener.addTween( this, { alpha: 1 , time:3 , transition:"easeOutExpo"} );
		
	}
	
}

}

