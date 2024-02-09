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

public class Bant extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public function Bant()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		this.x = 980;
		this.y = 525;
		//txt.text = "AHAN DA!"
		
	}
	
}

}

