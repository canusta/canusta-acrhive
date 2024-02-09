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
import flash.geom.Rectangle;

public class About extends MovieClip
{
	
	private var global							: Global = Global.getInstance();
	
	public function About()
	{
		
		run();
		
	}
	
	private function run():void
	{
		
		if(global.root)
		{
			global.root.Expand();
		}
		
	}
	
}

}

