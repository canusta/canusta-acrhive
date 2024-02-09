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

public class Sixhegon extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public var locked							: Boolean = true;
	
	public function Sixhegon()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		this.x = 800;
		this.y = 25;
		
	}
	
	public function StageResized():void
	{
		
		if(locked==false)
		{
			Tweener.addTween( this, { x:890 , time:1 , transition:"easeOutExpo"} );
		}else
		{
			Tweener.addTween( this, { x:800 , time:1 , transition:"easeOutExpo"} );
		}
		
	}
	
}

}

