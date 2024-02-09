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

public class Bubble extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	private var key								: Number;
	
	public function Bubble()
	{
		
		run();
		
	}
	
	private function run(e:Event=null):void
	{
		
		setKey();
		launch();
		
	}
	
	private function setKey():void
	{
		
		key = Math.round(Math.random()*5);
		
	}
	
	private function launch():void
	{
		
		Tweener.removeTweens(this);
		this.y = 100;
		this.x = Math.round(Math.random()*100);
		//var nextx : Number = this.x+10;
		this.width = this.height = 5/key;
		Tweener.addTween( this, { y: -10 , time:key*2 , transition:"easeInExpo", onComplete:run} );
		//Tweener.addTween( this, { x: nextx, time:key*2 , transition:"easeInBounce", onComplete:run} );
		
	}
	
}

}

