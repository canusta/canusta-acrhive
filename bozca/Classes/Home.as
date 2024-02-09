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

public class Home extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	private var key								: Number;
	
	public function Home()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		global.root.Contract();
		muvi.addEventListener( 'bubbles', addBubbles, false, 0, true );
		
	}
	
	private function addBubbles(e:Event=null):void
	{
		
		var myTimer:Timer = new Timer(50, 40);
		myTimer.addEventListener('timer', addBubble);

		// Start the timer
		myTimer.start();
		
	}
	
	private function addBubble(e:Event):void
	{
		
		var bubble : Bub = new Bub();
		muvi.bottleR.bubbles.addChild(bubble);
		
		var bubbleY : Bub = new Bub();
		muvi.bottleY.bubbles.addChild(bubbleY);
		
	}
	
}

}

