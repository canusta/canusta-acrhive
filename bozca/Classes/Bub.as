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

public class Bub extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	private var key								: Number;
	
	public function Bub()
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
		this.alpha = 1/key;
		this.y = 5-Math.round(Math.random()*10);
		this.x = Math.round(Math.random()*128);
		//var nextx : Number = this.x+10;
		//this.width = this.height = 5/key;
		Tweener.addTween( this, { y: -476 , time:key*3 , transition:"easeInQuad", onComplete:run} );
		//Tweener.addTween( this, { x: nextx, time:key*2 , transition:"easeInBounce", onComplete:run} );
		
	}
	
}

}

